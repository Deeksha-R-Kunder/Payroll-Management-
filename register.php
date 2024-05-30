<?php
session_start();
if (isset($_SESSION["USERS"])) {
    header("Location: home.html");
}
?>

<!DOCTYPE html>
<html>

<head>


    <style>


.input-box4{
            text-align: center;
            padding: 10px;
            margin-left: 80px;
        }

.input-box3 {
            text-align: center;
            padding: 10px;
            margin-right: -50px;
        }

        .input-box2 {
            text-align: center;
            padding: 10px;
            margin-left: 50px;
        }

        .input-box1 {
            text-align: center;
            padding: 10px;
            margin-left: 50px;
        }



        .registration {
            min-height: 100vh;
            width: 100%;
            background-image: linear-gradient(rgba(63, 147, 196, 0.7), rgba(10, 28, 40, 0.7), rgba(112, 152, 246, 0.7)), url(payroll1.jpeg);
            background-position: center;
            background-size: cover;
            position: relative;
            margin-bottom: 500px;
            color: white;
        }

        .container {
            border: 1px solid white;
            border-radius: 5px;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            min-height: 10vh;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.652);
            justify-content: center;
            margin-left: 500px;
            gap: 20px;
        }

        .alert-danger {
            color: whitesmoke;
            border: 1px solid white;
            border-radius: 5px;
            background-color: rgb(5, 14, 56);
            padding: 10px;
            width: 70%;
            margin-left: 45px;

        }
    </style>


    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Payroll Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body style="background: linear-gradient(rgb(2, 2, 33),rgb(3, 3, 48),rgb(4, 4, 73));">


    <section class="sub-headers">
        <nav>
            <a href="index.html"><img src="logo1.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()" style="color:white"></i>

                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="course.html">FACILITIES</a></li>
                    <li><a href="login.php" style="color: rgb(255, 0, 0);">LOGIN</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()" style="color:white"></i>
        </nav>
    </section>
    <section class="registration">


        <h4 style="margin-left:1px;font-size:30px; color:white">SIGN UP</h4>

        <div class="container">

            <p>Enter the details to get access to our <br>Payroll Management System Website</p>

            <div class="wrapper">
                <?php
                if (isset($_POST["submit"])) {
                    $fullName = $_POST["fullname"];
                    $Email = $_POST["email"];
                    $Password = $_POST["password"];
                    $passwordRepeat = $_POST["repeat_password"];

                    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

                    $errors = array();

                    if (empty($fullName) or empty($Email) or empty($Password) or empty($passwordRepeat)) {
                        array_push($errors, "All fields are required");
                    }
                    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid");
                    }
                    if (strlen($Password) < 8) {
                        array_push($errors, "Password must be at least 8 charactes long");
                    }
                    if ($Password !== $passwordRepeat) {
                        array_push($errors, "Password does not match");
                    }
                    require_once "configall.php";
                    $sql = "SELECT * FROM users WHERE email = '$Email'";
                    $result = mysqli_query($connection, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount > 0) {
                        array_push($errors, "Email already exists!");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {

                        $sql = "INSERT INTO USERS (Full_Name, Email, Password) VALUES ( ?,?,? )";
                        $stmt = mysqli_stmt_init($connection);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "sss", $fullName, $Email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are registered successfully.</div>";
                            session_start();
                            $_SESSION["USERS"] = "yes";
                            header("Location: home.html");
                            die();
                        } else {
                            die("Something went wrong");
                        }
                    }
                }
                ?>

                <form action="register.php" method="post">
                    <div class="input-box3">
                        <input type="text" name="fullname" placeholder="Enter Full Name">
                        <label>Full Name</label>
                    </div>

                    <div class="input-box1">
                        <spam class="icon"><ion-icon name="mail-outline"></ion-icon></spam>
                        <input type="email" name="email" placeholder="Enter Email">
                        <label>Email</label>
                    </div>

                    <div class="input-box2">
                        <spam class="icon"><ion-icon name="lock-closed-outline"></ion-icon></spam>
                        <input type="password" name="password" placeholder="Enter Password">
                        <label> Password</label>
                    </div>

                    <div class="input-box4">
                        <spam class="icon"><ion-icon name="lock-closed-outline"></ion-icon></spam>
                        <input type="password" name="repeat_password" placeholder="Re-enter Password">
                        <label>Confirmation</label>
                    </div>
                    <input type="submit" value="Register" name="submit" class="btn">

                    <div class="login-register">
                        <p>Already have an account?
                            <a href="login.php" class="register-link">Signin</a>
                        </p>
                    </div>
                </form>
            </div>
            <div>
                <script src="script.js"></script>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    </section>
    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }

        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>
</body>

</html>