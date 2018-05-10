<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();

if(isset($_POST['register'])) {
	header('location: register_student.php');
}

if(isset($_POST['signin'])) {
	header('location: login_student.php');
}

echo display_header("Espace Etudiants", "../styles/style_logpages.css");
?>

<section>
	<?php
	echo display_titleLog("Espace Etudiants");
	?>

	<article>
		<?php
		echo formChoiceStudent();
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
