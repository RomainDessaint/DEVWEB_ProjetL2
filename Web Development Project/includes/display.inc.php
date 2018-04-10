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

function display_footer() {
	$footer =
		'<footer>
			<a href = "#"> <h1> Retour haut de page </h1> </a>
		</footer>
		</body>
	</html>';
	return $footer;
}

function display_login() {
	$login = '<form method="post" action="src/TD7.php">';
	$login .= '<input type="submit" value="S\'identifier" name="login">';
	return $login;
}

?>
