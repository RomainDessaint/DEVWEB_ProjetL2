<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

$temp = loginStudent();

echo display_header("Connexion Etudiants", "../styles/style_logpages.css");
?>

<section>
	<h1> Espace étudiant </h1>
	<article>
		<?php

        $temp = "<p style = 'color:#FF0000'> $temp </p>";
		echo formLoginStudent();
		echo $temp;

		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
