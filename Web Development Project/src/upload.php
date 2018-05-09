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
            }
        } else {
            echo "Une erreur est apparue lors de l'upload de votre image !";
        }
    } else {
        echo "Vous ne pouvez pas upload des fichiers de ce type !";
    }
}
?>
