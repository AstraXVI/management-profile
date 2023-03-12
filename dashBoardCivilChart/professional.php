<?php
    require "../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- CHART NI RENZ -->


<div>

    <canvas id="myChart" style="width:100%;width: 420px; max-width:450px"></canvas>
    <!-- CSC - Professional -->
</div>
    <!-- GET NUMBER OF THAT USERS -->
        <?php
             // 80-85
             $qGetUsersNumber = "SELECT * FROM civil WHERE rating >= 80 AND rating <= 85.99 AND careerService='CSC - Professional'";
             $lUserNumber = $con->query($qGetUsersNumber);
             $fUserNumber = $lUserNumber->num_rows;
             // 85-90
             $qGetUsersNumber85_90 = "SELECT * FROM civil WHERE rating >= 86 AND rating <= 90.99 AND careerService='CSC - Professional'";
             $lUserNumber85_90 = $con->query($qGetUsersNumber85_90);
             $fUserNumber85_90 = $lUserNumber85_90->num_rows;
 
             // 90-95
             $qGetUsersNumber90_95 = "SELECT * FROM civil WHERE rating >= 91 AND rating <= 95.99 AND careerService='CSC - Professional'";
             $lUserNumber90_95 = $con->query($qGetUsersNumber90_95);
             $fUserNumber90_95 = $lUserNumber90_95->num_rows;
             // 95-100
             $qGetUsersNumber95_100 = "SELECT * FROM civil WHERE rating >= 96 AND rating <= 100 AND careerService='CSC - Professional'";
             $lUserNumber95_100 = $con->query($qGetUsersNumber95_100);
             $fUserNumber95_100 = $lUserNumber95_100->num_rows;
        ?>
    <!--  -->

    <script>
        var xValues = [0,"80-85", "86-90", "91-95", "96-100"];
        var yValues = [0,<?php echo $fUserNumber ?>,<?php echo $fUserNumber85_90 ?>,<?php echo $fUserNumber90_95 ?>,<?php echo $fUserNumber95_100 ?>];
        var barColors = ["red", "green","blue","orange","brown"];

        new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "CSC - Professional"
            }
        }
        });
    </script>
</body>
</html>