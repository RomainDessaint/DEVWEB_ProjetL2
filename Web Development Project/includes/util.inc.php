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
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $password = $_POST['password'];
    if($name =='' || $password==''){
      $error[] = 'Name or password required';
    }
    if(!isset($error)){
      $crypted = password_hash($password, PASSWORD_BCRYPT);
      $Content = "Name, Password\n";
      $Content .= "$name, $crypted\n";
      $file = fopen("../ressources/private.csv","w");

      $temp.= $Content;
      fputcsv($file, array($temp));
      fclose($file);
    }
  }

  if(isset($error)){
    foreach($error as $error){
      $temp.= "<p style='color:#ff0000'>$error</p>";
    }
  }
  return $temp;
}
?>
