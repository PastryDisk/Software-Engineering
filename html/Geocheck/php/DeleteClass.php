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

$query = "CALL deleteClass($crn)";

echo "<script LANGUAGE='JavaScript'>
var r = confirm(\"Are you sure you want to delete this course?\");
var txt;

if (r == true){
    txt = 't';
    setCookie(txt);
    }
else {
    txt = 'f';
    setCookie(txt);
}

function setCookie(s){
    document.cookie='confirmation='+s;
}
</script>";

$confirm = $_COOKIE["confirmation"];

if ($confirm == "t"){
    if (mysqli_real_query($conn, $query)) {
        echo("<script LANGUAGE='JavaScript'>
                        window.alert('$confirm');
                        window.location.href='../View-Classes-P-Updated.php';
                        </script>");
    } else {
        echo("<script LANGUAGE='JavaScript'>
                        window.alert('$confirm');
                        window.location.href='../View-Classes-P-Updated.php';
                        </script>");
    }
} else {
    echo("<script LANGUAGE='JavaScript'>
                        window.alert('$confirm');
                        window.location.href='../View-Classes-P-Updated.php';
                        </script>");
}
