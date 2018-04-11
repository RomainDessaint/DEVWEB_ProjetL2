<?php

////////////////////////////            ETUDIANTS          ////////////////////////////

//Affichage d'un formulaire de connexion pour un étudiant
function formLoginStudent() {
    $retour = '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
    $retour .= '<td> <label> Nom : </label> </td>';
    $retour .= '<td> <input type="text" name="name" value=""> </td>';
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
    $temp = "";
    $lignes = file("../ressources/login_student.csv");
    $i=0;
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        foreach ($lignes as $ligne[]) {
            $content = explode(',',$ligne[$i]);

            if($content[0] == $name && $content[1] == $password) {
                $temp .= "<p style = 'color: #00FF00'> Connexion effectuée </p>";
                return $temp;
            }
            else {
                $error = "Le nom ou le mot de passe est incorrect";
                $i++;
            }
        }
        if(isset($error)) {
            $temp .= "<p style = 'color:#FF0000'> $error </p>";
        }
        return $temp;
    }
}

////////////////////////////            PROFESSEURS/SECRETAIRES         ////////////////////////////

//Affichage d'un formulaire de connexion pour un professeur/secrétaire
function formLoginTeacher() {
    $retour = '<form action="#" method = "post">';
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
    $temp = "";
    $lignes = file("../ressources/login_teacher.csv");
    $i=0;
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];

        foreach ($lignes as $ligne[]) {
            $content = explode(',', $ligne[$i]);

            if($content[3] == $id && $content[4] == $password) {
                $temp .= "<p style = 'color: #00FF00'> Connexion effectuée </p>";
                return $temp;
            }
            else {
                $error = "L'identifiant ou le mot de passe est incorrect";
                $i++;
            }
        }
        if(isset($error)) {
            $temp .= "<p style = 'color:#FF0000'> $error </p>";
        }
        return $temp;
    }
}

////////////////////////////            ADMINISTRATEUR          ////////////////////////////

//Affichage d'un formulaire de connexion pour un administrateur
function formLoginAdministrator() {
    $retour = '<form action="#" method = "post">';
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
    $temp = "";
    $lignes = file("../ressources/login_administrator.csv");
    $i=0;
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];

        foreach ($lignes as $ligne[]) {
            $content = explode(',', $ligne[$i]);

            if($content[3] == $id && $content[4] == $password) {
                $temp .= "<p style = 'color: #00FF00'> Connexion effectuée </p>";
                return $temp;
            }
            else {
                $error = "L'identifiant ou le mot de passe est incorrect";
                $i++;
            }
        }
        if(isset($error)) {
            $temp .= "<p style = 'color:#FF0000'> $error </p>";
        }
        return $temp;
    }
}

//Affichage d'un formulaire de création de session
function formCreateLogin() {
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
            $crypted = $password1;
            // $crypted = password_hash($password, PASSWORD_BCRYPT);
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
            $temp .= "<p style = 'color:#00FF00'> Session créée </p>";
        }
    }
    if(isset($error)) {
        $temp .= "<p style = 'color:#FF0000'> $error </p>";
    }
    return $temp;
}
