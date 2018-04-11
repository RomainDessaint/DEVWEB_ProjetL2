<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");
echo display_header("Espace gestionnaires", "../styles/style_logpages.css");
?>

<section>
	<h1> ESPACE GESTIONNAIRES </h1>
	<article>
		<h2> Créer une session : </h2>
		<?php
		echo formCreateLogin();
		if (isset($_POST['submit'])) {
			echo createLogin();
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
