<?php
include("includes/display.inc.php");
include("includes/util.inc.php");

session_start();
session_destroy();

echo display_header("ENT - Accueil", "styles/style_index.css");
?>

<section>
	<?php
	echo display_titleLog("Accueil");
	?>

	<article>
		<a href="src/choice_student.php"> <h2> ESPACE ETUDIANTS </h2> </a>
	</article>
	<article>
		<a href="src/login_teacher.php"> <h2> ESPACE PROFESSEURS </h2> </a>
	</article>
	<article>
		<a href="src/login_administrator.php"> <h2> ESPACE GESTIONNAIRES </h2> </a>
	</article>
</section>

<?php
echo display_footer("up");
?>
