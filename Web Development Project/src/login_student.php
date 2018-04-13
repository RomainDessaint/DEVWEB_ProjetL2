<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");
echo display_header("Connexion Etudiants", "../styles/style_logpages.css");
?>

<section>
	<h1> Espace étudiant </h1>
	<article>
		<?php
		echo formLoginStudent();
		if (isset($_POST['submit'])) {
			echo loginStudent();
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
