<?php
session_start();

$stuID = $_SESSION['stuID'];

$host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com"; //connecting to database
$username = "admin";
$password = "GeoCheckSoftware1234";
$dbname = "mydb";
$port = 3306;
$conn = mysqli_connect($host, $username, $password, $dbname, $port);

$CRN = $_POST['CRN']; //CRN for the course taken from the page

$query = "CALL registerForCourse($stuID, $CRN)";
if(mysqli_real_query($conn, $query))
{
    header("Location: ../View-Classes-S.php");
}
else {
    echo("<script LANGUAGE='JavaScript'>
                        window.alert('Class does not exist!');
                        window.location.href='../ClassRegistration.php';
                        </script>");
}
