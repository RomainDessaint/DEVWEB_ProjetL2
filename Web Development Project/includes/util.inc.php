<?php
function formLogin() {
  $retour = '<form action="#" method = "post">';
  $retour .= '<table>';
  $retour .= '<tr>';
  $retour .= '<td> <label>Nom : </label> </td>';
  $retour .= '<td> <input type="text" name="name" value=""> </td>';
  $retour .= '</tr> <tr>';
  $retour .= '<td> <label>Mot de passe : </label> </td>';
  $retour .= '<td> <input type="password" name="password" value=""> </td>';
  $retour .= '</tr>';
  $retour .= '</table>';
  $retour .= '<input id="bouton" type="submit" value="Valider" name="submit">';
  $retour .= '</form>';

  return $retour;
}

function csvFile(){
  $temp ="";
   // si on appui sur le bouton submit, on récupere le nom et le mot de passe
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $password = $_POST['password'];
    //si le mot de passe ou le nom sont vides, on renvoi un message d'erreur
    if($name =='' || $password==''){
      $error[] = 'Name or password required';
    }
    // si il y a pas d'erreur
    if(!isset($error)){
      //Dans un  premier temps,on crypte le mot de passe en utilisant la fonction password_hash
      $crypted = password_hash($password, PASSWORD_BCRYPT);

      //on crée une variable content qui va contenir le nom et le mot de passe
      $content = "$name, $crypted\n";
      //on ouvre le fichier private.csv en mode écriture
      $file = fopen("private.csv","w");


      $temp .= $content;
      //on ajoute le nom et le mot de passe dans le fichier csv sous la forme  name, Password
      // test, 514D5FEA548&/*S15
      fputcsv($file, array($temp));
      fclose($file);
      // On ferme le fichier
    }
  }

  if(isset($error)){ //cette partie ne sert presque à rien, son seul but c'est d'afficher les erreurs en rouge sur l'ecran
    foreach($error as $error){
      $temp.= "<p style='color:#ff0000'>$error</p>";
    }
  }
  return $temp; // VU que le prof avait demandé de pouvoir voir les mots de passes et noms tapé dans le champs de texte, on retourne temps
  //mais pour le projet il faut pas le faire 😉
}
