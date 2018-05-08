$(document).ready(function() {
    load();
});

function load() {
    chartBar();
    charPie();
    chartLine();
    getConsumoDia();
    getCajaChicaDia();
    getTopFive();
    getTopTen();
    topFiveTorta();
    chartBar();
    chartLine();
    consumoMesGrafica();
}

function getConsumoDia(){
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getConsumoDia.php",
        success: function(data) {
            $('#consumo-dia').html('$' + data.data[0].total);
        }
    });
}

function getCajaChicaDia(){
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getCajaChicaDia.php",
        success: function(data) {
            $('#caja-chica-dia').html('$' + data.data[0].total);
        }
    });
}

function getTopFive() {
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getTopFive.php",
        success: function(data) {
            var total = 0;
            for (var i = 0; i < data.data.length; i++) {
                total += data.data[i].maxPro;
            }
            $('#topFive').html(total);
        }
    });
 }

 function getTopTen() {
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getTopTenMes.php",
        success: function(data) {
            var total = 0;
            for (var i = 0; i < data.data.length; i++) {
                total += data.data[i].maxPro;
            }
            $('#topTen').html(total);
        }
    });
 }

 function topFiveTorta() {
    var datos = [];
    var labels = [];
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getTopFive.php",
        success: function(data) {
            for (var i = 0; i < data.data.length; i++) {
                datos.push(data.data[i].maxPro);
                labels.push(data.data[i].nombre_producto)
            }
            graficoTorta(datos, labels);
        }
    });
 }
 
 function graficoTorta(datos, labels) {
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: datos,
                backgroundColor: [
                    "red",
                    "orange",
                    "yellow",
                    "green",
                    "blue",
                ],
                label: 'Dataset 1'
            }],
            labels: labels
        },
        options: {
            responsive: true
        }
    };
    var ctx = document.getElementById("chart-pie").getContext('2d');
    var myChart = new Chart(ctx, config);
 
 }


 function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
 }
 
 function chartBar() {
    var datos = [];
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getTopTenMes.php",
        data: "id=1",
        success: function(data) {
            var datos = data.data;
            if (datos.length > 0) {
                var ctx = document.getElementById("myChartBar").getContext('2d');
                var labels = [];
                var datasets = [];
                for (var i = 0; i < datos.length; i++) {
                    labels.push(datos[i].fecha);
                    datasets.push({
                        label: datos[i].nombre_producto,
                        backgroundColor: getRandomColor(),
                        borderWidth: 1,
                        data: [datos[i].maxPro]
                    })
                }
                console.log(labels);
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        }
    });
 }


function charPie() {
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                ],
                backgroundColor: [
                    "red",
                    "orange",
                    "yellow",
                    "green",
                    "blue",
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Red',
                'Orange',
                'Yellow',
                'Green',
                'Blue'
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('chart-torta').getContext('2d');
        window.myPie = new Chart(ctx, config);
    };
}

function chartLine() {
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getCajaChicaMes.php",
        data: "id=1",
        success: function(data) {
            var datos = data.data;
            var labels = [];
            var label = '';
            var valores = [];
            if (datos.length > 0) {
                for (var i = 0; i < datos.length; i++) {
                    switch (datos[i].mes) {
                        case 1:
                            label = 'Enero'
                            break;
                        case 2:
                            label = 'Febrero'
                            break;
                        case 3:
                            label = 'Marzo'
                            break;
                        case 4:
                            label = 'Abril'
                            break;
                        case 5:
                            label = 'Mayo'
                            break;
                        case 6:
                            label = 'Junio'
                            break;
                        case 7:
                            label = 'Julio'
                            break;
                        case 8:
                            label = 'Agosto'
                            break;
                        case 9:
                            label = 'Septiembre'
                            break;
                        case 10:
                            label = 'Octubre'
                            break;
                        case 11:
                            label = 'Noviembre'
                            break;
                        case 12:
                            label = 'Diciembre'
                            break;
                        default:
                            break;
                    }
                    labels.push(label);
                    valores.push(datos[i].total);
                }
                new Chart(document.getElementById("chart-line"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: valores,
                            label: "Caja Chica Mes",
                            borderColor: "#3e95cd",
                            fill: false
                        }]
                    }
                });
            }
        }
    });
 }

 function consumoMesGrafica() {
    $.ajax({
        type: "GET",
        url: "http://proconty.com/API/bms/kpi/getConsumoMes.php",
        data: "id=1",
        success: function(data) {
            var datos = data.data;
            var labels = [];
            var label = '';
            var valores = [];
            if (datos.length > 0) {
                for (var i = 0; i < datos.length; i++) {
                    switch (datos[i].mes) {
                        case 1:
                            label = 'Enero'
                            break;
                        case 2:
                            label = 'Febrero'
                            break;
                        case 3:
                            label = 'Marzo'
                            break;
                        case 4:
                            label = 'Abril'
                            break;
                        case 5:
                            label = 'Mayo'
                            break;
                        case 6:
                            label = 'Junio'
                            break;
                        case 7:
                            label = 'Julio'
                            break;
                        case 8:
                            label = 'Agosto'
                            break;
                        case 9:
                            label = 'Septiembre'
                            break;
                        case 10:
                            label = 'Octubre'
                            break;
                        case 11:
                            label = 'Noviembre'
                            break;
                        case 12:
                            label = 'Diciembre'
                            break;
                        default:
                            break;
                    }
                    labels.push(label);
                    valores.push(datos[i].total);
                }
                new Chart(document.getElementById("chart-area"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: valores,
                            label: "Consumo Mes",
                            borderColor: getRandomColor(),
                            fill: true
                        }]
                    },
                    options: {
                        elements: {
                            line: {
                                tension: 0.6
                            }
                        }
                    }
                });
            }
        }
    });
 }