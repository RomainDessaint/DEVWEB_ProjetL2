<?php
include("../includes/display.inc.php");
include("../includes/util.inc.php");

session_start();
$temp = loginTeacher();

echo display_header("Connexion Professeurs", "../styles/style_logpages.css");
?>

<section>
	<?php
	echo display_titleLog("Espace Professeurs");
	?>

	<article>

		<?php
     	$temp = "<p style = 'color:#FF0000'> $temp </p>";
		echo formLoginTeacher();
		echo $temp;
		?>

	</article>
</section>

<?php
echo display_footer("back");
?>
