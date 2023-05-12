<?php
session_start();

// initialiserar variabler
$username = "";
$email = "";
$errors = array(); 

//anslut till databasen
$db = mysqli_connect('localhost', 'root', '', 'clients');

//registera användare
if (isset($_POST['submit'])) {
  //hämta alla inmatade värden från formuläret
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  //$password_hash = password_hash($password, PASSWORD_DEFAULT);  //kryptera lösenordet

  //validera formuläret
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  //kontrollera om användarnamn eller e-postadress redan finns i databasen
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

   //registrera användaren om det inte finns några fel i formuläret
  if (count($errors) == 0) {
    //använd förberedda uttalanden för att förhindra SQL-injektionsattacker
    $stmt = $db->prepare("INSERT INTO users (username, email, pass) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now registered and logged in";
    header('location: index.php');
  }
}






//den fungerar inte ännu men är fortfarande under utveckling 
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: random.php');
  	}else {
  		array_push($errors, "Wrong email/password combination");
      echo "wrong";
  	}
  }
}

?>

