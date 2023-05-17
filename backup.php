<?php
session_start();

//initialiserar variabler
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
    header('location: index.php');
  }
}





// Kontrollera om login formuläret har skickats
if (isset($_POST['login'])) {
//Hämta e-postadressen från formuläret och filtrera den mot sql injektioner
  $email = mysqli_real_escape_string($db, $_POST['email']); 
  //Hämta lösenordet från formuläret och filtrera det mot sql injektioner
  $password = mysqli_real_escape_string($db, $_POST['password']); 
//Kontrollera om e-postadressen är tom
  if (empty($email)) { 
    //Lägg till ett felmeddelande till $errors arrayen
  	array_push($errors, "email is required"); 
  }
  //Kontrollera om lösenordet är tomt
  if (empty($password)) { 
  //Lägg till ett felmeddelande till $errors-arrayen
  	array_push($errors, "Password is required"); 
  }

  //Kontrollera om det finns några felmeddelanden
  if (count($errors) == 0) { 
    //Skapa en SQL fråga för att hämta användaren från databasen
  	$query = "SELECT * FROM users WHERE email='$email' AND pass='$password'"; 
    //Skicka SQL frågan till databasen och spara resultatet i $results
  	$results = mysqli_query($db, $query); 
    //kontrollera om det finns en användare med den angivna e-postadressen och lösenordet
  	if (mysqli_num_rows($results) == 1) { 
      //Spara e-postadressen i sessionsvariabeln $_SESSION
  	  $_SESSION['email'] = $email; 
      //Spara ett meddelande om att inloggningen lyckades i sessionsvariabeln $_SESSION
  	  $_SESSION['success'] = "You are now logged in"; 
      //Omdirigera användaren till en annan sida
  	  header('location: random.php'); 
  	}else {
      //Lägg till ett felmeddelande till $errors-arrayen om e-postadressen eller lösenordet är felaktigt
  		array_push($errors, "Wrong email/password combination"); 
      //Skriv ut wrong om inloggningen misslyckades
      echo "wrong";
  	}
  }
}

?>

