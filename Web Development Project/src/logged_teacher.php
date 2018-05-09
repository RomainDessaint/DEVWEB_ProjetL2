<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
if(($_SESSION['logType']) != 2) {
  header('location: login_teacher.php');
  exit();
}

echo display_header("Espace professeurs", "../styles/style_logpages.css");
?>

<section>
     <?php
	echo display_titleLog("Espace Professeurs");
	?>

	<article>

		<?php
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
