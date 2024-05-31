<?php
include("configall.php");
error_reporting(0);

$id = $_GET['id'];
$delete = mysqli_query($connection,"DELETE FROM EMP WHERE id = '$id'");

if ($delete)
{
    header("Location: employee.php");

    echo"<font color='green'>Record Deleted successfully";
}
else{
    echo"<font color='red'>Failed to delete the record";
}
?>










