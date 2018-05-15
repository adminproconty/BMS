$('#nuevo_proveedor').submit(function(event) {
    $('#btn-guardar').attr("disabled", true);
    var datos = {
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
        activo: 1
    }
    if (datos.nota_pedido == 'no') {
        datos.nota_pedido = 0;
    } else {
        datos.nota_pedido = 1;
    }
    if (datos.parte_relacionada == 'no') {
        datos.parte_relacionada = 0;
    } else {
        datos.parte_relacionada = 1;
    }
    if (datos.automatico_datil == 'no') {
        datos.automatico_datil = 0;
    } else {
        datos.automatico_datil = 1;
    }
    console.log('datos', datos);
    $.ajax({
        url: 'http://proconty.com/API/bms/proveedor/insert.php',
        dataType: 'json',
        type: 'post',
        contentType: 'application/json',
        data: JSON.stringify(datos),
        processData: false,
        success: function(data, textStatus, jQxhr) {
            var resp = JSON.stringify(data);
            if (resp == 'true') {
                alert('Proveedor ha sido ingresado satisfactoriamente!')
            } else {
                alert('Error, por favor verifique su conectividad a la base de datos e intente de nuevo')
            }
            $('#btn-guardar').attr("disabled", false);
        },
        error: function(jqXhr, textStatus, errorThrown) {
            console.log(JSON.stringify(errorThrown));
            $('#btn-guardar').attr("disabled", false);
        }
    });
    event.preventDefault();
    $('#nombre_pro').val('');
    $('#ruc_pro').val('');
    $('#mail_pro').val('');
    $('#direccion_pro').val('');
    $('#celular_pro').val('');
    $('#convencional_pro').val('');
    $('#opcional_pro').val('');
    $('#credito_pro').val('');
    $('#web_pro').val('');
    $('#contacto_pro').val('');
});