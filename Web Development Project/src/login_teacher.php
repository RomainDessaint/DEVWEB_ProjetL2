<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");
echo display_header("Connexion Professeurs", "../styles/style_logpages.css");
?>

<section>
	<h1> ESPACE PROFESSEURS </h1>
	<article>
		<h2> Connectez-vous : </h2>
		<?php
		echo formLoginTeacher();
		if (isset($_POST['submit'])) {
			echo loginTeacher();
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
