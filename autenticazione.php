<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'banco_nonna';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Problema nel connettersi al database: ' . mysqli_connect_error());
}
if ( !isset($_POST['username'], $_POST['password']) ) {
    exit('Username o password mancanti.');
}

if ($stmt = $con->prepare('SELECT user_id,nome,cognome,username,password,ruolo FROM utenti WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc)
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $nome, $cognome,$username, $password, $ruolo);
	$stmt->fetch();
   // echo $stms;
	// $passwordhashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
	// $_POST['password']
	if (password_verify($_POST['password'], $password)){
		session_regenerate_id();	
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['nome'] = $nome;
		$_SESSION['cognome'] = $cognome;
        $_SESSION['username'] = $username;
		$_SESSION['id'] = $id;
		$_SESSION['ruolo'] = $ruolo;
		if ($ruolo == 'admin') {
			header('Location: dashboard/dashboard_admin.php');
		} else {
			header('Location: dashboard/dashboard_utente.php');
		}
	} else {
		$messaggio_errore = "Password incorretta, riprova";
		header("Location: login.html?error=$messaggio_errore");
	}
	}
	else {
		$messaggio_errore = "Password incorretta, riprova";
		header("Location: login.html?error=$messaggio_errore");
		//echo 'Username inesistente!';
		// sleep(6);
		//header("Location: index.html");
	}
	}

	$stmt->close();
?>