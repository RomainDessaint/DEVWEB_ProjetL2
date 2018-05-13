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

	<article>

		<?php
		echo formRepertoryCreator();

		if(isset($_POST['submitArborescence'])) {
			header('location: administrator_arborescence.php');
		}
		if (isset($_POST['submitFiliere']) && empty($_POST['submitGroupe'])){
			echo repertoryCreator();
		}
		if (isset($_POST['submitGroupe']) && empty($_POST['submitFiliere'])){
			echo repertoryCreator();
		}
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
