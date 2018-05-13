<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
if(($_SESSION['logType']) != 3) {
  header('location: login_administrator.php');
  exit();
}

if(isset($_POST['newsession'])) {
	header('location: newsession_administrator.php');
	exit();
}

for($i=0; $i<3; $i++) {
	if(isset($POST['modifyadmin'.$i])) {

	}
}

echo display_header("Espace gestionnaires", "../styles/style_sessionpages.css");
?>

<section>
     <?php
	echo display_titleLog("Espace Gestionnaires");
	?>

	<article>

		<?php
               echo displaySessions();
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
