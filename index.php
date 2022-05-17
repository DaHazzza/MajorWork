<!DOCTYPE html>
<html lang="en">
<head>
    <title>Major Work Scheduling site</title>
</head>
<link rel="stylesheet" href="styleSheet.css">
<script src='https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.js'></script>
<body style="margin:0%;"> 
    <?php


 include "includes/header.php";

    ?> <!-- creates the Naviation Bar-->
</body>
<canvas id='chart'></canvas>
<script>
    var canvasElement = document.getElementById('chart').getContext('2d');
    var testChart = new Chart(canvasElement,
    {
        type: 'line',
        data:{
            labels:['test1','test2'],
            datasets:[{
                lable:'e',
                data:[1,2,3]
            }]
        }

    })


</script>

