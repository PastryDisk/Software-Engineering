<html>
<head>
    <html lang="en"><head>
        <title>Geocheck</title>
        <meta name="author" content="Geocheck Team">
        <meta name="description" content="Login">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    <?php
    include "./css/navbar.css";
    include "./css/View-Classes-Pv2.css";
    ?>
</style>
    </head>
<body>
<?php
include "./html/navbarP.html";
?>
<div class="bodyFormat">
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
                echo " <br><br><br> ";
                echo " <h2>My Classes</h2> ";
                while ($counter < $result->num_rows) {
                    echo " <table class='card'> ";
                    echo " <tr><th class='cardHeader' colspan='3'> " . $row["COURSE_CODE"] . " </th></tr> ";
                    echo " <tr><td class='padding'>Course Name: </td> ";
                    echo " <td class='padding'> " . $row["COURSE_NAME"] . " </td></tr> ";
                    echo " <tr><td class='padding'>CRN: </td> ";
                    echo " <td class='padding'> " . $row["COURSE_CRN"] . " </td></tr> ";
                    echo " <tr><td class='padding'>Location: </td> ";
                    echo " <td class='padding'> " . $row["LOCATION_NAME"] . " </td></tr> ";
                    echo " <tr><td colspan='2' class='Modify'><a href='./View-Attendance-Dates.php?id=".$row['COURSE_CRN']."'><button type='button' class='viewButton'>View</button></a>";
                    echo " <a href='./Modify-Class-P.php?course_name=".$row["COURSE_NAME"] . "&crn=".$row['COURSE_CRN']."&code=".$row['COURSE_CODE']."&location=".$row['LOCATION_NAME']."'><button type='button' class='editButton'>Edit</button></a> ";
                    echo " <a href='./Delete-Confirmation.php?id=".$row['COURSE_CRN']."'><button type='button' class='deleteButton'>Delete Class</button> </a></td> </tr>";
                    echo " </table> ";
                    $counter++;
                    $row = $result->fetch_assoc();
                }
            } else {
                echo "
                      <div class='alert'>
                        <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                        <strong>Information:</strong> You currently have no classes!
                      </div>";
            } ?>
</div>
</body>
    </html>
