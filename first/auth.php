<?php
if($_POST["vxod"]){

  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");

  $login = trim($_POST['login']);
  $password = trim($_POST['password']);
  $password = md5($password."");
  $error_login = "";
  $error_password = "";
  $error = false;
  $message = "";

  if(mb_strlen($login) < 8 || mb_strlen($login) > 49 || !preg_match("/@/", $login)){
    $error_login = "<br></br>Длина имени должна быть от 8 до 49 символов либо почта введена не корректно";
    $error = true;
  }
  if(mb_strlen($password) < 8 || mb_strlen($password) > 32){
    $error_password = "<br></br>Длина пароля должна быть от 8 до 30 символов";
    $error = true;
  }

  $result = $mysqli->query("SELECT * FROM `users` WHERE `Login` = '$login' AND `Password` = '$password'");
  $user = $result->fetch_assoc();
  if (!$error && count($user) != 0) {
    setcookie('Id', $user['Id'], time() + 60 * 60, "/");
    setcookie('Login', $user['Login'], time() + 60 * 60, "/");
    setcookie('Password', $user['Password'], time() + 60 * 60, "/");
    setcookie('Name', $user['Name'], time() + 60 * 60, "/");
    setcookie('Prava', $user['Prava'], time() + 60 * 60, "/");
    $pochta = $_COOKIE['Login'];
    if ($pochta != "") {
      $result = $mysqli->query("SELECT * FROM `bron` WHERE `Pochta_rod` LIKE '$pochta'");
      $proverka = $result->fetch_assoc();
      if (count($proverka) != 0) {
        setcookie('proverka', $proverka['Id'], time() + 60 * 60, "/");
      }
    }
    header("Location: index.php");
  }
  elseif ($error || count($user) == 0) {
    $message = "Данные введены неверно. <br></br>";
  }
    $mysqli->close();
}
 ?>
