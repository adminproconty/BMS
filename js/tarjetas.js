$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_tarjetas.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function eliminar(id) {
    var q = $("#q").val();
    if (confirm("¿Realmente deseas cancelar la subscripción de esta tarjeta?, no podrá acceder a estos fondos nuevamente")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_tarjetas.php",
            data: "id=" + id,
            "q": q,
            beforeSend: function(objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}

$("#guardar_tarjeta").submit(function(event) {
    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/nueva_tarjeta.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})

function obtener_datos(id) {
    var id_tarjetas = $("#id_tarjetas" + id).val();
    var codigo_tarjetas = $("#codigo_tarjetas" + id).val();
    var nombre_cliente = $("#nombre_cliente" + id).val();
    var monto_tarjetas = $("#monto_tarjetas" + id).val();
    var estatus_tarjetas = $("#estatus_tarjetas" + id).val();
    var nombre_estatus = $("#nombre_estatus" + id).val();

    $("#mod_id_tarjetas").val(id_tarjetas);
    $("#mod_codigo").val(codigo_tarjetas);
    $("#mod_cliente").val(nombre_cliente);
    $("#mod_monto").val(monto_tarjetas);
    $("#mod_estado").val(estatus_tarjetas);
}

$("#editar_tarjeta").submit(function(event) {
    $('#actualizar_tarjeta').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/editar_tarjeta.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_tarjeta').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})

function generarCodigo(id) {
    $.ajax({
        type: "GET",
        url: "./ajax/generar_codigo_tarjeta.php",
        data: "id=" + id,
        success: function(datos) {
            alert('codigo ' + datos);
        }
    });
}