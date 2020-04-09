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
include "./css/Modify-Class-P.css";
?>
</style>
</head>
<body>
<?php
include "./html/navbarP.html";
include "./html/Modify-Class-P.html";
session_start();
$crn = $_GET['crn'];
$course_code = $_GET['code'];
$course_name = $_GET['course_name'];
$location = $_GET['location'];

if(isset($_POST['ModifyClassForm'])) {
    $newCRN = $_GET['crn'];
    $newCourseCode = $_POST['courseCode'];
    $newCourseName = $_POST['courseName'];
    $newLocation = $_POST['locationID'];
    switch ($newLocation) {
        case "EC":
            $newLocation = 1;
            break;
        case "ODH":
            $newLocation = 2;
            break;
        case "DH":
            $newLocation = 3;
            break;
        case "MSC":
            $newLocation = 4;
            break;
    }
    $host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com"; //connecting to database
    $username = "admin";
    $password = "GeoCheckSoftware1234";
    $dbname = "mydb";
    $port = 3306;
    $conn = mysqli_connect($host, $username, $password, $dbname, $port);
    $query = "CALL modifyClass($newCRN, '$newCourseName', '$newCourseCode', $newLocation)";
    if (mysqli_real_query($conn, $query)) {
        echo("<script LANGUAGE='JavaScript'>
            window.alert('Class Successfully Modified');
            window.location.href='./View-Classes-P-Updated.php';
            </script>");
    } else {
        echo("<script LANGUAGE='JavaScript'>
           window.alert('Could Not Change Properties');
           window.location.href='./View-Classes-P-Updated.php';
           </script>");
    }
}
?>
</body>
</html>

