<?php
if ($_POST["udal"]) {
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $number = $_POST["number"];
  $error_udal = "";
  $error = false;
  $result = $mysqli->query("SELECT * FROM `otzyv` WHERE `Id` = '$number'");
  $user = $result->fetch_assoc();
  if (strlen($number) == 0 || count($user) == 0) {
    $error_tema = "Отзыв не найден";
    $error = true;
  }
  if (!$error && count($user) != 0){
    $mysqli->query("DELETE FROM `otzyv` WHERE `otzyv`.`Id` = $number");
  }
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
        <div id="menuHrefs" style="margin-top: 10px;">
          <a href="feedback.php">Все отзывы</a>
          <?php
            if ($_COOKIE['Name'] != ""){
              echo "<a href=\"otzyv.php\">Оставить отзыв</a>";
            }
            if ($_COOKIE['Name'] != "" && $_COOKIE['Prava'] == "Admin") {
              echo "<a href=\"admin_otzyv.php\">Удалить отзывы</a>";
            }
          ?>
        </div>
      </center>

      <div style="background: rgba(0, 0, 0, 0.5);
      margin-top: 50px;
      margin-left: 550px;
      margin-right: 550px;
      margin-bottom: 50px;
      border-radius: 15px;
      padding: 20px;">

      <form class="" action="" method="post">
        <center>
        <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Введите номер отзыва, который хотите удалить:</p>
        <input type="text" name="number" style="margin-top: 10px;"/>
        <span style="color:red"><?=$error_udal?></span><br />
        <input type="submit" name="udal" value="Удалить" style="
          font-size: 1.2em;
          background-color: #9ACD32;
          border-radius: 5px;
          border-radius: 2x solid silver;
          padding: 5px;
          width: 150px;
          margin-top: 10px;">
        <center/>

      </form>

      </div>

      <?php
      function printlager ($otzyvinfo){
              while (($row = $otzyvinfo->fetch_assoc())!= false){
                    echo "<div id=\"lagerbox\" style=\"background: rgba(0, 0, 0, 0.5);
                    margin-top: 50px;
                    margin-left: 300px;
                    margin-right: 300px;
                    margin-bottom: 50px;
                    border-radius: 15px;
                    padding: 20px;\">";
                    if ($_COOKIE['Name'] != "" && $_COOKIE['Prava'] == "Admin") {
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Номер отзыва: ".$row["Id"]."</p>";
                   }
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Автор: ".$row["Pochta_rod"]."</p>";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Тема: ".$row["Tema"]."</p>";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Отзыв: ".$row["Message"]."</p>";
                     echo "</div>";
              }
          }

          $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
          $mysqli->query( "SET NAMES 'utf8'");
          $otzyvinfo = $mysqli->query("SELECT *  FROM `otzyv`");
          printlager($otzyvinfo);
          $mysqli->close();
      ?>

      <?php
      if($_POST["search"]){
        require "poisk.php";
      }
       ?>

    </div>

      <footer>
        <?
        require "footer.php"
        ?>
      </footer>
    </body>
</html>
