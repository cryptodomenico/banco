<!DOCTYPE html>
<html lang="it">
<head> <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gioco</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Favicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <!-- FancyBox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/custom.js"></script>
    <!-- Scrollbar Custom JS -->
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- FancyBox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <!-- jQuery script for sidebar -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <script>
        window.history.replaceState({}, '', 'gioco.php'); // Script per evitare la memorizzazione della cronologia
    </script>
</head>
<body>
<?php
session_start();
$maxpuntata = 500;
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
if (!isset($saldo))
{
    $saldo = getsaldo();
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $saldo = getsaldo();
}
echo "Saldo attuale: <strong>$saldo</strong>";
if (isset($_POST['scommessa']))
{
    $scommessa = $_POST['scommessa'];
}
echo "<br>";
echo '<form method="post" action="gioco.php">
<label for="puntata">Inserisci la puntata:</label>
<input type="number" id="scommessa" name="scommessa" min="1" max="' . $saldo . '" required>
<button type="submit" name="piazza_scommessa">Piazza Scommessa</button>
</form>';
   

$valoriCarte = [
    "denara1.png" => 1, "denara2.png" => 2, "denara3.png" => 3, "denara4.png" => 4, "denara5.png" => 5, "denara6.png" => 6, "denara7.png" => 7, "denara8.png" => 8, "denara9.png" => 9, "denara10.png" => 10,
    "spade1.png" => 1, "spade2.png" => 2, "spade3.png" => 3, "spade4.png" => 4, "spade5.png" => 5, "spade6.png" => 6, "spade7.png" => 7, "spade8.png" => 8, "spade9.png" => 9, "spade10.png" => 10,
    "bastoni1.png" => 1, "bastoni2.png" => 2, "bastoni3.png" => 3, "bastoni4.png" => 4, "bastoni5.png" => 5, "bastoni6.png" => 6, "bastoni7.png" => 7, "bastoni8.png" => 8, "bastoni9.png" => 9, "bastoni10.png" => 10,
    "coppe1.png" => 1, "coppe2.png" => 2, "coppe3.png" => 3, "coppe4.png" => 4, "coppe5.png" => 5, "coppe6.png" => 6, "coppe7.png" => 7, "coppe8.png" => 8, "coppe9.png" => 9, "coppe10.png" => 10
];

if (isset($_POST['piazza_scommessa'])) {
    // Verifica che la scommessa non sia superiore al saldo disponibile
    if ($scommessa <= $saldo) {
      //  $scommessa = $_SESSION['scommessa'];
        echo "Puntata: <strong>$scommessa</strong> <br>";
        
    } else {
        echo "Errore: Scommessa superiore al saldo disponibile.";
        exit;
    }
}

// Mostra la carta coperta
if (!isset($scommessa))
{
    $cartaCoperta="img/retro.jpg";
    echo "<img src='../$cartaCoperta' alt='Carta Coperta' width='130' height='200'>";
    echo "<br>";
}
global $cartaCasuale;
function  generaCartaCasuale($valoriCarte) {
    // Seleziona casualmente una carta dall'array dei valori delle carte

    $cartaCasuale = array_rand($valoriCarte, 1);
    return $cartaCasuale;
}
if (isset($scommessa))
{
    $cartaCasuale = generaCartaCasuale($valoriCarte);   
}
else
{
    exit;
}



// Attendi qualche secondo prima di mostrare la carta casuale
//sleep(10);
echo "<br>";
// Mostra la carta casuale
echo "<img src='../img/$cartaCasuale' alt='Carta Casuale' width='130' height='200'>";

// Logica di gioco
$valoreCartaCasuale = $valoriCarte[$cartaCasuale];
if ($valoreCartaCasuale <= 6) {
    echo "<br>Hai perso!<br>";

	rimuovi_fondi($_SESSION['id'], $scommessa);
	banco_vince($scommessa);
    $saldo = getsaldo();
   // $_SESSION['fondo'] += $_POST['scommessa'];
} elseif ($valoreCartaCasuale >= 7) {
    echo "<br>Hai vinto!<br>";
	$vincita = $scommessa * 2;
	aggiungi_fondi($_SESSION['id'], $vincita);

    $saldo = getsaldo();
    // $_SESSION['saldo'] += $_POST['scommessa'];
}
function banco_vince($puntata)
{
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'banco_nonna';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}
	$query = "UPDATE utenti SET saldo = saldo + ? WHERE user_id = 3";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('d', $puntata);
        if ($stmt->execute()) {
           
        } else {
            echo "Errore nell'aggiunta dei fondi: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Errore nella preparazione della query: " . $con->error;
    }
}
function aggiungi_fondi($id,$vincita)
{
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'banco_nonna';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}
	$query = "UPDATE utenti SET saldo = saldo + ? WHERE user_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('di', $vincita, $id);
        if ($stmt->execute()) {
			$saldo = getsaldo();
            echo "Fondi aggiunti con successo. Il tuo nuovo saldo è <strong>$saldo</strong>";
        } else {
            echo "Errore nell'aggiunta dei fondi: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Errore nella preparazione della query: " . $con->error;
    }
}
function getsaldo() {
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'banco_nonna';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

	if (mysqli_connect_errno()) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	$query = "SELECT saldo FROM utenti WHERE user_id = ?";
	if ($stmt = $con->prepare($query)) {
		$stmt->bind_param('i', $_SESSION['id']);
		$stmt->execute();
		$stmt->bind_result($saldo);
		$stmt->fetch();
		$stmt->close();
		return $saldo;
	} else {
		echo "Errore nella preparazione della query: " . $con->error;
		return false;
	}
}
function rimuovi_fondi($id, $scommessa)
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'banco_nonna';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    $query = "UPDATE utenti SET saldo = saldo - ? WHERE user_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('di', $scommessa, $id);
        if ($stmt->execute()) {
            $saldo = getsaldo();
            echo "Fondi rimossi con successo. Il tuo saldo attuale è <strong>$saldo</strong>";
        } else {
            echo "Errore nella rimozione dei fondi: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Errore nella preparazione della query: " . $con->error;
    }
}

echo '<form method="post" action="gioco.php">
<input type="hidden" name="scommessa" value="' . $scommessa . '">
<button type="submit" name="piazza_scommessa">Gioca di nuovo</button>
</form>';
echo '<form method="post" action="gioco.php">
<input type="hidden" name="scommessa" value="' . ($scommessa * 2) . '">
<button type="submit" name="piazza_scommessa">Gioca di nuovo x2</button>
</form>';

echo "<a href='dashboard_utente.php'><button type='button'>Torna alla home</button></a>"
?>
</body>
</html>
