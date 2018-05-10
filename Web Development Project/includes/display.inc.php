<?php

function display_header($title, $stylesheet) {
	$header =
	'<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="' .$stylesheet .'"/>
	<title>' .$title .'</title>
	</head>

	<body>
	<header>
	<div id = banniere>
	<h1 id = titre_principal> Environnement Numérique de Travail </h1>
	</div>
	</header>';
	return $header;
}

function display_footer($type = "up") {
	if($type == "up") {
		$footer =
		'<footer>
		<a href = "#"> <h1> Retour haut de page </h1> </a>
		</footer>
		</body>
		</html>';
	}
	elseif ($type == "back") {
		$footer =
		'<footer>
		<a href = "../index.php"> <h1> Retour à l\'accueil </h1> </a>
		</footer>
		</body>
		</html>';
	}
	return $footer;
}

function display_titleLog($title = "Espace ?") {
	$retour = "<table id = 'titleLog'> <tr>";
	$retour .= "<td> <table id = 'title'>";
	$retour .= "<tr> <td> <h1> $title </h1> </td> </tr>";
	$retour .= "</table> </td>";
	$retour .= "<td> <table id = 'info'>";
	if(isset($_SESSION['connected'])) {
		switch($_SESSION['logType']) {
			case 1:
				$retour .= "<tr> <td> Profil : Etudiant </td> </tr>";
				break;
			case 2:
				$retour .= "<tr> <td> Profil : Professeur </td> </tr>";
				break;
			case 3:
				$retour .= "<tr> <td> Profil : Gestionnaire </td> </tr>";
				break;
		}
		$retour .= "<tr> <td> Connecté en tant que : " .$_SESSION['login'] ."</td> </tr>";
		$retour .= "<tr> <td> <a href = '../includes/deconnexion.inc.php'> Se déconnecter </a> </td> </tr>";
	}
	else {
		$retour .= "<tr> <td> <p> Vous n'êtes pas connecté </p> </td> </tr>";
	}
	$retour .= "</table> </td>";
	$retour .= "</tr> </table>";

	return $retour;
}

?>
