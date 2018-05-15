<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
$temp = loginStudent();

echo display_header("Connexion Etudiants", "../styles/style_logpages.css");
?>

<section>
	<?php
	echo display_titleLog("Espace Etudiants");
	?>

	<article>
		<?php
		$temp = "<p style = 'color:#FF0000'> $temp </p>";
		echo formLoginStudent();

		if(isset($_POST['login'])) {
			echo $temp;
		}
		?>
	</article>
</section>

<?php
echo display_footer("back");
?>
