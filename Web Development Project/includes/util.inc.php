<?php

////////////////////////////            ETUDIANTS          ////////////////////////////

//Affichage d'un formulaire de connexion pour un étudiant
function formLoginStudent() {
    $retour =  '<h2> Connectez-vous : </h2>';
    $retour .= '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Identifiant : </label> </td>';
    $retour .= '<td> <input type="text" name="id" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password" value=""> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '<input id="bouton" type="submit" value="Valider" name="submit">';
    $retour .= '</form>';

    return $retour;
}

//Authentification d'un étudiant
function loginStudent() {
    $error = "";
    if(isset($_POST)) {
        if (isset($_POST['id']) AND $_POST['password']) {
            $lignes = file("../ressources/private_student.csv");
            $i=0;
            $id = $_POST['id'];
            $password = $_POST['password'];
            foreach ($lignes as $ligne[]) {
                $content = explode(',',$ligne[$i]);
                if($content[0] == $id && password_verify($password, $content[1])) {
                    session_start();
                    $_SESSION['connected'] = true;
                    $_SESSION['login'] = $id;
                    $_SESSION['logType'] = 1;
                    header('location: logged_student.php');
                    exit();
                }
                else {
                    $error = "Le nom ou le mot de passe est incorrect </br>";
                }
                $i++;
            }
        }
        else {
            $error = "Veuillez vous identifier svp";
        }
    }
    return $error;
}

//Affichage d'un formulaire d'upload de photo
function formUpload(){
    $retour = '<form method="post" enctype="multipart/form-data">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Prénom : </label> </td>';
    $retour .= '<td> <input type="text" name="firstname" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Nom : </label> </td>';
    $retour .= '<td> <input type="text" name="name" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label for="file" class="label-file"> Choisir une image </label> <input id="file" class="input-file" type="file" name="img"> </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="Valider" name="submit"> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '</form>';

    return $retour;
}

//Upload de la photo d'un étudiant
function upload(){
    $retour = "";

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
                $retour = "Upload réussi !";
            } else {
                $retour = "Votre image est trop lourde !";
            }
        } else {
            $retour = "Une erreur est apparue lors de l'upload de votre image !";
        }
    } else {
        $retour = "Vous ne pouvez pas upload des fichiers de ce type !";
    }
    return $retour;
}

////////////////////////////            PROFESSEURS/SECRETAIRES         ////////////////////////////

//Affichage d'un formulaire de connexion pour un professeur/secrétaire
function formLoginTeacher() {
    $retour =  '<h2> Connectez-vous :</h2>';
    $retour .= '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Identifiant : </label> </td>';
    $retour .= '<td> <input type="text" name="id" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password" value=""> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '<input id="bouton" type="submit" value="Valider" name="submit">';
    $retour .= '</form>';

    return $retour;
}

//Authentification d'un professeur/secrétaire
function loginTeacher() {
    $error = "";
    if(isset($_POST)) {
        if (isset($_POST['id']) AND $_POST['password']) {
            $lignes = file("../ressources/private_teacher.csv");
            $i=0;
            $id = $_POST['id'];
            $password = $_POST['password'];
            foreach ($lignes as $ligne[]) {
                $content = explode(',',$ligne[$i]);
                if($content[3] == $id && password_verify($password, $content[4])) {
                    session_start();
                    $_SESSION['connected'] = true;
                    $_SESSION['login'] = $id;
                    $_SESSION['logType'] = 2;
                    header('location: logged_teacher.php');
                    exit();
                }
                else {
                    $error = "Le nom ou le mot de passe est incorrect </br>";
                }
                $i++;
            }
        }
        else {
            $error = "Veuillez vous identifier svp";
        }
    }
    return $error;
}

////////////////////////////            ADMINISTRATEUR          ////////////////////////////

//Affichage d'un formulaire de connexion pour un administrateur
function formLoginAdministrator() {
    $retour =  '<h2> Connectez-vous :</h2>';
    $retour .= '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Identifiant : </label> </td>';
    $retour .= '<td> <input type="text" name="id" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password" value=""> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '<input id="bouton" type="submit" value="Valider" name="submit">';
    $retour .= '</form>';

    return $retour;
}

//Authentification d'un administrateur
function loginAdministrator() {
    $error = "";
    if(isset($_POST)) {
        if (isset($_POST['id']) AND $_POST['password']) {
            $lignes = file("../ressources/private_administrator.csv");
            $i=0;
            $id = $_POST['id'];
            $password = $_POST['password'];
            foreach ($lignes as $ligne[]) {
                $content = explode(',',$ligne[$i]);
                if($content[3] == $id && password_verify($password, $content[4])) {
                    session_start();
                    $_SESSION['connected'] = true;
                    $_SESSION['login'] = $id;
                    $_SESSION['logType'] = 3;
                    header('location: logged_administrator.php');
                    exit();
                }
                else {
                    $error = "Le nom ou le mot de passe est incorrect </br>";
                }
                $i++;
            }
        }
        else {
            $error = "Veuillez vous identifier svp";
        }
    }
    return $error;
}

//Affichage d'un formulaire de création de session
function formCreateLogin() {
    $retour =  '<h2> Nouvelle session :</h2>';
    $retour = '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Session : </label> </td>';
    $retour .= '<td> <select name="session">';
    $retour .= '<option value ="teacher"> Professeur </option>';
    $retour .= '<option value ="teacher"> Secrétaire </option>';
    $retour .= '<option value ="administrator"> Gestionnaire </option>';
    $retour .= '</select> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Prénom : </label> </td>';
    $retour .= '<td> <input type="text" name="firstname" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Nom : </label> </td>';
    $retour .= '<td> <input type="text" name="name" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Sexe : </label> </td>';
    $retour .= '<td> <select name="gender">';
    $retour .= '<option value ="Homme"> M. </option>';
    $retour .= '<option value ="Femme"> Mme. </option>';
    $retour .= '</select> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Identifiant : </label> </td>';
    $retour .= '<td> <input type="text" name="id" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password1" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> re-Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password2" value=""> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '<input id="bouton" type="submit" value="Valider" name="submit">';
    $retour .= '</form>';

    return $retour;
}

function createLogin() {
    $temp = '';
    if(isset($_POST['submit'])) {
        $session = $_POST['session'];
        $firstname = $_POST['firstname'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $id = $_POST['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if($session =='' || $firstname=='' || $name=='' || $gender=='' || $id=='' || $password1=='' || $password2=='' ) {
            $error = 'Champs requis';
        }
        if($password1 != $password2) {
            $error = 'Les mots de passe ne correspondent pas';
        }

        if(!isset($error)) {
            $end = null;
            $crypted = password_hash($password1, PASSWORD_BCRYPT);
            $content = array(
                'firstname'	=>	$firstname,
                'name'		=>	$name,
                'gender'	=>	$gender,
                'id'        =>	$id,
                'crypted'	=>	$crypted,
                $end,
            );
            if($session == 'teacher') {
                $file = fopen("../ressources/login_teacher.csv","a");
            }
            elseif($session == 'administrator') {
                $file = fopen("../ressources/login_administrator.csv","a");
            }
            fputcsv($file, $content);
            fclose($file);
            $temp .= "Session créée";
            $temp .= "<p style = 'color:#00FF00'> $temp </p>";
        }
    }
    if(isset($error)) {
        $temp .= "<p style = 'color:#FF0000'> $error </p>";
    }
    return $temp;
}

function formDisconnect(){
    $retour = '<form action>';
    $retour .= '<input id="bouton" type="submit" value="deconnecter" name="disconect">';
    $retour .= '</form>';
}
?>
