<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
if(($_SESSION['logType']) != 3) {
	header('location: login_administrator.php');
	exit();
}

echo display_header("Espace gestionnaires", "../styles/style_logpages.css");
?>

<section>
	<?php
	echo display_titleLog("Espace Gestionnaires");
	?>

	<h2 id="orga"> Organisation des groupes de TD </h2>
	<article style="width:49%; float:left; min-height: 370px;">
		<?php
		echo formRepertoryCreator();

		if (isset($_POST['submitFiliere']) OR isset($_POST['submitGroupe']) && !isset($_POST['submit'])) {
			echo repertoryCreator();
		}
		?>
	</article>
	<article style="width:49%; float: right; min-height: 370px; max-height:350px;">
		<?php
			echo formRepertoryRemoval();

		if (isset($_POST['submit'])) {
			echo repertoryRemoval();
		}
		?>
	</article>
	<article>
		<?php
		echo displayFilieres();

		echo btnRetour();
		if (isset($_POST['retour'])) {
			header("location: choice_administrator.php");
		}
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
