var tablaModule = {
    cargarTabla: function () {
        $.ajax({
            url: '/ProyectoDSW/controllers/admin/controlPedidos.php',
            type: 'post',
            data: { action: 'cargar_tabla' },
            success: function (response) {
                $('#tabla_datos').html(response);
            }
        });
    },

    actualizarTablaPeriodicamente: function () {
        // Actualizar la tabla cada 5 segundos
        setInterval(tablaModule.cargarTabla, 10000);
    },

    eliminarRegistro: function (id) {
        if (confirm('¿Estás seguro de que quieres eliminar este registro?')) {
            $.ajax({
                url: 'controlPedidos.php',
                method: 'POST',
                data: { action: 'eliminar', id: id },
                success: function (response) {
                    // Aquí puedes manejar la respuesta si es necesario
                    tablaModule.cargarTabla(); // Vuelve a cargar la tabla después de eliminar
                }
            });
        }
    }
};

// Esperar a que el documento esté completamente cargado
$(document).ready(function () {
    // Cargar la tabla al cargar la página
    tablaModule.cargarTabla();

    // Actualizar la tabla periódicamente
    tablaModule.actualizarTablaPeriodicamente();
});