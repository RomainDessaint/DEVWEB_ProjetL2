<?php

////////////////////////////            ETUDIANTS          ////////////////////////////

//Affichage des possibilités de l'espace étudiant
function formChoiceStudent() {
    $retour = '<table> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Première connexion ? </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="S\'inscrire" name="register"> </td>';
    $retour .= ' </form> </tr> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Déja inscrit ? </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="Se connecter" name="signin"> </td>';
    $retour .= '</form> </tr> </table>';

    return $retour;
}

//Affichage d'un formulaire d'inscription étudiant
function formRegisterStudent() {
    $retour =  '<h2> Inscrivez-vous : </h2>';
    $retour .= '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> N° étudiant : </label> </td>';
    $retour .= '<td> <input type="text" name="num" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Identifiant : </label> </td>';
    $retour .= '<td> <input type="text" name="id" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password1" value="" placeholder="8 caractères min."> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Confirmer le mot de passe : </label> </td>';
    $retour .= '<td> <input type="password" name="password2" value=""> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '<input id="bouton" type="submit" value="Valider" name="register">';
    $retour .= '</form>';

    return $retour;
}

//Fonction d'inscription pour un étudiant
function registerStudent() {
    if (isset($_POST['num']) AND isset($_POST['id']) AND $_POST['password1'] AND $_POST['password2']) {
        $num = $_POST['num'];
        $id = $_POST['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        $i=0;
        $lignes = file("../ressources/private_student.csv");
        foreach ($lignes as $ligne[]) {
            $fileContent = explode(',',$ligne[$i]);
            if($fileContent[0] == $num) {
                return '<p style = "color:#FF0000"> Vous êtes déjà inscrit ! </p>';
            }
            $i++;
        }
        if (is_numeric($num)) {
            if(strlen($password1) >= 8){
                if($password1 === $password2){
                    $end = null;
                    $crypted = password_hash($password1, PASSWORD_BCRYPT);
                    $content = array(
                        'num'		=>	$num,
                        'id'	    =>	$id,
                        'crypted'	=>	$crypted,
                        $end,
                    );
                    $file = fopen("../ressources/private_student.csv","a");
                    fputcsv($file, $content);
                    fclose($file);
                    $temp = "<p style = 'color:#00FF00'> Session créée </p>";
                } else {
                    $temp = "<p style = 'color:#FF0000'> Les mots de passe ne sont pas identiques ! </p>";
                }
            } else {
                $temp = "<p style = 'color:#FF0000'> Le mot de passe est trop court </p>";
            }
        } else {
            $temp = "<p style = 'color:#FF0000'> Le numéro étudiant ne doit être composé que de chiffres ! </p>";
        }
    } else {
        $temp = '<p style = "color:#FF0000"> Champs requis </p>';
    }
    return $temp;
}

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
    $retour .= '<input id="bouton" type="submit" value="Valider" name="login">';
    $retour .= '</form>';

    return $retour;
}

//Fonction d'authentification d'un étudiant
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
                if($content[1] == $id && password_verify($password, $content[2])) {
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
    $retour = '<form method="post" enctype="multipart/form-data" action="logged_student.php#">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<th> Filières </th>';
    $retour .= '<th> Groupes </th>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <select id="list" onchange="getSelectValue();">';
    $retour .= '<option value="" selected="selected"> Choisissez une filière </option>';

    $dir = directoryReading();
    $i = 0;
    foreach ($dir as $directories[$i]) {
        $retour .= '<option ';
        if(isset($_GET["filiere"]) && $_GET["filiere"] == $directories[$i] && !isset($_POST['submit'])){
            $retour .= 'selected="selected"';
        }
        $retour .= 'value="'.$directories[$i].'">'.$directories[$i].'</option>';
        $i++;
    }

    $retour .= '</select> </td>';

    $retour .= '<script>

    function getSelectValue(){
        var selectedValue = document.getElementById("list").value;
        window.location.href="logged_student.php?filiere="+selectedValue;
    }

    </script>';

    $retour .= '<td> <select name="selectGroupes">';
    $retour .= '<option value="" selected="selected"> Choisissez un groupe </option>';

    if(isset($_GET["filiere"])){
        $listChoice = $_GET["filiere"];
        $dir2 = directoryReading("Admin/$listChoice");
        $j = 0;
        foreach ($dir2 as $directories[$j]) {
            $retour .= '<option value="'.$directories[$j].'">'.$directories[$j].'</option>';
            $j++;
        }
    }

    $retour .= '</select>';
    $retour .= '</tr>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Prénom : </label> </td>';
    $retour .= '<td> <input type="text" name="firstname" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> <label> Nom : </label> </td>';
    $retour .= '<td> <input type="text" name="name" value=""> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td colspan="2"> <input id="real-file" hidden="hidden" type="file" name="img" /> <button type="button" id="custom-button">Choisir une image</button> <span id="custom-text">Aucune image choisie.</span></td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td colspan=2> <input id="bouton" type="submit" value="Valider" name="submit"> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    $retour .= '</form>';
    return $retour;
}

function upload(){
    $retour = "";
    $end = null;
    // Varibles pour le prénom et le nom
    $firstname = $_POST['firstname'];
    $name = $_POST['name'];
    // Partie concernant l'image
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if (($firstname != null) AND ($name != null) AND ($fileName != null)) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../uploads/'.$fileNameNew;
                    // Partie concernant le nom et le prénom
                    $content = array(
                        'firstname'	=>	$firstname,
                        'name'		=>	$name,
                        'img'		=>	$fileNameNew,
                        $end,
                    );
                    $file = fopen("../ressources/info_student.csv","a");
                    fputcsv($file, $content);
                    fclose($file);
                    // Fin de la Partie concernant le nom et le prénom
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $retour = "<p style='color: #00FF00;'> Upload réussi ! </p>";
                } else {
                    $retour = "Votre image est trop lourde !";
                }
            } else {
                $retour = "Une erreur est apparue lors de l'upload de votre image !";
            }
        } else {
            $retour = "Vous ne pouvez pas upload des fichiers de ce type !";
        }
    } else {
        $retour = "Veuillez renseignez un nom, un prénom, ainsi qu'une image !";
    }
    // Fin de la partie concernant l'image
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
    $retour .= '<input id="bouton" type="submit" value="Valider" name="login">';
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
                    header('location: choice_teacher.php');
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
    $retour .= '<input id="bouton" type="submit" value="Valider" name="login">';
    $retour .= '</form>';

    return $retour;
}

//Fonction d'authentification d'un administrateur
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
                    header('location: choice_administrator.php');
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

//Affichage des possibilités de l'espace administrateur
function formChoiceAdministrator() {
    $retour = '<table> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Gérer les filières : </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="OK" name="group"> </td>';
    $retour .= ' </form> </tr> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Gérer les sessions : </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="OK" name="session"> </td>';
    $retour .= '</form> </tr> </table>';

    return $retour;
}

//Fonction d'affichages des sessions
function displaySessions() {
    $retour = '<h2> Gérer les sessions d\'accès à la plateforme <h2>';
    $retour .= '<table> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Nouvelle session : </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="OK" name="newsession"> </td>';
    $retour .= '</tr>';
    $retour .= '</table>';
    //Tableau des sessions administrateurs
    $adminLignes = file("../ressources/private_administrator.csv");
    $retour .= '<table class="content">';
    $retour .= '<tr> <td colspan="5" style="text-align: center;"> Sessions administrateurs </td> </tr>';

    if(fileSize("../ressources/private_administrator.csv") < 70) {
        $retour .= '<tr> <td colspan="5" style="text-align: center;"> Aucune session administrateur </td> </tr>';
    }
    else {
        $i = 0;
        $retour .= '<tr> <th style="text-align: center;"> Nom </th>';
        $retour .= '<th style="text-align: center;"> Prénom </th>';
        $retour .= '<th style="text-align: center;"> Identifiant </th>';
        $retour .= '<th colspan="2"> Options </th> </tr>';
        foreach ($adminLignes as $adminLigne[]) {
            $admintest = trim($adminLigne[$i]);
            if(empty($admintest)) {
                break;
            }
            else {
                $adminContent = explode(',',$adminLigne[$i]);
                $retour .= '<tr> <td style="text-align:center;">' .$adminContent[1] .'</td>';
                $retour .= '<td style="text-align:center;">' .$adminContent[0] .'</td>';
                $retour .= '<td style="text-align:center;">' .$adminContent[3] .'</td>';
                $retour .= '<td style="text-align: center;"> <input id="bouton" type="submit" value="Modifier" name="modifyadmin'.$i.'"> </td>';
                $retour .= '<td style="text-align: center;"> <input id="bouton" type="submit" value="Supprimer" name="deleteadmin'.$i.'"> </td>';
                $retour .= '</tr>';
                $i++;
            }
        }
    }
    $retour .= '</table>';

    //Tableau des sessions professeurs/secretaires
    $teacherLignes = file("../ressources/private_teacher.csv");
    $retour .= '<table class="content">';
    $retour .= '<tr> <td colspan="5" style="text-align: center;"> Sessions secretaires </td> </tr>';
    if(fileSize("../ressources/private_teacher.csv") < 70) {
        $retour .= '<tr> <td colspan="5" style="text-align: center;" class="big"> Aucune session secrétaire </td> </tr>';
    }
    else {
        $j = 0;
        $retour .= '<tr> <th style="text-align: center;"> Nom </th>';
        $retour .= '<th style="text-align: center;"> Prénom </th>';
        $retour .= '<th style="text-align: center;"> Identifiant </th>';
        $retour .= '<th colspan="2"> Options </th> </tr>';
        foreach ($teacherLignes as $teacherLigne[]) {
            $teachertest = trim($teacherLigne[$j]);
            if(empty($teachertest)) {
                break;
            }
            else {
                $teacherContent = explode(',',$teacherLigne[$j]);
                $retour .= '<tr> <td style="text-align:center;">' .$teacherContent[1] .'</td>';
                $retour .= '<td style="text-align:center;">' .$teacherContent[0] .'</td>';
                $retour .= '<td style="text-align:center;">' .$teacherContent[3] .'</td>';
                $retour .= '<td style="text-align: center;"> <input id="bouton" type="submit" value="Modifier" name="modifyteacher'.$j.'"> </td>';
                $retour .= '<td style="text-align: center;"> <input id="bouton" type="submit" value="Supprimer" name="deleteteacher'.$j.'"> </td>';
                $retour .= '</tr>';
                $j++;
            }
        }
    }
    $retour .= '</form>';
    $retour .= '</table>';
    return $retour;
}

//Affichage d'un formulaire de création de session
function formCreateLogin() {
    $retour =  '<h2> Créer une nouvelle session : </h2>';
    $retour .= '<form action="#" method = "post">';
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
    $retour .= '<input id="bouton" type="submit" value="Valider" name="createLogin">';
    $retour .= '</form>';

    return $retour;
}

//Fonction de création de sessions
function createLogin() {
    if(isset($_POST['createLogin'])) {
        $session = $_POST['session'];
        $firstname = $_POST['firstname'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $id = $_POST['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if($password1 != $password2) {
            $error = 'Les mots de passe ne correspondent pas';
        }
        if($session =='' || $firstname=='' || $name=='' || $gender=='' || $id=='' || $password1=='' || $password2=='' ) {
            $error = 'Champs requis';
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
                $file = fopen("../ressources/private_teacher.csv","a");
            }
            elseif($session == 'administrator') {
                $file = fopen("../ressources/private_administrator.csv","a");
            }
            fputcsv($file, $content);
            fclose($file);
            $temp = "<p style = 'color:#00FF00'> Session créée </p>";
        }
        if(isset($error)) {
            $temp = "<p style = 'color:#FF0000'> $error </p>";
        }
        return $temp;
    }
}

//Fonction permettant de compter le nombre de sessions
function countSession($sessionType) {
    if($sessionType == 1) {
        if(fileSize("../ressources/private_administrator.csv") < 70) {
            $error = 'Erreur lors de la supression de la session';
        }
        else {

        }
    }
    else if($sessionType == 2) {
        if(fileSize("../ressources/private_teacher.csv") < 70) {
            $error = 'Erreur lors de la supression de la session';
        }
        else {
        }
    }
}

//Fonction de suppression de session
function deleteSession($session, $sessionType) {
    if($sessionType == 1) {
        if(fileSize("../ressources/private_administrator.csv") < 70) {
            $error = 'Erreur lors de la supression de la session';
        }
        else {
            $file = fopen("../ressources/private_administrator.csv", "r");
            $fileContent = fread($file, filesize("../ressources/private_administrator.csv"));
            fclose($file);
            $fileContent = explode(PHP_EOL, $fileContent);
            unset($fileContent[$session]);
            $fileContent = array_values($fileContent);
            $fileContent = implode(PHP_EOL, $fileContent);
            $file = fopen("../ressources/private_administrator.csv", "w");
            fwrite($file, $fileContent);
            $retour = 'Session supprimée !';
        }
    }
    else if($sessionType == 2) {
        if(fileSize("../ressources/private_teacher.csv") < 70) {
            $error = 'Erreur lors de la supression de la session';
        }
        else {
            $file = fopen("../ressources/private_teacher.csv", "r");
            $fileContent = fread($file, filesize("../ressources/private_teacher.csv"));
            fclose($file);
            $fileContent = explode(PHP_EOL, $fileContent);
            unset($fileContent[$session]);
            $fileContent = array_values($fileContent);
            $fileContent = implode(PHP_EOL, $fileContent);
            $file = fopen("../ressources/private_teacher.csv", "w");
            fwrite($file, $fileContent);
            $retour = 'Session supprimée !';
        }
    }
    if(isset($error)) {
        $retour = '<p style="color: #FF0000;">' .$error .'</p>';
    }
    else if(!isset($error)) {
        $retour = '<p style="color: #00FF00;">' .$retour .'</p>';
    }
    return $retour;
}

//Fonction permettant l'affichage de l'arborescence des filières et des groupes
function displayFilieres() {
    $retour = '<h2> Aperçu des filières et des groupes </h2>';
    $root = "Admin";
    $filieres = directoryReading($root);
    $retour .= '<table>';
    $retour .= '<tr> <th> Filières </th> <th> </th> <th colspan="10" style="text-align: center;"> Groupes </th> </tr>';
    if(count($filieres) > 0) {
        for($i=0; $i<count($filieres); $i++) {
            $retour .= '<tr> <td style="text-align: center;">' .$filieres[$i] .'</td>';
            $groupe = $filieres[$i];
            $groupes = directoryReading("Admin/$groupe");
            $retour .= '<td> </td>';
            if(count($groupes) > 0) {
                for($j=0; $j<count($groupes); $j++) {
                    $retour .= '<td>' .$groupes[$j] .'</td>';
                }
            }
            $retour .= '</tr>';
        }
    }
    $retour .= '</table>';
    return $retour;
}

//Affichage d'un formulaire de création de filière ou de groupe
function formRepertoryCreator() {
    $retour = '<h2> Organisation des groupes de TD </h2>';
    $retour .= '<table> <tr>';
    $retour .= '<form action="#" method="post">';
    $retour .= '<td> Créez une filière : </td>';
    $retour .= '<td> <input id="bouton" type="text" value="" name="filiere"> </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="OK" name="submitFiliere"> </td>';
    $retour .= '</tr> <tr>';
    $retour .= '<td> Selectionnez une filière : </td>';
    $retour .= '<td> <select id="bouton" name="choix">';
    $retour .= '<option value="" selected="selected"> Aucune </option>';
    $dir = directoryReading();
    $i = 0;
    foreach ($dir as $directories[$i]) {
        if($directories[$i] != null)
            $retour .= '<option value="'.$directories[$i].'">'.$directories[$i].'</option>';
        $i++;
    }
    $retour .= '</select> </td> </tr>';
    $retour .= '<tr>';
    $retour .= '<td> Créez un groupe : </td>';
    $retour .= '<td> <input id="bouton" type="text" value="" name="groupe"> </td>';
    $retour .= '<td> <input id="bouton" type="submit" value="OK" name="submitGroupe"> </td>';
    $retour .= '</tr>';
    $retour .= '</form>';
    $retour .= '</table>';

    $retour .= displayFilieres();

    return $retour;
}

//Fonction permettant la création des filières
function repertoryCreator(){
    $filiere = $_POST['filiere'];
    $groupe = $_POST['groupe'];
    $choix = $_POST['choix'];
    $retour = "";
    $i = 0;
    $j = 0;
    $not_allowed = array("\\", "/", ":", "*", "?", "\"", ">", "<", "|", ".");
    $count = count($not_allowed);
    if (isset($_POST['submitFiliere']) && empty($_POST['submitGroupe'])) {
        if ($filiere != ""){
            for($i; $i<$count; $i++){
                $pos = strpos($filiere, $not_allowed[$i]);
                if ($pos !== false) {
                    $retour = '<p style="color: #FF0000;"> Veuillez utiliser des caractères autres que :';
                    foreach ($not_allowed as $print) {
                        $retour .= " $print";
                    }
                    return $retour;
                }
            }

            $dir = directoryReading();
            foreach ($dir as $directories[]) {
                if ($directories[$j] == $filiere) {
                    return '<p style="color: #FF0000"> Ce nom de filière existe déjà </p>';
                }
                $j++;
            }
            mkdir("../Admin/$filiere", 0700);
            echo "<script>alert(\"La filière a bien été créée !\")</script>";
            header('Refresh: 0.1;URL=classgroup_administrator.php');
        } else {
            $retour = '<p style="color: #FF0000"> Veuillez renseigner un nom de filière !';
        }
    }


    if (isset($_POST['submitGroupe']) && empty($_POST['submitFiliere']) && isset($_POST['choix'])) {
        if ($groupe != ""){
            if($choix != ""){
                for($i; $i<$count; $i++){
                    $pos = strpos($filiere, $not_allowed[$i]);
                    if ($pos !== false) {
                        $retour = '<p style="color: #FF0000;"> Veuillez utiliser des caractères autres que :';
                        foreach ($not_allowed as $print) {
                            $retour .= " $print";
                        }
                        return $retour;
                    }
                }
                $dir = directoryReading("Admin/$choix");
                foreach ($dir as $directories[]) {
                    if ($directories[$j] == $groupe) {
                        return '<p style="color: #FF0000"> Ce nom de groupe existe déjà </p>';
                    }
                    $j++;
                }
                mkdir("../Admin/$choix/$groupe", 0700);
                echo "<script>alert(\"Le groupe a bien été créé !\")</script>";
                header('Refresh: 0.1;URL=classgroup_administrator.php');
            } else {
                $retour = '<p style="color: #FF0000"> Veuillez renseigner une filière ! </p>';
            }
        } else {
            $retour = '<p style="color: #FF0000"> Veuillez renseigner un nom de groupe ! </p>';
        }
    }
    return $retour;
}

// Fonction permettant la lecture des dossiers
function directoryReading($directory = "Admin"){
    $nb_fichier = 0;
    $dir[] = "";
    if ($dossier = opendir("../$directory")) {
        while (false !== ($fichier = readdir($dossier))) {
            if($fichier != '.' && $fichier != '..'){
                $dir[$nb_fichier] = $fichier;
                $nb_fichier ++;
            }
        }
    } else {
        return '<p style="color: #FF0000;"> Le dossier n\'existe pas !</p>';
    }
    return $dir;
}

?>
