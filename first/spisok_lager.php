<?php
function printlager ($lagerinfo){
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

    $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
    $mysqli->query( "SET NAMES 'utf8'");
    $lagerinfo = $mysqli->query("SELECT *  FROM `lager`");
    printlager($lagerinfo);
    $mysqli->close();
?>
