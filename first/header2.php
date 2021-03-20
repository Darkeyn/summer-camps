<span class="right">
  <?php
    if ($_COOKIE['Name'] != "" && $_COOKIE['Prava'] == "Admin") {
      echo "<span class=\"contact\"><a href=\"admin.php\">Админ</a></span>";
    }
    if ($_COOKIE['Name'] != ''){
      echo "<span class=\"contact\"><a href=\"kab.php\">Личный кабинет</a></span>";
    }
   ?>
  <span class="contact"><a href="reg.php" title="Зарегестрироваться">Регистрация</a></span>
  <span class="contact"><a href="login.php" title="Войти">Вход</a></span>
</span>

  <a href="index.php" title="На главную" id="logo">Summer camps</a>
