<?
require "auth.php"
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
            <a href="index.php" title="На главную" id="logo">Summer camps</a>
          </header>

          <div class="clear"><br /></div>

            <div id="log">

            <div id="welcome" align="center">Добро пожаловать!</div>

            <center>
              <?php
                if ($_COOKIE['Name'] == ''):
               ?>
              <form action="" method="post">
                <input type="text" name="login" id="login" class="login" value placeholder="Адрес электронной почты">
                <span style="color:red"><?=$error_login?></span>
                <br></br>
                <input type="text" name="password" id="password" class="password" value placeholder="Пароль">
                <span style="color:red"><?=$error_password?></span>
                <br></br><span style="color:red"><?=$message?></span>
                <input type="submit" name="vxod" id="vxod" class="vxod" value="Войти" style="
                  font-size: 1.2em;
                  background-color: #9ACD32;
                  border-radius: 5px;
                  border-radius: 2x solid silver;
                  padding: 5px;
                  width: 100px;">
                <?php else: ?>
                  <form action="exit.php" method="post">
                  <input type="submit" name="vixod" id="vixod" class="vixod" value="Выход" style="
                    font-size: 1.2em;
                    background-color: #9ACD32;
                    border-radius: 5px;
                    border-radius: 2x solid silver;
                    padding: 5px;
                    width: 100px;">
                  </form>
                <?php endif; ?>
              </form>
            </center>

          </div>

      </div>

        <footer>
          <?
          require "footer.php"
          ?>
        </footer>
    </body>
</html>
