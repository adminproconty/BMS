function reportes($id) {
    var tipo_reporte = document.getElementById("select_reporte").value;
    //alert ("tipo " + tipo_reporte);

    if (tipo_reporte == "") {
        alert('Seleccione un Reporte');
        return false;
    } else if (tipo_reporte == "cierre") {
        if ($('#fecha_ini').val() == "") {
            alert('Ingrese Fecha Desde');
            return false;
        }
        if ($('#fecha_fin').val() == "") {
            alert('Ingrese Fecha Hasta');
            return false;
        }

        var desde = $('#fecha_ini').val();
        var hasta = $('#fecha_fin').val();

        //printJS('./pdf/documentos/Factura.pdf');

        window.open('./pdf/documentos/cierre_caja.php?fecha_ini=' + desde + '&fecha_fin=' + hasta, 'Factura', '', '1024', '768', 'true');
    } else if (tipo_reporte == "kardex") {
        if ($('#fecha_ini').val() == "") {
            alert('Ingrese Fecha Desde');
            return false;
        }
        if ($('#fecha_fin').val() == "") {
            alert('Ingrese Fecha Hasta');
            return false;
        }

        var desde = $('#fecha_ini').val();
        var hasta = $('#fecha_fin').val();

        //printJS('./pdf/documentos/Factura.pdf');

        window.open('./pdf/documentos/reporte_kardex.php?fecha_ini=' + desde + '&fecha_fin=' + hasta, 'Factura', '', '1024', '768', 'true');
    }else if (tipo_reporte == "detalle_prod") {
        if ($('#fecha_ini').val() == "") {
            alert('Ingrese Fecha Desde');
            return false;
        }
        if ($('#fecha_fin').val() == "") {
            alert('Ingrese Fecha Hasta');
            return false;
        }

        var desde = $('#fecha_ini').val();
        var hasta = $('#fecha_fin').val();

        //printJS('./pdf/documentos/Factura.pdf');

        window.open('./pdf/documentos/reporte_detalle_prod.php?fecha_ini=' + desde + '&fecha_fin=' + hasta, 'Factura', '', '1024', '768', 'true');
    }
}