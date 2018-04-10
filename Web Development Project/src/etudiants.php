<?php
include("../includes/display.inc.php");
include("../includes/isset.inc.php");
include("../includes/util.inc.php");
echo display_header("Espace étudiants", "../styles/style_logpages.css");
?>

<section>
	<h1> Espace étudiant </h1>
	<article>
		<h2> Connectez-vous : </h2>
		<?php
		echo formLogin();
		if (isset($_POST['submit'])) {
				echo csvFile();
			}
		?>
	</article>
</section>
