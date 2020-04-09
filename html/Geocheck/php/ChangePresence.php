<?php
session_start();

$attendanceID = $_GET['id'];
$stuID = $_GET['stuID'];

//Database Information
$host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "GeoCheckSoftware1234";
$dbname = "mydb";
$port = 3306;
$conn = mysqli_connect($host, $username, $password, $dbname, $port);

$query = "CALL modifyAttendance($attendanceID, $stuID)";

if (mysqli_real_query($conn, $query)){
    header ("Location: ../View-Attendance-P.php?id=".$attendanceID);
} else {
    echo
    "<script>
window.confirm(\"Something went wrong\");
</script>";
}


