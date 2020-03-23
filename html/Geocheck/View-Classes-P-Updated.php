<html>
<head>
    <html lang="en"><head>
        <title>Geocheck</title>
        <meta name="author" content="Geocheck Team">
        <meta name="description" content="Login">
<style>
    <?php
    include "./css/navbarP.css";
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
        <header>My Classes</header>
        <table style="width: 90%; height: 50vh; overflow: scroll; text-align: center">
            <tr><th style="text-align: center">Class Code</th> <th style="text-align: center">CRN</th> <th style="text-align: center">Course Name</th> <th style="text-align: center">Location</th><th style="text-align: center">View</th> <th style="text-align: center">Edit</th> <th style="text-align: center">Delete Class</th></tr>
            <br><br><br><br>

            <?php
            session_start();

            // ProfID
            $profID = $_SESSION['profID'];

            //Database Information
            $host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
            $username = "admin";
            $password = "GeoCheckSoftware1234";
            $dbname = "mydb";
            $port = 3306;
            $conn = mysqli_connect($host, $username, $password, $dbname, $port);


            $query = "CALL viewCourseP($profID)";
            $result = mysqli_query($conn, $query);
            $counter = 0;
            $row = $result->fetch_assoc();

            if ($result->num_rows > 0) {
                while ($counter < $result->num_rows) {
                    echo "<tr>";
                    echo " <td> " . $row["COURSE_CODE"] .
                        " </td> <td> " . $row["COURSE_CRN"] .
                        " </td> <td> " . $row["COURSE_NAME"] .
                        " </td> <td> " . $row["LOCATION_NAME"] .
                        "</td>" .
                        "<td><button type='button' class='viewButton'>View</button></td>
                    <td><button type='button' class='editButton'>Edit</button></td>
                    <td><button type='button' class='deleteButton'>Delete Class</button>
                    </td>" .
                        "</tr>";
                    $counter++;
                    $row = $result->fetch_assoc();
                }
            } else {
                echo " <tr><td> No classes Found </td></tr>";
            } ?>
    </table>
    </div>
</div>
</body>
    </html>