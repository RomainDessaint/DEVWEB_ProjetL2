<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

$temp = loginAdministrator();

echo display_header("Connexion Administrateurs", "../styles/style_logpages.css");
?>

<section>
	<h1> Espace Gestionnaire </h1>
	<article>
		<?php

		$temp = "<p style = 'color:#FF0000'> $temp </p>";
		echo formLoginAdministrator();
		echo $temp;

		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
