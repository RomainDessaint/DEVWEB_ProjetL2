<?php
	include("includes/display.inc.php");
	include("includes/util.inc.php");
	echo display_header("ENT - Accueil", "styles/style_index.css");
?>

<section>
	<h1> Accueil </h1>
	<article>
		<a href="src/etudiants"> <h2> ESPACE ETUDIANTS </h2> </a>
	</article>
	<article>
		<a href="src/professeurs"> <h2> ESPACE PROFESSEURS </h2> </a>
	</article>
	<article>
		<a href="src/gestionnaires"> <h2> ESPACE GESTIONNAIRES </h2> </a>
	</article>
</section>

<?php
	echo display_footer();
?>
