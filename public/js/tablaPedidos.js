$(document).ready(function(){
    // Función para cargar la tabla de pedidos
    function cargarTabla(){
        $.ajax({
            url: 'http://localhost/ProyectoDSW/controllers/admin/controlPedidos.php',
            type: 'post',
            data: {action: 'cargarTabla'},
            success:function(response){
                // Actualiza el contenido de la tabla con la respuesta del servidor
                $('#tabla_datos').html(response);
            }
        });
    }

    // Función para cambiar el estado de un pedido al siguiente
    window.siguienteEstado=function(id){
        $.ajax({
            url: 'http://localhost/ProyectoDSW/controllers/admin/controlPedidos.php',
            type: 'post',
            data: {action: 'sigEstado', id: id},
            success:function(response){
                // Después de cambiar el estado, vuelve a cargar la tabla actualizada
                cargarTabla();
            }
        });
    }

    // Función para obtener detalles de un pedido específico
    window.detallePedido=function(id){
        $.ajax({
            url: 'http://localhost/ProyectoDSW/controllers/admin/controlPedidos.php',
            type: 'post',
            data: {action: 'detallePedido', id: id},
            success:function(response){
                // Parsea la respuesta JSON del servidor para obtener los detalles del pedido
                var detalle=JSON.parse(response);

                // Construye el contenido HTML para mostrar los detalles del pedido
                var htmlContent = '<ul>';
                detalle.forEach(function (detalleItem) {
                    htmlContent += '<li>Nombre: ' + detalleItem.nombre + '</li>';
                    // Puedes agregar más detalles según tus necesidades
                });
                htmlContent += '</ul>';

                // Muestra los detalles del pedido en la ventana emergente de Swal
                Swal.fire({
                    title: 'Detalles del Pedido',
                    html: htmlContent,
                    icon: 'info'
                });
            }
        });
    }

    // Cargar la tabla al cargar la página
    cargarTabla();
    // Actualizar la tabla cada 8 segundos
    setInterval(cargarTabla, 8000);

});