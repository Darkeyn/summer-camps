<?php
  require "proverka.php"
?>
<?php
if ($_POST["otmena"]) {
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $pochta = $_COOKIE['Login'];
  $mysqli->query("UPDATE smena SET Places = Places + '1' WHERE `Id` = (SELECT `Smena` FROM `bron` WHERE `Pochta_rod` = '$pochta')");
  $mysqli->query("DELETE FROM `bron` WHERE `Pochta_rod` LIKE '$pochta'");
  $mysqli->query("DELETE FROM `reb` WHERE `Pochta_rod` LIKE '$pochta'");
  $mysqli->query("DELETE FROM `rod` WHERE `Pochta_rod` LIKE '$pochta'");
  setcookie('proverka', $proverka['Id'], time() - 60 * 60, "/");
  header("Location: lager.php");
  $mysqli->close();
}
 ?>
<!DOCTYPE html>
<html>
    <head>
      <?
      require "head.php"
      ?>
    </head>
    <body>

      <div id="page-wrap">

      <header>
        <?
        require "header2.php"
        ?>
      </header>

      <div class="clear"><br /></div>

      <center>
        <?
        require "menu.php"
        ?>
      </center>

       <div style="
         background: rgba(0, 0, 0, 0.6);
         margin-top: 20px;
         margin-left: 300px;
         margin-right: 300px;
         padding: 30px;
         border-radius: 10px;">
         <p align="center">
           Информация о вашем бронировании:
         </p>

         <?php if ($_COOKIE['proverka'] != ''){
           $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
           $mysqli->query( "SET NAMES 'utf8'");
           $pochta = $_COOKIE['Login'];
               $broninfo = $mysqli->query("SELECT * FROM `bron` WHERE `Pochta_rod` LIKE '$pochta'");
               $smenainfo = $mysqli->query("SELECT * FROM `smena` WHERE `Id` LIKE (SELECT `Smena` FROM `bron` WHERE `Pochta_rod` = '$pochta')");
               $row = $broninfo->fetch_assoc();
               $row2 = $smenainfo->fetch_assoc();
               if (count($row) != 0) {
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Уникальный номер бронирования: ".$row["Id"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Название лагеря: ".$row["Name_lager"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Почта родителя: ".$row["Pochta_rod"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">ФИО ребенка: ".$row["Name_reb"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Дата рождения ребенка: ".$row["Date"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Стоимость бронирования: ".$row["Sum"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Дата заезда: ".$row2["Date_nach"]."</p>";
                 echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Дата отъезда: ".$row2["Date_okonch"]."</p>";
                 echo "<center>
                 <form action=\"\" method=\"post\">
                 <input type=\"submit\" name=\"otmena\" id=\"otmena\" class=\"otmena\" value=\"Отменить бронирование\" style=\"
                   font-size: 1.2em;
                   background-color: #9ACD32;
                   border-radius: 5px;
                   border-radius: 2x solid silver;
                   padding: 5px;
                   width: 300px;\">
                   </form>
                 </center>";
               }
               $mysqli->close();
         }
         else {
           echo "<center><p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\"> У вас нет бронирований.</p></center>";
         }
         ?>



       </div>

    </div>

      <footer>
        <?
        require "footer.php"
        ?>
      </footer>
    </body>
</html>
