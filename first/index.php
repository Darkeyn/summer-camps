<?php
  require "proverka.php"
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
        require "header.php"
        ?>
      </header>

      <div class="clear"><br /></div>

      <center>
        <?
        require "menu.php"
        ?>
      </center>

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
