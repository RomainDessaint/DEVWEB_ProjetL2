<?php
	include("../includes/display.inc.php");
	include("../includes/isset.inc.php");
	echo display_header("Espace professeurs", "../styles/style_logpages.css");
?>

<section>
	<h1> ESPACE PROFESSEURS </h1>
	<article>
		<h2> Connectez-vous : </h2>
		<?php
		echo formLogin();
		?>
	</article>
</section>
