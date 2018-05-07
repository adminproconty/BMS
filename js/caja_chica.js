$(document).ready(function() {
    load(1);
});

function load(page) {
    $("#loader").fadeIn('slow');
    var inicio = $('#inicio').val();
    var fin = $('#fin').val();
    if (inicio == '') {
        inicio = '2000-01-01';
    }
    if (fin == '') {
        fin = '3000-01-01';
    }
    //alert('inicio ' + inicio + ' fin ' + fin);
    $.ajax({
        url: './ajax/buscar_caja_chica.php?action=ajax&page=' + page + '&inicio=' + inicio + '&fin=' + fin,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
        }
    })
}

$('#desde').change(function() {
    var fecha = '' + this.value + '';
    $('#inicio').val(fecha);
});

$('#hasta').change(function() {
    var fecha = '' + this.value + '';
    $('#fin').val(fecha);
});

$("#btn_consultar").click(function() {
    load(1);
});