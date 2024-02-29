<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/vendor/FPDF/fpdf.php');

class boleta {
    public function generarBoleta($Boleta,$Usuario,$Pedido,$Platos) {
        $pdf = new FPDF($orientation='P',$unit='mm');
        $pdf->AddPage();
        $pdf->SetMargins(15, 0);
        $pdf->SetFont('Arial','B',20);    
        $textypos = 5;
        $pdf->setY(12);
        $pdf->setX(10);

       //---------------------------------------------
        $margenIzquierdo = 15; 
        $anchoImagen = 46; 
        $alturaImagen = 45; 
        $espacioDespuesImagen = 5; 
        $pdf->Image('http://localhost/ProyectoDSW/public/img/system/LogoBoleta.jpg', $margenIzquierdo, 10, $anchoImagen, $alturaImagen); 
        $pdf->SetY(10 + $alturaImagen + $espacioDespuesImagen);
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7,'B U R G E R - F I S I',0,1);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,6,'Correo electronico: burgerfisi@gmail.com',0,1);
        $pdf->Cell(0,6,"Telefono: 123456789",0,1);

        $posicionYInicioContenidoDerecho = 10; 
        //---------------------------------------------
        $serie = $Boleta['serie'];
        $parte1 = substr($serie, 0, 3); 
        $parte2 = substr($serie, 3);  
        $serieNueva = $parte1 . '-' . $parte2;
        //---------------------------------------------
        $pdf->SetFont('Arial','B',12);
        $pdf->SetDrawColor(255, 255, 255);
        $pdf->SetTextColor(255, 255, 255); 
        $pdf->SetFillColor(5, 36, 52); 
        $anchoContenido = 85; 
        $posicionXCentrada = 110 + (85 - $anchoContenido) / 2;
        $pdf->SetXY($posicionXCentrada, $posicionYInicioContenidoDerecho);
        $alturaLinea = 6; 
        $contenidoBoleta = "\nR.U.C. Nro: 10123654789\nBOLETA DE VENTA ELECTRONICA\n".$serieNueva."\n ";
        $pdf->MultiCell($anchoContenido, $alturaLinea, $contenidoBoleta, 1, 'C', true);
        
        //-------------------------------------------
        $fechaHora = new DateTime($Boleta['fecha']);
        $fecha = $fechaHora->format('Y-m-d');
        $hora = $fechaHora->format('H:i');
         //-------------------------------------------
        $nombre = $Usuario['nombre'];
        $apellido = $Usuario['apellido'];
        $correo = $Usuario['correo'];
        $direccion = $Pedido['direccion'];
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial','',10); 
        $pdf->SetFillColor(249, 253, 228); 
        $nuevaPosY = $pdf->GetY() + 5; 
        $pdf->SetXY(110, $nuevaPosY); 
        $datosComprador = "\n    Fecha : ".$fecha."   Hora: ".$hora."\n    Nombres: ".$nombre." ".$apellido."\n    Direccion: ".$direccion."\n    Correo: ".$correo."\n ";
        $pdf->MultiCell(85, 6, $datosComprador, 1, 'L', true);
    
        $pdf->SetDrawColor(0, 0, 0);
       //----------------------------------------------------------------------------------------
        $posicionYDespuesDetallesEmpresa = $pdf->GetY() + 3;
        $pdf->setY($posicionYDespuesDetallesEmpresa);
        $pdf->setX(135);
        $pdf->Ln();
      
        $header = array("Cantidad", "Unidad", "Descripcion", "Precio(Unit)", "Total");

        //--------------------------------------------------------------------------------------
        $pdf->SetFillColor(5, 36, 52);  
        $pdf->SetTextColor(255, 255, 255); 
        $pdf->SetDrawColor(255, 255, 255);
        $w = array(20, 20, 80, 28, 32);
        foreach($header as $i => $col) {
            $pdf->Cell($w[$i], 7, $col, 1, 0, 'C', true);
        }
        $pdf->Ln();
        //-------------------------------------------------------------------------------------
        $pdf->SetFillColor(255, 255, 255);  
        $pdf->SetTextColor(0, 0, 0); 
        $total = 0;
        foreach($Platos as $row) {
            $pdf->Cell($w[0], 6, $row['cantidad'], 'LR', 0, 'C'); 
            $pdf->Cell($w[1], 6, 'Und', 'LR', 0, 'C'); 
            $pdf->Cell($w[2], 6, $row['nombre'], 'LR', 0, 'C'); 
            $pdf->Cell($w[3], 6, '$' . number_format($row['precio'], 2), 'LR', 0, 'C'); 
            $pdf->Cell($w[4], 6, '$' . number_format($row['total'], 2), 'LR', 0, 'R'); 
            $pdf->Ln();
            $total += $row['total']; 
        }
        //-------------------------------------------------------------------------------------
        $impuesto = $total * 0.18; 
        $subtotal = $total - $impuesto;
        $w2 = array(30, 30); 
       
        $anchoPagina = $pdf->GetPageWidth();
        $anchoTotales = $w2[0] + $w2[1];
        $posicionX = $anchoPagina - $anchoTotales - 15;
        
        $data2 = [
            ["SUB TOTAL", $subtotal],
            ["I.G.V", $impuesto],
            ["TOTAL", $total]
        ];
        $yposdinamic = $pdf->GetY() + 10;
        $pdf->SetY($yposdinamic);
        $pdf->SetFillColor(249, 253, 228); 
        foreach ($data2 as $row) {
            $pdf->SetXY($posicionX, $pdf->GetY());
            $pdf->Cell($w2[0], 6, $row[0], 1, 0, 'R', true);
            $pdf->Cell($w2[1], 6, "$ ".number_format($row[1], 2, ".", ","), 1, 0, 'R', true);
            $pdf->Ln();
        }

        $yposdinamic += (count($data2)*10);
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY($yposdinamic + 4);
        $pdf->setX(15);
        $pdf->Cell(5,$textypos,"OBSERVACIONES");
        $pdf->SetFont('Arial','',10);    
        $pdf->setY($yposdinamic + 10);
        $pdf->setX(15);
        $pdf->Cell(5,$textypos,"Representacion digital de la factura impresa.");

        $yposdinamic += 20 + 10; 
        $sizeQR = 32; 
        $anchoPagina = $pdf->GetPageWidth();
        $posicionXQR = ($anchoPagina - $sizeQR) / 2;
        $pdf->Image('http://localhost/ProyectoDSW/public/img/system/QRcode.png', $posicionXQR, $yposdinamic, $sizeQR, $sizeQR);

        $yposdinamic += $sizeQR + 1; 
        $mensajeAgradecimiento = "!! Gracias por su compra !!";
        $pdf->SetFont('Arial', '', 8); 
        $anchoTexto = $pdf->GetStringWidth($mensajeAgradecimiento) + 2; 
        $posicionXTexto = ($anchoPagina - $anchoTexto) / 2; 
        $pdf->SetXY($posicionXTexto, $yposdinamic);
        $pdf->Cell($anchoTexto, 10, $mensajeAgradecimiento , 0, 0, 'C');

        $pdf->Output('I', 'boleta_ventas.pdf');

       }
    }
?>