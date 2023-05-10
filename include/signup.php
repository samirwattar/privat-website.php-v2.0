<?php
    include_one 'db.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO users (username, email, pass)
        VALUES ('$username', '$email', '$pass');";
    mysqli_query($conn, $sql);

    header("Location: ../index.php?signup=success"):
