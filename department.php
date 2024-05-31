<?php
session_start();
if (isset($_SESSION["DEPT"])) {
  header("Location: department.php");
}
include('configall.php');
$res = mysqli_query($connection, "select * from DEPT");
?>


<!DOCTYPE html>
<html>

<head>
  <title>Department</title>
  <style>
    .mTable {
            margin-top: 45px;
            font-weight: bold;

        }
    table {
      width: 99%;
      margin: 10px;
      font-size: 18.5px;

    }

    h2 {
      padding: 10px;
      text-align: center;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8.5px;
      text-align: center;
    }

    input {
      width: 400px;
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

<body style="color:#ddd">
  <section class="mains">
    <nav>
      <a href="department.php"><img src="logo1.png"></a>
      <div class="nav-links" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()" style="color:white"></i>
        <ul>
          <li><a href="home.html">HOME</a></li>
          <li><a href="department.php" style="color: rgb(255, 0, 0);">DEPARTMENT</a></li>
          <li><a href="employee.php">EMPLOYEE</a></li>
          <li><a href="setsal.html">SET SALARY</a></li>
          <li><a href="setpay.html">SET PAYMENT</a></li>
          <li><a href="payhis.php">PAYMENT HISTORY</a></li>
          <li><a href="index.html">LOG OUT</a></li>
        </ul>
      </div>
      <i class="fa fa-bars" onclick="showMenu()" style="color:white"></i>
    </nav>
    <h2 style="color: white;">Department Details</h2>

    <form action="department.php" method="POST">

      <table id="myTable">
        <tr>
          <th>Department Id</th>
          <th>Department Name</th>
          <th>Submission</th>
          <!--<th>Action</th>-->
        </tr>
        <tr>
          <td><input type="text" name="id"></td>
          <td><input type="text" name="name"></td>
          <td><input type="submit" value="Add" name="add" class="btn btn-primary" style="width:90px;background: rgb(178, 6, 6);"></td>

          <!-- <td><button type="button" onclick="deleteRow(this)" style="width:90px;">Delete</button></td>-->
        </tr>
      </table>
      <?php

      if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $id = $_POST['id'];
        require_once "configall.php";
        $result = mysqli_query($connection, "INSERT into DEPT(DeptId,DeptName) values('$id','$name')");

        if ($result) {
          echo "Department Inserted";
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
        <th>Department Id</th>
        <th>Department Name</th>
        <th>Action</th>
      </tr>
      <?php
      while ($final = mysqli_fetch_array($res)) {
        echo "
      <tr>
       <td>" . $final['id'] . "</td>
       <td>" . $final['DeptId'] . "</td>
       <td>" . $final['DeptName'] . "</td>
       <td>
        <a class='btn btn-primary' href='deldept.php?id=$final[id]' style='width:90px;background:rgb(178, 6, 6)' >Delete
        </td>
       </tr>
      ";
      }
      ?>

    </table>

    <!--<button type="button" class="add-row" onclick="addRow()">Add Department</button>-->
    <script>
      function addRow() {
        var table = document.getElementById("myTable");
        var row = table.insertRow();
        // Insert above the last row
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = '<input type="text" name="name[]">';
        cell2.innerHTML = '<input type="text" name="email[]">';
        cell3.innerHTML = '<button type="button" class="delete-button" onclick="deleteRow(this)" style="width:90px;background:black">Delete</button>';
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