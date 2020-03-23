<?php
session_start();
$email = $_SESSION['email'];
$profID = $_SESSION['profID'];
if(isset($_POST['createCourse'])) {
    /*$error_msg = "";  // output message to user and also our check for errors
    foreach ($_POST as $key => $value) { //might need editing of key/value variables
        if (empty($_POST[$key]))
            $error_msg = "All fields must be filled in!";
    }*/
    if(isset($_POST['courseID']) && isset($_POST['courseCode']) &&  isset($_POST['courseName']) && isset($_POST['courseStartDate1']) && isset($_POST['Duration']) && isset($_POST['courseLocation'])) {
        $courseID = $_POST['courseID'];
        $courseCode = $_POST['courseCode']; // CRN
        $courseName = $_POST['courseName'];
        $startDate1 = $_POST['courseStartDate1'];
        $duration = $_POST['Duration'];
        $location = $_POST['courseLocation'];
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
            case "TST":
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
      // $query1 = "CALL createCourse($courseCode,  '$courseID', '$courseName', $location, $profID)";
        //$query2 = "CALL attendanceLoop($courseCode, '$startDate1', $duration)";
        if (isset($_POST['courseStartDate2'])) {
            $startDate2 = $_POST['courseStartDate2'];
            //$query3 = "CALL attendanceLoop($courseCode, '$startDate2', $duration)";
        }
        if (isset($_POST['courseStartDate3'])) {
            $startDate3 = $_POST['courseStartDate3'];
            //$query4 = "CALL attendanceLoop($courseCode, '$startDate3', $duration)";
        }
       if($_POST['courseStartDate2'] == "" && $_POST['courseStartDate3'] == "")
       {
           $query = "CALL createCourse($courseCode, '$courseID', '$courseName', '$startDate1', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P.php");
           }
           else echo "<p> Something went wrong 1 </p>";
       }
       elseif($_POST['courseStartDate3'] == "")
       {
           $query = "CALL createCourse2($courseCode, '$courseID', '$courseName', '$startDate1', '$startDate2', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P.php");
           }
           else echo "<p> Something went wrong 2 </p>";
       }
       else{
           $query = "CALL createCourse3($courseCode, '$courseID', '$courseName', '$startDate1', '$startDate2', '$startDate3', $duration, $location, $profID)";
           if(mysqli_real_query($conn, $query))
           {
               header("Location: ../View-Classes-P.php");
           }
           else echo "<p> Something went wrong 3 </p>";
       }

    }
    else echo "<p> All fields must be filled in! </p>"; //missing field data
}
