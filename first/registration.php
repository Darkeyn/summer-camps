<?php
if($_POST["reg"]){
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $name = trim($_POST['name']);
  $login = trim($_POST['login']);
  $password = trim($_POST['password']);
  $error_name = "";
  $error_login = "";
  $error_password = "";
  $error = false;
  $message = "";
  if(mb_strlen($name) < 2 || mb_strlen($name) > 49){
    $error_name = "<br></br>Длина имени должна быть от 2 до 49 символов.";
    $error = true;
  }
  if(mb_strlen($login) < 8 || mb_strlen($login) > 49 || !preg_match("/@/", $login)){
    $error_login = "<br></br>Длина имени должна быть от 8 до 49 символов либо почта введена не корректно";
    $error = true;
  }
  if(mb_strlen($password) < 8 || mb_strlen($password) > 32){
    $error_password = "<br></br>Длина пароля должна быть от 8 до 30 символов";
    $error = true;
  }
  if ($login != "") {
    $result = $mysqli->query("SELECT * FROM `users` WHERE `Login` = '$login'");
    $user = $result->fetch_assoc();
  }
  if (!count($user) == 0) {
    $message = "Пользователь с такой почтой уже зарегистрирован. <br></br>";
    header("Location: reg.php");
  }
  if (!$error && count($user) == 0) {
  $password = md5($password."");
  $mysqli->query("INSERT INTO `users` (`Id`, `Login`, `Password`, `Name`, `Prava`) VALUES (NULL, '$login', '$password', '$name', 'User')");
    header("Location: login.php");
  }
  $mysqli->close();
}
?>
