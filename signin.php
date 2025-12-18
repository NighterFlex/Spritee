<?php

session_start();
include 'connect.php';
//---------------------FOR REGISTRATIONN-----------------------------------


    // $show_alert =false;
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reg-btn'])){
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $exists = false;

            //check passwords match first
    if ($password != $confirm_password) {
        echo "<script>
            alert('Passwords do not match :(');
            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('cardInner').classList.add('flipped');
            });
        </script>";
        } 
    else {
        //check if user already exists
        $check_user_sql = "SELECT * FROM registration WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_user_sql);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>
                alert('Username already exists. Try another one.');
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('cardInner').classList.add('flipped');
                });
            </script>";
        } else {
            //dsafe to insert
            $reg_sql = "INSERT INTO registration (username, email, password, country, gender)
                    VALUES ('$username', '$email', '$password', '$country', '$gender')";
            
            if (mysqli_query($conn, $reg_sql)) {
                echo "<script>
                    alert('Registration successful. You can now login.');
                    document.addEventListener('DOMContentLoaded', function () {
                        document.getElementById('cardInner').classList.remove('flipped');
                    });
                </script>";
            } else {
                echo "<script>
                    alert('Registration failed. Try again.');
                document.addEventListener('DOMContentLoaded', function () {
                        document.getElementById('cardInner').classList.add('flipped');
                    });
                </script>";
            }
            }
    }
    }

//--------------------------FOR LOGIN-------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['log-btn']) ){
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];
    $remember = isset($_POST['remeber']);   //if thecheckbox is checked

    $login_sql = "SELECT * FROM registration WHERE username = '$login_username' AND password = '$login_password'";
    $login_result = mysqli_query($conn, $login_sql);

    if(mysqli_num_rows($login_result) == 1){
        echo "<script>
            alert('Login successful! Welcome $login_username');
        </script>";
        $_SESSION['username'] = $login_username;
        $_SESSION['logged_in'] = true;

        if($remember){
            setcookie('username', $login_username, time() + (5*24*60*60), "/");
        }
        header("Location: index.php");
        exit();
    }
    else{
        echo "<script>
            alert('Invalid username or password');
            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('cardInner').classList.remove('flipped');
            });
        </script>";
    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="stylesheet" href="signin.css">
</head>

<body>
    <div class="page">
        <div class="card">
            <div class="card-inner" id="cardInner">
                <!-- LOGIN (front) -->
                <!-- LOGIN (front) -->
                <div class="card-face card-front">
                    <h1 class="logo">LOGIN</h1>
                    <form class="form" method="POST">
                        <div class="loginput">

                            <div class="field">
                                <input type="text" placeholder="username" required name="login_username">
                            </div>
                            <div class="field">
                                <input type="password" placeholder="password" required name="login_password">
                            </div>
                        </div>
                            
                            <!-- NEW: left section under inputs -->
                            <div class="left-section">
                            <div class="field-inline">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember me</label>
                            </div>

                            <button class="btn main-btn" type="submit" name="log-btn">LOGIN</button>
                        </div>

                        <button class="btn link-btn" type="button" id="toRegister">
                            Don’t have an account? Register
                        </button>
                    </form>
                </div>

                <!-- REGISTER (back) -->
                <div class="card-face card-back">
                    <h1 class="logoback">REGISTER</h1>
                    <form class="form" method="POST">
                        <div class="field">
                            <input type="text" placeholder="username" require name="username">
                        </div>
                        <div class="field">
                            <input type="email" placeholder="email" required name="email">
                        </div>
                        <div class="field">
                            <input type="password" placeholder="password" required name="password">
                        </div>
                        <div class="field">
                            <input type="password" placeholder="confirm password" required name="confirm_password">
                        </div>

                        <div class="field state">
                            <select required name="country">
                                    <option value="">select your country</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            
                            <div class="left-section">
                                <div class="field-inline">
                                    <span class="field-label">gender</span>
                                    <label><input type="radio" name="gender" value="male"> Male</label>
                                    <label><input type="radio" name="gender" value="female" checked> Female</label>
                                </div>

                            <button class="btn main-btn" type="submit" name="reg-btn">REGISTER</button>
                        </div>

                        <button class="btn link-btn" type="button" id="toLogin">
                            Already have an account? Login
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        const cardInner = document.getElementById('cardInner');
        const toRegister = document.getElementById('toRegister');
        const toLogin = document.getElementById('toLogin');

        toRegister.addEventListener('click', () => {
            cardInner.classList.add('flipped');
        });

        toLogin.addEventListener('click', () => {
            cardInner.classList.remove('flipped');
        });
    </script>
</body>

</html>