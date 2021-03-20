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
