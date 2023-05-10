<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sigmar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>


    <header>
        <h2 class="logo">Samir</h2>
        <nav class="navigation">
            <a href="#">about</a>
            <a href="#">home</a>
            <a href="#">contact</a>
            <a href="#">shutup</a>
            <button class="button-login">Login</button>
        </nav>
    </header>
    <div class="box">

        <span class="icon-close"><ion-icon name="close"></ion-icon></span>

        <div class="card-box login">
            <h1>Login</h1>
            <form action="">
                <div class="input-style">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="" id="" required>
                    <label for="Email">Email</label>
                </div>
                <div class="input-style">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="" id="" required>
                    <label for="password">Password</label>
                </div>
                <div class="remember">
                    <label><input type="checkbox" name="" id="">Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" methotd="POST" class="btn">Login</button>
                <div  class="login-register">
                    <p>Dont have an account? <a href="#" id="registerLink"  class="register-link">Register</a></p>
                </div>
            </form>
        </div>

            <div class="card-box register">
                <h1>Register</h1>
                <form action="include/signup.php" method="POST">
                    <div class="input-style">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="user" id="user" required>
                        <label for="Username">Username</label>
                    </div>
                    <div class="input-style">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" id="email" required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="input-style">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="pass" id="pass" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="remember">
                        <label><input type="checkbox" name="" id="">I agree to the terms</label>
                    </div>
                    <button type="submit" name="submit" class="btn">Register</button>
                    <div  class="login-register">
                        <p>Already have an account? <a href="#" id="loginLink"  class="login-link">Login</a></p>
                    </div>
                </form>
            </div>
    </div>

    <script src="lol.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

