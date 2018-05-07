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
	<h1> ESPACE GESTIONNAIRES </h1>
	<article>
		<?php
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
