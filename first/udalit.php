<?php
if ($_POST["delete"]) {
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $number = $_POST["number"];
  $error_udal = "";
  $error = false;
  $result = $mysqli->query("SELECT * FROM `users` WHERE `Id` = '$number'");
  $user = $result->fetch_assoc();
  $a = $user['Login'];
  $result1 = $mysqli->query("SELECT * FROM `bron` WHERE `Pochta_rod` = '$a'");
  $user1 = $result1->fetch_assoc();
  if (strlen($number) == 0 || count($user) == 0 || count($user1) != 0) {
    $error_tema = "Пользователь не найден";
    $error = true;
  }
  if (!$error && count($user) != 0 && count($user1) == 0){
    $mysqli->query("DELETE FROM `users` WHERE `users`.`Id` = $number");
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
        require "admin_menu.php"
        ?>
      </center>

      <div style="background: rgba(0, 0, 0, 0.5);
      margin-top: 20px;
      margin-left: 550px;
      margin-right: 550px;
      margin-bottom: 50px;
      border-radius: 15px;
      padding: 20px;">

      <form class="" action="" method="post">
        <center>
        <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Введите ID пользователя, которого хотите удалить:</p>
        <input type="text" name="number" style="margin-top: 10px;"/>
        <span style="color:red"><?=$error_udal?></span><br />
        <input type="submit" name="delete" value="Удалить" style="
          font-size: 1.2em;
          background-color: #9ACD32;
          border-radius: 5px;
          border-radius: 2x solid silver;
          padding: 5px;
          width: 100px;
          margin-top: 10px;">
        <center/>

      </form>

      </div>

      <?php
      function printuser ($user){
              while (($row = $user->fetch_assoc())!= false){
                    echo "<div id=\"lagerbox\" style=\"background: rgba(0, 0, 0, 0.5);
                    margin-top: 50px;
                    margin-left: 300px;
                    margin-right: 300px;
                    margin-bottom: 50px;
                    border-radius: 15px;
                    padding: 20px;\">";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">ID пользователя: ".$row["Id"]."</p>";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Логин: ".$row["Login"]."</p>";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Имя: ".$row["Name"]."</p>";
                     echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Права: ".$row["Prava"]."</p>";
                     echo "</div>";
              }
          }

          $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
          $mysqli->query( "SET NAMES 'utf8'");
          $user = $mysqli->query("SELECT *  FROM `users`");
          printuser($user);
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
