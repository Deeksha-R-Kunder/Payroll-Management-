<?php
session_start();
if (isset($_SESSION["EMP"])) {
    header("Location: employee.php");
}
include('configall.php');
$res = mysqli_query($connection, "select * from EMP");
?>


<!DOCTYPE html>
<html>

<head>
    <title>Employee</title>
    <style>
        table {
            width: 100%;
            table-layout: fixed;
            display: block;
            max-width: -moz-fit-content;
            max-width: fit-content;
            overflow-x: auto;
            white-space: nowrap;
        }

        .mTable {
            margin-top: 50px;

        }

        h2 {
            padding: 10px;
            text-align: center;
        }

        th,td {
            border: 1px solid #ddd;
            padding: 8.5px;
            text-align: center;
        }

        th {
            background-color: rgb(178, 6, 6);
            color: white;
        }

        .add-row {
            margin: 10px;
        }
    </style>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Payroll Management</title>
    <link rel="stylesheet" href="style.css"> <!--linking css script with html-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body style="color: white;">
    <section class="mains">
        <nav>
            <a href="employee.php"><img src="logo1.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()" style="color:white"></i>
                <ul>
                    <li><a href="home.html">HOME</a></li>
                    <li><a href="department.php">DEPARTMENT</a></li>
                    <li><a href="employee.php" style="color: rgb(255, 0, 0);">EMPLOYEE</a></li>
                    <li><a href="setsal.html">SET SALARY</a></li>
                    <li><a href="setpay.html">SET PAYMENT</a></li>
                    <li><a href="payhis.php">PAYMENT HISTORY</a></li>
                    <li><a href="index.html">LOG OUT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()" style="color:white"></i>
        </nav>
        <h2 style="color: white;">Employee Details</h2>

        <form action="employee.php" method="POST">

            <table id="myTable">
                <tr>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <!--<th>DOB</th>-->
                    <th>Job Title</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Gender(F/M)</th>
                    <th>BankAccountNo</th>
                    <th>EmailId</th>
                    <!--<th>StartDate</th>-->
                    <th>Loan</th>
                    <th>PF</th>
                    <th>Submission</th>
                </tr>
                <tr>
                    <td><input type="text" name="id"></td>
                    <td><input type="text" name="name"></td>
                    <!--<td><input type="text" name="dob"></td>-->
                    <td><input type='text' name='jobtitle'></td>
                    <td><input type="text" name="phoneno"></td>
                    <td><input type="text" name="address"></td>
                    <td><input type="text" name="gender"></td>
                    <td><input type="text" name="accno"></td>
                    <td><input type="email" name="email"></td>
                    <!--<td><input type="text" name="date"></td>-->
                    <td><input type="text" name="loan"></td>
                    <td><input type="text" name="pf"></td>
                    <td><input type="submit" value="Add" name="add" class="btn btn-primary" style="width:100px;background:black;"></td>
                    <!--<td><button type="button" onclick="deleteRow(this)"style="width:53px">Delete</button></td>-->
                </tr>
            </table>

            <?php

            if (isset($_POST['add'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                //$dob = $_POST['dob'];
                $jobtitle = $_POST['jobtitle'];
                $phone = $_POST['phoneno'];
                $address = $_POST['address'];
                $gender = $_POST['gender'];
                $accno = $_POST['accno'];
                $email = $_POST['email'];
                //$date = $_POST['date'];
                $loan = $_POST['loan'];
                $pf = $_POST['pf'];

                require_once "configall.php";
                //if(is_numeric($phone) && strlen((string)$phone)==10 && $phone<0){
                $result = mysqli_query($connection, "INSERT into EMP(EmpId,EmpName,JobTitle,phone,EmpAddress,Sex,AccNo,Email,loan,pf) values('$id','$name','$jobtitle','$phone','$address','$gender','$accno','$email','$loan','$pf')");

                // }

                if ($result) {
                    echo "New Employee Added";
                    die();
                } else {
                    echo "Insertion Failed";
                }
            }
            ?>
        </form>

        <table class="mTable">
            <tr>
                <th>ID</th>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <!-- <th>DOB</th>-->
                <th>Phone number</th>
                <th>Address</th>
                <th>Gender(F/M)</th>
                <th>BankAccountNo</th>
                <th>EmailId</th>
                <!--<th>StartDate</th>-->
                <th>Loan</th>
                <th>PF</th>
                <th>Action</th>
            </tr>

            <?php
            while ($final = mysqli_fetch_array($res)) {
                echo "
      <tr>
       <td>" . $final['id'] . "</td>
       <td>" . $final['EmpId'] . "</td>
       <td>" . $final['EmpName'] . "</td>
      
       <td>" . $final['phone'] . "</td>
       <td>" . $final['EmpAddress'] . "</td>
       <td>" . $final['Sex'] . "</td>
       <td>" . $final['AccNo'] . "</td>
       <td>" . $final['Email'] . "</td>

       <td>" . $final['loan'] . "</td>
       <td>" . $final['pf'] . "</td>


       <td>
        <a class='btn btn-primary' href='delemp.php?id=$final[id]' style='width:90px;background:black'>Delete
        </td>
       </tr>
      ";
            }
            ?>

        </table>






        <script>
            function addRow() {
                var table = document.getElementById("myTable");
                var row = table.insertRow();
                // Insert above the last row
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                var cell9 = row.insertCell(8);
                var cell10 = row.insertCell(9);
                var cell11 = row.insertCell(10);
                var cell12 = row.insertCell(11);
                cell1.innerHTML = '<input type="text" name="id][">';
                cell2.innerHTML = '<input type="text" name="name[]">';
                cell3.innerHTML = '<input type="text" name="dob[]">';
                cell4.innerHTML = '<input type="text" name="phoneno[]">';
                cell5.innerHTML = '<input type="text" name="address[]">';
                cell6.innerHTML = '<input type="text" name="gender[]">';
                cell7.innerHTML = '<input type="text" name="accno[]">';
                cell8.innerHTML = '<input type="text" name="email[]">';
                cell9.innerHTML = '<input type="text" name="date[]">';
                cell10.innerHTML = '<input type="text" name="loan[]">';
                cell11.innerHTML = '<input type="text" name="pf[]">';
                cell12.innerHTML = '<button type="button" class="delete-button" onclick="deleteRow(this)"style="width:53px,background:black">Delete</button>';
            }

            function deleteRow(button) {
                var row = button.parentNode.parentNode;
                row.parentNode.removeChild(row);
            }
        </script>
        <script>
            var navLinks = document.getElementById("navLinks");

            function showMenu() {
                navLinks.style.right = "0";
            }

            function hideMenu() {
                navLinks.style.right = "-200px";
            }
        </script>
    </section>
</body>

</html>