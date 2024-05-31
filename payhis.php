<?php
include('configall.php');
$id = $_POST['id'];
if ($id) {
    $sql = "SELECT EMP_SAL.Date,EMP_SAL.PayNo,EMP_SAL.EmpId,EMP.EmpName,EMP.AccNo,EMP_SAL.TotalSalary FROM EMP INNER JOIN EMP_SAL WHERE EMP.EmpId=EMP_SAL.EmpId AND EMP.EmpId=$id;";

    $result = mysqli_query($connection, $sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment History</title>
    <style>
        .mTable {
            margin-top: 45px;
            font-weight: bold;
        }

        table {
            width: 99%;
            margin: 10px;
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
            width: 230px;
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
    <link rel="stylesheet" href="style.css"> <!--linking css script with html-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body style="color:#ddd">
    <section class="mains">
        <nav>
            <a href="home.html"><img src="logo1.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()" style="color:white"></i>
                <ul>
                    <li><a href="home.html">HOME</a></li>
                    <li><a href="department.php">DEPARTMENT</a></li>
                    <li><a href="employee.php">EMPLOYEE</a></li>
                    <li><a href="setsal.html">SET SALARY</a></li>
                    <li><a href="setpay.html">SET PAYMENT</a></li>
                    <li><a href="payhis.php" style="color: rgb(255, 0, 0);">PAYMENT HISTORY</a></li>
                    <li><a href="index.html">LOG OUT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()" style="color:white"></i>
        </nav>
        <center>
            <h1 style="color: white;">Payment History</h1>
        </center>
        <h2 style="color: rgb(243, 251, 185);">Enter ID to see payment History</h1>
            </center>

            <form action="payhis.php" method="post">
                <table id="myTable">
                    <tr>

                        <th>Employee Id</th>


                        <th>Submission</th>
                    </tr>
                    <tr>

                        <td><input type="text" name="id"></td>


                        <td><input type="submit" style="width:100px;background: black"name="submit" class="btn btn-primary"></td>
                    </tr>
                </table>
            </form>

            <table class="mTable">
                <tr>
                    <th>Payment no</th>
                    <th>Date</th>
                    <th>BankAccountNo</th>
                    <th>Total salary</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <tr>
                    <td>" . $row['PayNo'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['AccNo'] . "</td>
                    <td>" . $row['TotalSalary'] . "</td>
                    </tr>";
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
                    cell1.innerHTML = '<input type="text" name="number[]">';
                    cell2.innerHTML = '<input type="text" name="id[]">';
                    cell3.innerHTML = '<input type="text" name="name[]">';
                    cell4.innerHTML = '<input type="text" name="date[]">';
                    cell5.innerHTML = '<input type="text" name="accno[]">';
                    cell6.innerHTML = '<input type="text" name="sal[]">';
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