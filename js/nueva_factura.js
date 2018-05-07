$(document).ready(function() {
    load(1);
    init(1);
    localStorage.setItem('descuento', 0);
    localStorage.setItem('aplica_descuento', 0);
});

function load(page) {
    init(page);
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/productos_factura.php?action=ajax&page=' + page + '&q=' + q + '&nombre_empresas=' + nombre_empresas,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

function init(page) {
    var q = $("#search").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/consultar_productos.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".productos").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

function agregar(id) {
    var precio_venta = document.getElementById('precio_venta_' + id).value;
    var cantidad = document.getElementById('cantidad_' + id).value;
    var aplica_descuento = $('input:radio[name=aplica_descuento]:checked').val();
    var aplica_iva = $('input:radio[name=aplica_iva]:checked').val();
    //alert("aplica " + aplica_iva);
    //Inicia validacion
    if (isNaN(cantidad)) {
        alert('Esto no es un numero');
        document.getElementById('cantidad_' + id).focus();
        return false;
    }
    if (isNaN(precio_venta)) {
        alert('Esto no es un numero');
        document.getElementById('precio_venta_' + id).focus();
        return false;
    }
    //Fin validacion

    $.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id + "&precio_venta=" + precio_venta + "&cantidad=" + cantidad + "&aplica_descuento=" + aplica_descuento + "&aplica_iva=" + aplica_iva,
        beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados").html(datos);
            var gasto_tarjeta = $('#gastos_tarjeta').val() * 1;
            var iva_tarjeta = gasto_tarjeta * $('input:radio[name=aplica_iva]:checked').val();
            var total_gasto_tarjeta = gasto_tarjeta + iva_tarjeta;
            var aplica_descuento = localStorage.getItem("aplica_descuento");
            var total_factura = localStorage.getItem("total_factura");
            if (aplica_descuento == 0) {
                total_gasto_tarjeta = total_gasto_tarjeta;
            } else {
                var por_descuento = $('#descuento_cliente').val() / 100;
                var descuento = total_gasto_tarjeta * por_descuento;
                total_gasto_tarjeta = total_gasto_tarjeta - descuento;
            }
            var gastos_producto = (total_factura - total_gasto_tarjeta).toFixed(2);
            $("#gastos_producto").val(gastos_producto);
        }
    });
}

$('#guardar_tarjeta').submit(function(event) {
    var precio_venta = document.getElementById('monto').value;
    var aplica_descuento = $('input:radio[name=aplica_descuento]:checked').val();
    var aplica_iva = $('input:radio[name=aplica_iva]:checked').val();
    $.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id=1&precio_venta=" + precio_venta + "&cantidad=1&tarjeta=0" + "&aplica_descuento=" + aplica_descuento + "&aplica_iva=" + aplica_iva,
        beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados").html(datos);
        }
    });
    event.preventDefault();
});

function eliminar(id) {
    var aplica_descuento = $('input:radio[name=aplica_descuento]:checked').val();
    var aplica_iva = $('input:radio[name=aplica_iva]:checked').val();
    $.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id + "&aplica_descuento=" + aplica_descuento + "&aplica_iva=" + aplica_iva,
        beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados").html(datos);
            var gasto_tarjeta = $('#gastos_tarjeta').val() * 1;
            var iva_tarjeta = gasto_tarjeta * $('input:radio[name=aplica_iva]:checked').val();
            var total_gasto_tarjeta = gasto_tarjeta + iva_tarjeta;
            var aplica_descuento = localStorage.getItem("aplica_descuento");
            var total_factura = localStorage.getItem("total_factura");
            if (aplica_descuento == 0) {
                total_gasto_tarjeta = total_gasto_tarjeta;
            } else {
                var por_descuento = $('#descuento_cliente').val() / 100;
                var descuento = total_gasto_tarjeta * por_descuento;
                total_gasto_tarjeta = total_gasto_tarjeta - descuento;
            }
            var gastos_producto = (total_factura - total_gasto_tarjeta).toFixed(2);
            $("#gastos_producto").val(gastos_producto);
        }
    });

}

function actualiza_dsco(id) {
    var aplica_descuento = $('input:radio[name=aplica_descuento]:checked').val();
    var aplica_iva = $('input:radio[name=aplica_iva]:checked').val();
    //alert ("iva " + aplica_iva);
    if (aplica_descuento == 0) {
        localStorage.setItem('aplica_descuento', 0);
    } else {
        localStorage.setItem('aplica_descuento', 1);
    }
    $.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id=" + id + "&aplica_descuento=" + aplica_descuento + "&aplica_iva=" + aplica_iva,
        beforeSend: function(objeto) {
            $("#resultados").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados").html(datos);
            var gasto_tarjeta = $('#gastos_tarjeta').val() * 1;
            var iva_tarjeta = gasto_tarjeta * $('input:radio[name=aplica_iva]:checked').val();
            var total_gasto_tarjeta = gasto_tarjeta + iva_tarjeta;
            var aplica_descuento = localStorage.getItem("aplica_descuento");
            var total_factura = localStorage.getItem("total_factura");
            if (aplica_descuento == 0) {
                total_gasto_tarjeta = total_gasto_tarjeta;
            } else {
                var por_descuento = $('#descuento_cliente').val() / 100;
                var descuento = total_gasto_tarjeta * por_descuento;
                total_gasto_tarjeta = total_gasto_tarjeta - descuento;
            }
            var gastos_producto = (total_factura - total_gasto_tarjeta).toFixed(2);
            $("#gastos_producto").val(gastos_producto);
        }
    });
}


$("#datos_factura").submit(function(event) {
    
    var cupo = $('#saldo_cliente').val() * 1;
    var cantidad_productos = localStorage.getItem('cantidad_productos');
    var gasto_tarjeta = $('#gastos_tarjeta').val() * 1;
    var iva_tarjeta = gasto_tarjeta * aplica_iva;
    var total_gasto_tarjeta = gasto_tarjeta + iva_tarjeta;
    var aplica_descuento = localStorage.getItem("aplica_descuento");
    var total_factura = localStorage.getItem("total_factura");
    var aplica_tarjeta = $('input[name="aplica_tarjeta"]:checked').val();
    var aplica_iva = $('input[name="aplica_iva"]:checked').val();

    //alert("iva " + aplica_iva);
    if (aplica_descuento == 0) {
        total_gasto_tarjeta = total_gasto_tarjeta;
    } else {
        var por_descuento = $('#descuento_cliente').val() / 100;
        var descuento = total_gasto_tarjeta * por_descuento;
        total_gasto_tarjeta = total_gasto_tarjeta - descuento;
    }
    if (cantidad_productos < 1) {
        alert('Debe seleccionar productos para proceder la compra');
        event.preventDefault();
    }
    var gastos_producto = (total_factura - total_gasto_tarjeta).toFixed(2);

    if (aplica_tarjeta != "no") {
        if (cupo < gastos_producto) {
            alert('Saldo insuficiente, por favor, comprar una tarjeta');
            event.preventDefault();
        }
    }


});

$("#guardar_cliente").submit(function(event) {
    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/nuevo_cliente.php",
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

$("#guardar_producto").submit(function(event) {
    $('#guardar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/nuevo_producto.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax_productos").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax_productos").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})

$('#getproductos').click(function() {
    load(1);
});

$('#addproducto').click(function() {

    id_cliente = $('#id_cliente').val();

    if (id_cliente != '') {
        nombre_empresas = $('#nombre_empresas').val();
        //descuento = $('#descuento_cliente').val();
        load(1);
    } else {
        alert("Debe Seleccionar un Cliente");
        return false;
    }

});