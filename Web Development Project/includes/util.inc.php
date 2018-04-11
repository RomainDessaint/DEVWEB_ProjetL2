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

function login (){
    $lignes = file("../ressources/login_etudiant.csv");
    $i=0;
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $comp = $name.','.$password;

        foreach ($lignes as $ligne[]) {
            $temp = explode(',',$ligne[$i]);

             if($temp[0] == $name && $temp[1] == $password) {
                 return "Connexion effectuée !";
             }
             else {
                 $retour = "L'identifiant ou le mot de passe est incorrect !";
                 $i++;
             }
        }
        return $retour;
    }
}

function formCreateLogin() {
     $retour = '<form action="#" method = "post">';
     $retour .= '<table>';
     $retour .= '<tr>';
     $retour .= '<td> <label> Prénom : </label> </td>';
     $retour .= '<td> <input type="text" name="name1" value=""> </td>';
     $retour .= '</tr> <tr>';
     $retour .= '<td> <label> Nom : </label> </td>';
     $retour .= '<td> <input type="text" name="name2" value=""> </td>';
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
          $firstname= $_POST['name1'];
          $name = $_POST['name2'];
          $gender = $_POST['gender'];
          $id = $_POST['id'];
          $password1 = $_POST['password1'];
          $password2 = $_POST['password2'];

          if($firstname=='' || $name=='' || $gender=='' || $id=='' || $password1=='' || $password2=='' ) {
               $error = 'Champs requis';
          }
          if($password1 != $password2) {
               $error = 'Les mots de passe ne correspondent pas.';
          }

          if(!isset($error)) {
               $crypted = $password1;
               // $crypted = password_hash($password, PASSWORD_BCRYPT);
               $content = "Prénom, Nom, Sexe, Id, Mdp\n";
               $content .= "$name, $crypted, $gender, $id, $crypted\n";
               $file = fopen("../ressources/login_gestionnaire.csv","w");
               fputcsv($file, array($content));
               fclose($file);
               $temp .= 'Session crée';
          }
     }
     if(isset($error)) {
          $temp .= "<p style = 'color:#ff0000'> $error </p>";
     }
     return $temp;
}
