<?php
//session_start(); 
class formPagos{

    public function formPagoPayPal($totalGeneral){
        $carrito = json_encode($_SESSION['carrito']); 
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Realizar Pedido</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/ProyectoDSW/public/css/realizarPedido.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://www.paypal.com/sdk/js?client-id=ASUkPLxP2DaYls3LtDnqrmNgwobA5eSWMPzE3SnDQ0pkp02fGn2pEGMbgyrmezX-EsJaMgiQf8qWdeXf&currency=USD"></script>
    </head>
    <body>
        <div class="PanelPedido">
            <h1>Detalles de Pago</h1>
            <h3>Precio Total: <?php echo $totalGeneral; ?></h3>

            <label for="direccion">Dirección de Envío:</label>
            <input type="text" id="direccion" name="direccion"><br>
        </div>

        <div class="button-container">
            <div id="paypal-button-container" class="paypal-buttons-container"></div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            document.getElementById('paypal-button-container').style.pointerEvents = 'none';
            document.getElementById('direccion').addEventListener('input', function() {
            var direccion = this.value.trim(); 
                if (direccion === '') {
                document.getElementById('paypal-button-container').style.pointerEvents = 'none';
                } else {
                    document.getElementById('paypal-button-container').style.pointerEvents = 'auto';
                }
            });

            var carrito = <?php echo $carrito; ?>; 
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
                onApprove: async function(data, actions) { 
                const detalles = await actions.order.capture();
                if (detalles.status == 'COMPLETED') {
                    var direccionEnvio = document.getElementById('direccion').value;
                        $.ajax({
                                url: 'http://localhost/ProyectoDSW/controllers/client/controlGuardarPedido.php',
                                type: 'POST',
                                contentType: 'application/json',
                                data: JSON.stringify({
                                    direccion: direccionEnvio,
                                    totalGeneral: <?php echo $totalGeneral; ?>                                     
                                }),
                                success: function(response) {
                                    Swal.fire({
                                        title: "¡Excelente!",
                                        text: "El pago se ha realizado correctamente",
                                        icon: "success",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Aceptar",
                                        cancelButtonText: "Visualizar boleta"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "http://localhost/ProyectoDSW/controllers/client/controlPago.php";
                                        }else if (result.dismiss === Swal.DismissReason.cancel)
                                        {
                                            window.open("http://localhost/ProyectoDSW/controllers/client/controlBoleta.php", '_blank');
                                            Swal.fire({
                                                title: "Boleta Abierta",
                                                text: "Se abrió su boleta en otra pestaña.",
                                                icon: "info",
                                                confirmButtonText: "Aceptar",
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = "http://localhost/ProyectoDSW/controllers/client/controlPago.php";
                                                    } 
                                                });              
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                }
                            });
                    }
                }
            }).render('#paypal-button-container');
        </script>

    </body>
    </html>

    <?php
    }

}        
?>






