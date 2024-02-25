<?php
//session_start(); 

class formPagos{
    public function formPagoPayPal($totalGeneral){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="https://www.paypal.com/sdk/js?client-id=ASUkPLxP2DaYls3LtDnqrmNgwobA5eSWMPzE3SnDQ0pkp02fGn2pEGMbgyrmezX-EsJaMgiQf8qWdeXf&currency=USD"></script>
                <!--  &currency=USD-->
            </head>
            <body>
                <div>
                    <h1>Detalles de Pago</h1>
                    <h3>Precio Total: <?php echo $totalGeneral; ?></h3>

                    <label for="direccion">Dirección de Envío:</label>
                    <input type="text" id="direccion" name="direccion"><br>

                </div>

                <div id="paypal-button-container" style="max-width:1000px;"></div>

                <script>
                    // Desactivar el botón de PayPal inicialmente
                    document.getElementById('paypal-button-container').style.pointerEvents = 'none';

                    // Escuchar el evento de cambio en el campo de dirección
                    document.getElementById('direccion').addEventListener('input', function() {
                        var direccion = this.value.trim(); // Obtener el valor de la dirección

                        // Si la dirección está vacía, desactivar el botón de PayPal; de lo contrario, activarlo
                        if (direccion === '') {
                            document.getElementById('paypal-button-container').style.pointerEvents = 'none';
                        } else {
                            document.getElementById('paypal-button-container').style.pointerEvents = 'auto';
                        }
                    });

                    paypal.Buttons({
                        style:{
                            color: 'blue',
                            shape: 'pill',
                            label: 'pay'
                        },
                        createOrder: function(data, actions){
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        //valor de compra
                                        value: <?php echo $totalGeneral; ?>
                                    }
                                }]
                            });
                        },
                        onCancel: function(data){
                            Swal.fire({
                            icon: "error",
                            title: "No se realizo el pago",
                            showConfirmButton: false,
                            timer: 1500
                            });
                            console.log(data);
                        },
                        onApprove: function(data, actions){
                            actions.order.capture().then(function (detalles){
                                
                                if(detalles.status == 'COMPLETED'){
                                    Swal.fire({
                                        title: "¡Excelente!",
                                        text: "El pago se ha realizado correctamente",
                                        icon: "success",
                                        confirmButtonText: "Aceptar"
                                        }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "http://localhost/ProyectoDSW/controllers/client/controlPago.php";
                                        }
                                    });
                                }
                                //console.log(detalles);//VER LOS DETALLES DE LA COMPRA
                            });  
                        }
                        
                    }).render('#paypal-button-container');
                </script>

            </body>
            </html>
        <?php
    }

    public function formDetallesCompra($totalGeneral){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <h1>Detalles de Pago</h1>
                <p>Precio Total: <?php echo $totalGeneral; ?></p>

                <label for="direccion">Dirección de Envío:</label>
                <input type="text" id="direccion" name="direccion"><br>

            </body>
            </html>
        <?php
    }


}        
?>



