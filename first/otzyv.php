<?php
if ($_POST["send"]) {
  $tema = $_POST["tema"];
  $otzyv = $_POST["message"];
  $error_tema = "";
  $error_otzyv = "";
  $error = false;
  if (strlen($tema) == 0) {
    $error_tema = "Введите тему отзыва";
    $error = true;
  }
  if (strlen($otzyv) == 0 || strlen($otzyv) > 250) {
    $error_otzyv = "Введите отзыв, он не может быть длинее 250 символов.";
    $error = true;
  }
  if (!$error){
    $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
    $pochta = $_COOKIE['Login'];
    $Id = $_COOKIE['Id'];
    $mysqli->query("INSERT INTO `otzyv` (`Id`, `Pochta_rod`, `Tema`, `Message`, `Id_user`) VALUES (NULL, '$pochta', '$tema', '$otzyv', '$Id')");
    header("Location: feedback.php");
    $mysqli->close();
  }
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

        <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Тема:</p>
        <input type="text" name="tema" style="margin-top: 10px;"/>
        <span style="color:red"><?=$error_tema?></span>
        <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Отзыв:</p>
        <textarea name="message" cols="100" rows="5"></textarea><br />
        <span style="color:red"><?=$error_otzyv?></span>
        <center>
        <input type="submit" name="send" value="Отправить" style="
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
