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

        <script>
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
                    });  
                }
                
            }).render('#paypal-button-container');
        </script>

    </body>
    </html>

    <?php
    }

}        
?>






