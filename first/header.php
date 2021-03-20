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

<form name="poisk" action="" method="post">

  <a href="index.php" title="На главную" id="logo">Summer camps</a>

  <input type="text" class="field" name="field" id="field" placeholder="Введите запрос" />

  <input type="submit" name="search" id="search" class="search" value="Поиск" style="font-size: 1.1em;
  background-color: #9ACD32;
  border-radius: 5px;
  border-radius: 2x solid silver;
  padding: 5px;
  margin-left: 20px;
  width: 100px;">

</form>
