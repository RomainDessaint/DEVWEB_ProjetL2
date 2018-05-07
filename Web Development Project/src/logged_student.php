<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
if(($_SESSION['logType']) != 1) {
  header('location: login_student.php');
  exit();
}

echo display_header("Espace Etudiants", "../styles/style_logpages.css");
?>

<section>
	<h1> ESPACE ETUDIANTS </h1>
	<article>
		<?php

		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
