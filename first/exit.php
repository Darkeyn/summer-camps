<?php
if($_POST["vixod"]){
  setcookie('Id', $user['Id'], time() - 60 * 60, "/");
  setcookie('Login', $user['Login'], time() - 60 * 60, "/");
  setcookie('Password', $user['Password'], time() - 60 * 60, "/");
  setcookie('Name', $user['Name'], time() - 60 * 60, "/");
  setcookie('Prava', $user['Prava'], time() - 60 * 60, "/");
  setcookie('proverka', $user['Id'], time() - 60 * 60, "/");
  header("Location: login.php");
}
?>
