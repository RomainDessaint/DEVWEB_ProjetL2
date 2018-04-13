<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");
echo display_header("Connexion Administrateurs", "../styles/style_logpages.css");
?>

<section>
	<h1> ESPACE GESTIONNAIRES </h1>
	<article>
		<?php
		echo formLoginAdministrator();
		if (isset($_POST['submit'])) {
			echo loginAdministrator();
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
