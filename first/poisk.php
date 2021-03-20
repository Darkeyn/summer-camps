<?php

$mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
$mysqli->query( "SET NAMES 'utf8'");
$object = mb_strtolower(trim($_POST["field"]));
$dd = substr ($object , 0, 2);
$mm = substr ($object , 3, 2);
$yy = substr ($object , 6, 4);
$lagerinfo = $mysqli->query("SELECT * FROM `lager` WHERE LOWER(`Name`) LIKE '%$object%' OR LOWER(`About`) LIKE '%$object%' OR LOWER(`Adress`) LIKE '%$object%'");

// Уведомление о пустом запросе
if ($object == "") {
  echo "<div id=\"zapros_net\" align=\"center\" style=\"background: rgba(0, 0, 0, 0.5);
  margin-top: 20px;
  margin-left: 700px;
  margin-right: 700px;
  border-radius: 15px;
  padding: 10px;\">Запрос не введен</div>";
}

// Поиск по дате
elseif (is_numeric($dd) && is_numeric($mm) && is_numeric($yy) && checkdate ($mm, $dd, $yy)) {
  $date = $yy."-".$mm."-".$dd;
  $id_smen = $mysqli->query("SELECT * FROM `smena` WHERE '$date' BETWEEN `Date_nach` AND `Date_okonch`");
  while (($row = $id_smen->fetch_assoc())!= false) {
    $Id = $row["Id"];
  }
  $lagerinfo = $mysqli->query("SELECT * FROM `lager` WHERE `Id_smena` = '$Id'"  );
  while (($row1 = $lagerinfo->fetch_assoc())!= false){
      echo "<div id=\"lagerbox\" style=\"background: rgba(0, 0, 0, 0.5);
      margin-top: 50px;
      margin-left: 300px;
      margin-right: 300px;
      margin-bottom: 50px;
      border-radius: 15px;
      padding: 20px;\">";
       echo "<p align=\"center\";\"> <a href=\"".$row1["Url"]."\" style=\"font-size: 1.7em; font-family: Comic Sans MS, sans-serif\"> Детский лагерь \"".$row1["Name"]."\"</a></p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Адрес: ".$row1["Adress"]."</p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Телефон для связи: ".$row1["Phone"]."</p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Описание: ".$row1["About"]."</p>";
       echo "</div>";
      }
}

// Поиск по строке
else {
  while (($row = $lagerinfo->fetch_assoc())!= false){
      echo "<div id=\"lagerbox\" style=\"background: rgba(0, 0, 0, 0.5);
      margin-top: 50px;
      margin-left: 300px;
      margin-right: 300px;
      margin-bottom: 50px;
      border-radius: 15px;
      padding: 20px;\">";
       echo "<p align=\"center\";\"> <a href=\"".$row["Url"]."\" style=\"font-size: 1.7em; font-family: Comic Sans MS, sans-serif\"> Детский лагерь \"".$row["Name"]."\"</a></p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Адрес: ".$row["Adress"]."</p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Телефон для связи: ".$row["Phone"]."</p>";
       echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Описание: ".$row["About"]."</p>";
       echo "</div>";
      }
}

$mysqli->close();

?>
