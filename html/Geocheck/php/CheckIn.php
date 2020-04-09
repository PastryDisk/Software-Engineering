<?php
session_start();
$crn = $_GET['id'];
$stuID = $_SESSION['stuID'];
$host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com"; //connecting to database
$username = "admin";
$password = "GeoCheckSoftware1234";
$dbname = "mydb";
$port = 3306;
$conn = mysqli_connect($host, $username, $password, $dbname, $port);

$latitude = $_COOKIE['latitude'];
$longitude = $_COOKIE['longitude'];

$query = "SELECT checkIn($latitude, $longitude, $crn, $stuID)";  // JAKOB MAGIC CODE
$result = mysqli_real_query($conn, $query);                      // THAT CHECKS LOGIN
$result = mysqli_use_result($conn);                              // INFO AND COMPARES TO
$row = mysqli_fetch_row($result);                                // DATABASE ENTRY TO
$row1 = mysqli_fetch_row($result);

if(mysqli_real_query($conn, $query))
{
    if($row[0] == 1) {
        echo "<script type = 'text/javascript'>
    window.confirm('You have successfully checked in!');
    window.location.href = '../View-Classes-S.php';
          </script>";
    } else {
        echo "<script type = 'text/javascript'>
    window.confirm('You have not successfully checked in! Please check the time and location of your class!');
    window.location.href = '../View-Classes-S.php';
          </script>";
    }

}
else {
    echo "<script type = 'text/javascript'>
    window.confirm('Browser not supported! On Desktop use Edge, on mobile use Opera.');
    window.location.href = '../View-Classes-S.php';
          </script>";
}
