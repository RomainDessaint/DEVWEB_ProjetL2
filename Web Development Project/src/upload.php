<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];

    $fileExt = explode('.', $fileName);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("location: logged_student.php?uploadsuccess");
            } else {
                echo "Votre image est trop lourde !";
                echo "<h1><a href='login_student.php'>Retour</a></h1>";
            }
        } else {
            echo "Une erreur est apparue lors de l'upload de votre image !";
            echo $fileError;
            echo "<h1 style=font-family: 'Century Gothic',CenturyGothic,AppleGothic,sans-serif;><a style='text-decoration:none;' href='logged_student.php'>Retour</a></h1>";
        }
    } else {
        echo "Vous ne pouvez pas upload des fichiers de ce type !";
        echo "<h1><a href='login_student.php'>Retour</a></h1>";
    }
}
?>
