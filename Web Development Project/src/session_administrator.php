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

for($i=0; $i<5; $i++) {
	if(isset($_POST['deleteadmin'.$i])) {
		$temp = deleteSession($i, 1);
	}
}
for($i=0; $i<3; $i++) {
	if(isset($_POST['deleteteacher'.$i])) {
		$temp = deleteSession($i, 2);
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
		if(isset($temp)) {
			echo $temp;
		}
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
