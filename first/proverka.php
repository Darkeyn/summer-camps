<?php
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $pochta = $_COOKIE['Login'];
  if ($pochta != "") {
    $result = $mysqli->query("SELECT * FROM `bron` WHERE `Pochta_rod` LIKE '$pochta'");
    $proverka = $result->fetch_assoc();
    if (count($proverka) != 0) {
      setcookie('proverka', $proverka['Id'], time() + 60 * 60, "/");
    }
  }
  $mysqli->close();
?>
