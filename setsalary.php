<?php
session_start();
if (isset($_SESSION["JOB"])) {
  header("Location: setsal.html");
}
include('configall.php');
//$res = mysqli_query($connection, "select * from JOB");


if (isset($_POST['submit'])) {
    $salary = $_POST['salary'];
    $jobtitle = $_POST['jobtitle'];
    require_once "configall.php";
    $sql = "UPDATE JOB SET basic_salary= '$salary' WHERE Job_Title='$jobtitle'";
    //$insertsql = "INSERT INTO JOB(Job_Title,basic_salary) VALUES ('$jobtitle','$salary')";
    $test = mysqli_query($connection, $sql);
    if ($test) {
        header("Location: setsal.html");
        echo 'Salary Updated';


        die();
    } else {
        echo 'Failed to update salary update';
    }
}

?>
