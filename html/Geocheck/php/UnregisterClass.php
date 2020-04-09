<?php
session_start();

$crn = $_GET['id'];
$stuID = $_SESSION['stuID'];

//Database Information
$host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "GeoCheckSoftware1234";
$dbname = "mydb";
$port = 3306;
$conn = mysqli_connect($host, $username, $password, $dbname, $port);

$query = "CALL unregister($stuID, $crn)";

echo "<script LANGUAGE='JavaScript'>
var r = confirm(\"Are you sure you want to unregister from this course?\");
document.cookie='r='+r;
</script>";

$confirm = $_COOKIE['r'];

if ($confirm){
    if (mysqli_real_query($conn, $query)) {
        echo("<script LANGUAGE='JavaScript'>
                        window.alert('Unregistered successfully!');
                        window.location.href='../View-Classes-S.php';
                        </script>");
    } else {
        echo("<script LANGUAGE='JavaScript'>
                        window.alert('Error with database!');
                        window.location.href='../View-Classes-S.php';
                        </script>");
    }
} else {
    header("Location: ../View-Classes-S.php");
}
