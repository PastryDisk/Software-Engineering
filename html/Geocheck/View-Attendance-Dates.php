<html>
<head>
    <html lang="en"><head>
        <title>Geocheck</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Geocheck Team">
        <meta name="description" content="StudentClasses">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            <?php
            include "./css/navbar.css";
            include "./css/View-Classes-P.css";
            ?>
        </style>
    </head>
<body>
<?php
include "./html/navbarP.html";
?>

<div class="main">
    <div class="wrapperTable">
        <header>My Dates</header>
        <table style="width: auto; height: 50vh; overflow: scroll; text-align: center">
            <tr><th style="text-align: center">Date</th><th style="text-align: center">View Attendance</th></tr>
            <br><br><br><br>

            <?php
            session_start();
            $crn = $_GET['id'];

            //Database Information
            $host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
            $username = "admin";
            $password = "GeoCheckSoftware1234";
            $dbname = "mydb";
            $port = 3306;
            $conn = mysqli_connect($host, $username, $password, $dbname, $port);

            // Building query
            $query = "CALL viewAttendanceDatesP($crn)";
            $result = mysqli_query($conn, $query);
            $counter = 0;
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                while ($counter < $result->num_rows) {
                    echo "<tr>";
                    echo " <td> " . $row["ATTENDANCE_DATETIME"] .
                        " </td><td> " ."<a href='./View-Attendance-P.php?id=".$row['ATTENDANCE_ID']."'><button type='button' class='viewButton'>View</button></a>" .
                        "</td>" .
                        "</tr>";
                    $counter++;
                    $row = $result->fetch_assoc();
                }
            } else {
                echo " <tr><td colspan='2'> No Dates</td></tr>";
            } ?>
        </table>
    </div>
</div>

</body>
</html>
