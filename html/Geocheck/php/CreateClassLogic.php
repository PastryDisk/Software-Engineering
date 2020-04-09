<?php
session_start();
$email = $_SESSION['email'];
$profID = $_SESSION['profID'];
if(isset($_POST['createCourse'])) {

    if(isset($_POST['courseID']) && isset($_POST['courseCode']) &&  isset($_POST['courseName']) && isset($_POST['courseStartDate1']) && isset($_POST['Duration']) && isset($_POST['courseLocation'])) {
        $courseID = $_POST['courseID'];
        $courseCode = $_POST['courseCode']; // CRN
        $courseName = $_POST['courseName'];
        $startDate1 = $_POST['courseStartDate1'];
        $duration = $_POST['Duration'];
        $location = $_POST['courseLocation'];
        $error_msg = "";

        switch($location)
        {
            case "EC":
                $location = 1;
                break;
            case "ODH":
                $location = 2;
                break;
            case "DH":
                $location = 3;
                break;
            case "MSC":
                $location = 4;
                break;
        }

        $host = "geocheck.cbh1cn1j4qvl.us-east-2.rds.amazonaws.com";
        $username = "admin";
        $password = "GeoCheckSoftware1234";
        $dbname = "mydb";
        $port = 3306;
        $conn = mysqli_connect($host, $username, $password, $dbname, $port);

        if (!$conn) {
            die("Database error: " . mysqli_connect_error());
        }

        if ($_POST['courseStartDate2'] != "") {
            $startDate2 = $_POST['courseStartDate2'];

            if (($startDate2 == $startDate1) == 1)
                $error_msg = "Start dates can't be the same!";
        }

        if ($_POST['courseStartDate3'] != "") {
            $startDate3 = $_POST['courseStartDate3'];

            if (($startDate3 == $startDate1) == 1 || ($startDate3 == $startDate2) == 1)
                $error_msg = "Start dates can't be the same!";
        }

       if($_POST['courseStartDate2'] == "" && $_POST['courseStartDate3'] == "" &&  $error_msg == "")
       {
           $query = "CALL createCourse($courseCode, '$courseID', '$courseName', '$startDate1', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P-Updated.php");
           } else{
               echo("<script LANGUAGE='JavaScript'>
                        window.alert('CRN Already Taken!');
                        window.location.href='../CreateClass.php';
                        </script>");
           }
       }
       else if($_POST['courseStartDate3'] == "" && $error_msg == "")
       {
           $query = "CALL createCourse2($courseCode, '$courseID', '$courseName', '$startDate1', '$startDate2', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P-Updated.php");
           } else{
               echo("<script LANGUAGE='JavaScript'>
                        window.alert('CRN Already Taken!');
                        window.location.href='../CreateClass.php';
                        </script>");
           }
       }
       else if ($error_msg == "") {
           $query = "CALL createCourse3($courseCode, '$courseID', '$courseName', '$startDate1', '$startDate2', '$startDate3', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P-Updated.php");
           } else{
               echo("<script LANGUAGE='JavaScript'>
                        window.alert('CRN Already Taken!');
                        window.location.href='../CreateClass.php';
                        </script>");
           }
       }
       else {
           echo("<script LANGUAGE='JavaScript'>
                        window.alert('Two or more start dates can\'t be the same');
                        window.location.href='../CreateClass.php';
                        </script>");
       }
    }
}
