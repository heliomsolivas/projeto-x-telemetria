<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Gráfico dos Sensores</title>

        <script src="lib/jquery.min.js"></script>
        <script type="text/javascript">
        
        var chartTemperatura; // global
        var chart2;
        var chart3;
        var chart4;
        
        
        function requestData() {
    $.ajax({
        url: 'consultaTemperatura.php',
        success: function(point) {
        
            var series = chart.series[0],
                shift = series.data.length > 10; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart.series[0].addPoint(point, true, shift);
           
            
            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}

function requestData2() {
    $.ajax({
        url: 'consultaAltitude.php',
        success: function(point) {
        
            var series = chart2.series[0],
                shift = series.data.length > 10; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart2.series[0].addPoint(point, true, shift);
            
            
            // call it again after one second
            setTimeout(requestData2, 1000);    
        },
        cache: false
    });
}

function requestData3() {
    $.ajax({
        url: 'consultaEixos.php',
        success: function(point) {
        
            var series = chart3.series[0],
                shift = series.data.length > 10; // shift if the series is 
                                                 // longer than 20

            // add the point
            console.log(point);
            chart3.series[0].addPoint(point[0], true, shift);
            chart3.series[1].addPoint(point[1], true, shift);
            chart3.series[2].addPoint(point[2], true, shift);
            
            
            
            // call it again after one second
            setTimeout(requestData3, 1000);    
        },
        cache: false
    });
}

function requestData4() {
    $.ajax({
        url: 'consultaAceleracao.php',
        success: function(point) {
        
            var series = chart4.series[0],
                shift = series.data.length > 10; // shift if the series is 
                                                 // longer than 20

            // add the point
            chart4.series[0].addPoint(point[0], true, shift);
            chart4.series[1].addPoint(point[1], true, shift);
            chart4.series[2].addPoint(point[2], true, shift);
            
            
            
            // call it again after one second
            setTimeout(requestData4, 1000);    
        },
        cache: false
    });
}


$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Sensor de Temperatura'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Temperatura (°C)',
                margin: 20
            }
        },
        series: [{
            name: 'Temperatura',
            data: []
        }]
    });     
    
    
    
    chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'container2',
            defaultSeriesType: 'spline',
            events: {
                load: requestData2
            }
        },
        title: {
            text: 'Sensor de Altitude'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Altitude (m)',
                margin: 20
            }
        },
        series: [{
            name: 'Altitude',
            data: []
        }]
    });   
    
    chart3 = new Highcharts.Chart({
        chart: {
            renderTo: 'container3',
            defaultSeriesType: 'spline',
            events: {
                load: requestData3
            }
        },
        title: {
            text: 'Sensor de Eixos'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Variação (Graus °)',
                margin: 20
            }
        },
        series: [{
            name: 'Eixo X',
            data: [],
            
        },
        {
            name: 'Eixo Y',
            data: []
        },
        {
            name: 'Eixo Z',
            data: []
        }
        ]
    }); 
    
    chart4 = new Highcharts.Chart({
        chart: {
            renderTo: 'container4',
            defaultSeriesType: 'spline',
            events: {
                load: requestData4
            }
        },
        title: {
            text: 'Sensor de Aceleração'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Aceleração (g)',
                margin: 20
            }
        },
        series: [{
            name: 'Aceleração X',
            data: [],
            
        },
        {
            name: 'Aceleração Y',
            data: []
        },
        {
            name: 'Aceleração Z',
            data: []
        }
        ]
    }); 
    
});



        </script>
<script src="lib/highcharts.js"></script>
  <script src="lib/exporting.js"></script>

<div id="container" style="width: 600px; height: 400px;float:left;"></div>
<div id="container2" style="width: 600px; height: 400px;float:left;"></div>
<div id="container3" style="width: 600px; height: 400px;float:left;"></div>
<div id="container4" style="width: 600px; height: 400px;float:left;"></div>