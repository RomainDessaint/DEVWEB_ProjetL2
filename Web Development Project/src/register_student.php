<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();

echo display_header("Inscription Etudiants", "../styles/style_logpages.css");
?>

<section>
	<?php
	echo display_titleLog("Espace Etudiants");
	?>

	<article>
		<?php
		echo formRegisterStudent();
		if (isset($_POST['retour'])) {
			header("location: login_student.php");
		}

		if(isset($_POST['register'])) {
			echo registerStudent();
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
