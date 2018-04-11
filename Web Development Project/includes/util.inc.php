<?php
function formLogin() {
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

function login() {
    $lignes = file("../ressources/login_etudiant.csv");
    $i=0;
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        foreach ($lignes as $ligne[]) {
            $content = explode(',',$ligne[$i]);

            if($content[0] == $name && $content[1] == $password) {
                $temp = "Connexion effectuée !";
                return $temp;
            }
            else {
                $temp = "L'identifiant ou le mot de passe est incorrect !";
                $i++;
            }
        }
        return $temp;
    }
}

function formCreateLogin() {
    $retour = '<form action="#" method = "post">';
    $retour .= '<table>';
    $retour .= '<tr>';
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
        $firstname= $_POST['firstname'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $id = $_POST['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if($firstname=='' || $name=='' || $gender=='' || $id=='' || $password1=='' || $password2=='' ) {
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
            $file = fopen("../ressources/login_gestionnaire.csv","a");
            fputcsv($file, $content);
            fclose($file);
            $temp .= 'Session crée';
        }
    }
    if(isset($error)) {
        $temp .= "<p style = 'color:#ff0000'> $error </p>";
    }
    return $temp;
}
