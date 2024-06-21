<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'banco_nonna';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Problema nel connettersi al database: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'])) {

	exit('Username e/o password mancanti');
}

if (empty($_POST['username']) || empty($_POST['password'])) {
	exit('Username e/o password mancanti');
}
if ($stmt = $con->prepare('SELECT user_id, password FROM utenti WHERE username = ?'))
{
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		echo 'Username già esistente';
        exit;
	} else {
		if ($stmt = $con->prepare('INSERT INTO utenti (nome, cognome, username, password, ruolo) VALUES (?, ?, ?, ?, ?)')) {
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$ruolo = "user";
			$stmt->bind_param('sssss', $_POST['nome'], $_POST['cognome'], $_POST['username'], $password, $ruolo);
			$stmt->execute();
				echo 'Account registrato; verrai trasferito presto alla schermata di login!';
				header('Location: login.html');
			} else {
				echo 'Errore durante la registrazione dell\'account.';
			}
		} 
	}		

$con->close();
?>