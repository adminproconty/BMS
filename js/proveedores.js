$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val();
    var datos = {
        ruc: "",
        nombre: ""
    };
    if (q != '') {
        datos = {
            ruc: q,
            nombre: q
        }
    }
    $.ajax({
        url: 'http://proconty.com/API/bms/proveedor/getById.php',
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        data: JSON.stringify(datos),
        processData: false,
        success: function(data, textStatus, jQxhr) {
            var resp = JSON.stringify(data);
            resp = JSON.parse(resp);
            cargar(resp.data, page);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.log(JSON.stringify(errorThrown));
        }
    });
}

function cargar(datos, pagina) {
    $.post("./ajax/proveedores.php", {
            data: datos,
            page: pagina
        },
        function(data, status) {
            $(".outer_div").html(data).fadeIn('slow');
            $('[data-toggle="tooltip"]').tooltip({ html: true });
        });
}

function obtener_datos(id) {
    var id_proveedor = $('#id_proveedor' + id).val();
    var ruc = $('#ruc' + id).val();
    var nombre = $('#nombre' + id).val();
    var direccion = $('#direccion' + id).val();
    var correo = $('#correo' + id).val();
    var celular = $('#celular' + id).val();
    var convencional = $('#convencional' + id).val();
    var opcional = $('#opcional' + id).val();
    var dias_credito = $('#dias_credito' + id).val();
    var web = $('#web' + id).val();
    var contacto = $('#contacto' + id).val();
    var nota_pedido = $('#nota_pedido' + id).val();
    var parte_relacionada = $('#parte_relacionada' + id).val();
    var automatico_datil = $('#automatico_datil' + id).val();
    var activo = $('#activo' + id).val();
    $('#id_proveedor').val(id_proveedor);
    $('#nombre_pro').val(nombre);
    $('#ruc_pro').val(ruc);
    $('#mail_pro').val(correo);
    $('#direccion_pro').val(direccion);
    $('#celular_pro').val(celular);
    $('#convencional_pro').val(convencional);
    $('#opcional_pro').val(opcional);
    $('#credito_pro').val(dias_credito);
    $('#web_pro').val(web);
    $('#contacto_pro').val(contacto);
    if (nota_pedido == 'no') {
        document.editar_proveedor.nota_pedido[1].checked = true;
    } else {
        document.editar_proveedor.nota_pedido[0].checked = true;
    }
    if (parte_relacionada == 'no') {
        document.editar_proveedor.parte_relacionada[1].checked = true;
    } else {
        document.editar_proveedor.parte_relacionada[0].checked = true;
    }
    if (parte_relacionada == 'no') {
        document.editar_proveedor.automatico[1].checked = true;
    } else {
        document.editar_proveedor.automatico[0].checked = true;
    }
    $('#mod_estado').val(activo);
}

$('#editar_proveedor').submit(function(event) {
    $('#actualizar_proveedor').attr("disabled", true);
    var datos = {
        id_proveedor: $('#id_proveedor').val(),
        nombre: $('#nombre_pro').val(),
        ruc: $('#ruc_pro').val(),
        correo: $('#mail_pro').val(),
        direccion: $('#direccion_pro').val(),
        celular: $('#celular_pro').val(),
        convencional: $('#convencional_pro').val(),
        opcional: $('#opcional_pro').val(),
        dias_credito: $('#credito_pro').val(),
        web: $('#web_pro').val(),
        contacto: $('#contacto_pro').val(),
        nota_pedido: $('input:radio[name=nota_pedido]:checked').val(),
        parte_relacionada: $('input:radio[name=parte_relacionada]:checked').val(),
        automatico_datil: $('input:radio[name=automatico]:checked').val(),
        activo: $('#mod_estado').val()
    }
    if (datos.nota_pedido == 'no') {
        datos.nota_pedido = "0";
    } else {
        datos.nota_pedido = "1";
    }
    if (datos.parte_relacionada == 'no') {
        datos.parte_relacionada = "0";
    } else {
        datos.parte_relacionada = 1;
    }
    if (datos.automatico_datil == 'no') {
        datos.automatico_datil = "0";
    } else {
        datos.automatico_datil = "1";
    }
    var html = '';
    $.ajax({
        url: 'http://proconty.com/API/bms/proveedor/update.php',
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        data: JSON.stringify(datos),
        processData: false,
        success: function(data, textStatus, jQxhr) {
            var resp = JSON.stringify(data);
            if (resp == 'true') {
                html = '<div class="alert alert-success" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong>¡Bien hecho!</strong>' +
                    '   Proveedor ha sido modificado exitosamente  ' +
                    '</div>';
                $("#resultados_ajax2").html(html);
            } else {
                html = '<div class="alert alert-warning" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong>¡Ooops!</strong>' +
                    '   Verifique que están correctos los datos e intente de nuevo  ' +
                    '</div>';
                $("#resultados_ajax2").html(html);
            }
            $('#actualizar_proveedor').attr("disabled", false);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.log(JSON.stringify(errorThrown));
            $('#actualizar_proveedor').attr("disabled", false);
            html = '<div class="alert alert-danger" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>¡Ooops!</strong>' +
                '   Verifique que se encuentra conectado a internet o Base de Datos correctamente, e intente de nuevo  ' +
                '</div>';
            $("#resultados_ajax2").html(html);
        }
    });
    load(1);
    event.preventDefault();
});



function eliminar(id) {
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar la factura")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_facturas.php",
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