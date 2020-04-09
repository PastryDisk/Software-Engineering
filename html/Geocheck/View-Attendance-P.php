<html>
<head>
        <html lang="en"><head>
        <title>Geocheck</title>
        <meta name="author" content="Geocheck Team">
        <meta name="description" content="Create A Class">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
<?php
include "./css/navbar.css";
include "./css/View-Classes-S.css";
?>
</style>
</head>
<body>
<?php
include "./html/navbarP.html";
?>

<div class="main">
    <div class="wrapperTable">
        <header>My Attendance</header>
        <table style="width: auto; height: 50vh; overflow: scroll; text-align: center">
            <tr><th style="text-align: center">First Name</th><th style="text-align: center">Last Name</th><th style="text-align: center">Presence</th><th style="text-align: center">Edit Attendance</th></tr>
            <br><br><br><br>

            <?php
            session_start();
            $attendanceID = $_GET['id'];

            //Database Information
            $host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
            $username = "admin";
            $password = "GeoCheckSoftware1234";
            $dbname = "mydb";
            $port = 3306;
            $conn = mysqli_connect($host, $username, $password, $dbname, $port);
            $presence = "";

            // Building query
            $query = "CALL viewAttendanceP($attendanceID)";
            $result = mysqli_query($conn, $query);
            $counter = 0;
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                while ($counter < $result->num_rows) {
                    // Separating present from absent
                    if ($row["ATT_REC_PRESENT"] == 1) {
                        $presence = "Present";
                        echo "<td>" . $row["STU_FNAME"] .
                            "</td><td>" . $row["STU_LNAME"] .
                            "</td><td style='color:green'>" . $presence .
                            "</td><td><a href='./php/ChangePresence.php?id=".$attendanceID."&stuID=".$row['STU_ID']."'><button type='button' class='viewButton'>Change</button></a>" .
                            "</td>" .
                            "</tr>";
                    } else {
                        $presence = "Absent";
                        echo "<td>" . $row["STU_FNAME"] .
                            "</td><td>" . $row["STU_LNAME"] .
                            "</td><td style='color:red'>" . $presence .
                            "</td><td><a href='./php/ChangePresence.php?id=".$attendanceID."&stuID=".$row['STU_ID']."'><button type='button' class='viewButton'>Change</button></a>" .
                            "</td>" .
                            "</tr>";
                    }

                    $counter++;
                    $row = $result->fetch_assoc();
                }
            }else {
                    echo " <tr><td colspan='4'> No Students</td></tr>";
                }?>
        </table>
    </div>
</div>

</body>
</html>
