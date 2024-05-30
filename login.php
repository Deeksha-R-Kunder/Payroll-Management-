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



.input-box2{
    text-align: center;
    padding: 10px;
    margin-left: 50px;
}

.input-box1{
    text-align: center;
    padding: 10px;
    margin-left: 50px;
    
}



.registration{
    min-height: 100vh;
    width: 100%;
    background-image: linear-gradient(rgba(63, 147, 196, 0.7),rgba(10, 28, 40, 0.7),rgba(112, 152, 246, 0.7)),url(payroll1.jpeg);
    background-position: center;
    background-size: cover;
    position: relative;
    margin-bottom: 500px;
    color: white;
}
    .container{
    border: 1px solid white;
    border-radius: 5px;
    padding: 20px;
    width: 100%;
    max-width:400px;
    min-height: 10vh;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.652);
    justify-content: center;
    margin-left: 500px;
}
.alert-danger{
    border: 1px solid white;
    border-radius:  5px;
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
                <li><a href="register.php" style="color: rgb(255, 0, 0);">SIGNUP</a></li>
            </ul>
        </div>
        <i class="fa fa-bars" onclick="showMenu()" style="color:white"></i>
    </nav>
</section>
<section class="registration">

<h4 style="margin-left:1px;font-size:30px; color:white">LOGIN</h4>

    <div class="container">
    <p>Enter the details to get access to our <br>Payroll Management System Website</p>
    <div class="wrapper">
        <div class="from-box login">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "configall.php";
            $sql = "SELECT * FROM USERS WHERE Email = '$email'";
            $result = mysqli_query($connection, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["Password"])) {
                    session_start();
                    $_SESSION["USERS"] = "yes";
                    header("Location: home.html");
                    die();
                } 
                else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not exists</div>";
            }
        }
        ?>

            <form action="login.php" method="post">
                <div class="input-box1">
                    <spam class="icon"><ion-icon name="mail-outline"></ion-icon></spam>
                    <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                    <label>Email</label>
                </div>
                
                <div class="input-box2">
                    <spam class="icon"><ion-icon name="lock-closed-outline"></ion-icon></spam>
                    <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <a href="register.php">Forgot Password?</a>
                </div>
                <input type="submit" value="Login" name="login" class="btn">
                <div class="login-register">
                    <p>Don't have an account?
                        <a href="register.php" class="register-link">Register</a>
                    </p>
                </div>
            </div>
            </form>
        
    
    </div>
    <script src="script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    
</section>
<script>
    
    var navLinks = document.getElementById("navLinks");
    
    function showMenu(){
        navLinks.style.right = "0";
    }
     function hideMenu(){
        navLinks.style.right = "-200px";
    }
        
</script>  
</body>
</html>

<!--<section class="registration">
    <h4>LOGIN</h4>
    <p>Enter the details to get access to our <br>Payroll Management System Website</p>
    <div class="wrapper">
        <div class="from-box login">
            <form action="#">
                <div class="input-box1">
                    <spam class="icon"><ion-icon name="mail-outline"></ion-icon></spam>
                    <input type="email"  required>
                    <label>Email</label>
                </div>
                
                <div class="input-box2">
                    <spam class="icon"><ion-icon name="lock-closed-outline"></ion-icon></spam>
                    <input type="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                    <a href="signin.html" class="btn">Submit</a>
                <div class="login-register">
                    <p>Don't have an account?
                        <a href="register.html" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    
    </div>
    <script src="script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    
</section>