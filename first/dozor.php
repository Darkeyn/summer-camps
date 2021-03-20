<?php
if ($_POST["bron"]) {
  $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
  $phone = trim($_POST['phone']);
  $fio_reb = trim($_POST['fio_reb']);
  $date = trim($_POST['date']);
  $dd = substr ($date , 0, 2);
  $mm = substr ($date , 3, 2);
  $yy = substr ($date , 6, 4);
  $pochta_rod = $_COOKIE['Login'];
  $error = false;
  if(is_numeric($dd) && is_numeric($mm) && is_numeric($yy) && checkdate ($mm, $dd, $yy)){
    $date = $yy."-".$mm."-".$dd;
    $now_date = date("d.m.Y");
    $now = strtotime($now_date);
    $date_polz = ($now - strtotime($date)) / (60*60*24*365);
  }
  else {
    $error_date = "Дата введена неверно";
    $error = true;
  }
  if (!($date_polz >= 7 && $date_polz <= 19)) {
    $error = true;
    if ($date_polz < 7) {
      $error_date = "Ребенок слишком мал";
    }
    elseif ($date_polz > 10) {
      $error_date = "Ребенок слишком взрослый";
    }
  }
  if(mb_strlen($phone) != 11 || !is_numeric($phone)){
    $error_phone = "Номер телефона введен не корректно";
    $error = true;
  }
  if(mb_strlen($fio_reb) < 2 || mb_strlen($fio_reb) > 49 || !is_string($fio_reb)){
    $error_fio_reb = "Имя ребенка введено не корректно";
    $error = true;
  }
  if ($_COOKIE['Name'] == '') {
    $error_auth = "<br></br>Для совершения бронирования авторизуйтесь!";
    $error = true;
  }
  if( isset( $_POST['smena'] ) )
  {
    switch( $_POST['smena'] )
    {
        case 'one':
        $mesta = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 7 AND `Places` = 0");
        $user = $mesta->fetch_assoc();
            if (count($user) != 0) {
              $error_mesta = " В выбранной смене нет свободных мест!";
              $error = true;
            }
            else {
              $smenanumber = "7";
            }
            break;
        case 'two':
            $mesta = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 8 AND `Places` = 0");
            $user = $mesta->fetch_assoc();
                if (count($user) != 0) {
                  $error_mesta = " В выбранной смене нет свободных мест!";
                  $error = true;
                }
                else {
                  $smenanumber = "8";
                }
            break;
        case 'three':
        $mesta = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 9 AND `Places` = 0");
        $user = $mesta->fetch_assoc();
            if (count($user) != 0) {
              $error_mesta = " В выбранной смене нет свободных мест!";
              $error = true;
            }
            else {
              $smenanumber = "9";
            }
            break;
    }
  }
  if (!$error) {
    $Id = $_COOKIE['Id'];
    $mysqli->query("UPDATE smena SET Places = Places - '1' WHERE `Id` = '$smenanumber'");
    $mysqli->query("INSERT INTO `rod` (`Id`, `Pochta_rod`, `Phone`,`Id_user`) VALUES (NULL, '$pochta_rod', '$phone','$Id')");
    $mysqli->query("INSERT INTO `reb` (`Id`, `Pochta_rod`, `Name`, `Date`,`Id_rod`) VALUES (NULL, '$pochta_rod', '$fio_reb', '$date','$Id')");
    $mysqli->query("INSERT INTO `bron` (`Name_lager`, `Pochta_rod`, `Name_reb`, `Date`, `Sum`,`Id_rod`,`Id_lager`,`Id_reb`, `Smena`) VALUES ('Дозорный', '$pochta_rod', '$fio_reb', '$date', '25000','$Id','2','$Id','$smenanumber')");
    setcookie('proverka', $pochta_rod, time() + 60 * 60, "/");
    header("Location: kab.php");
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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
// Обрабатывает клик на картинке
$('.img_block img').click(function() {
// Получаем адрес картинки
var imgAddr = $(this).attr("src");
// Задаем свойство SRC картинке, которая в скрытом диве.
$('#img_big_block img').attr({src: imgAddr});
// Показываем скрытый контейнер
$('#img_big_block').fadeIn('slow');
});
// Обрабатывает клик по большой картинке
$('#img_big_block').click(function() {
$(this).fadeOut();
});
});
</script>

      <style type="text/css">
      /* Скрытый контейнер с большим изображением */
      #img_big_block {
      position: absolute;
      display: none;
      left: 50%;
      margin-left: -350px;
      z-index: 999;
      top: 100px;
      border: 1px solid #D4DEE8;
      }
      </style>

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

       <div class="img_block" style="
         background: rgba(0, 0, 0, 0.6);
         margin-top: 20px;
         margin-left: 300px;
         margin-right: 300px;
         padding: 30px;
         border-radius: 10px;">
         <p align="center" style="font-size: 1.7em; font-family: Comic Sans MS, sans-serif">
           "Дозорный"
         </p>

         <?php
         function printlager ($lagerinfo){
                 while (($row = $lagerinfo->fetch_assoc())!= false){
                        echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Адрес: ".$row["Adress"]."</p>";
                        echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Телефон для связи: ".$row["Phone"]."</p>";
                        echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Описание: ".$row["About"]."</p>";
                        echo "<p style=\"font-family: Comic Sans MS, sans-serif;text-indent: 0px\">Стоимость: ".$row["Stoim"]."</p>";
                 }
             }

             $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
             $mysqli->query( "SET NAMES 'utf8'");
             $lagerinfo = $mysqli->query("SELECT * FROM `lager` WHERE `Name` LIKE 'Дозорный'");
             printlager($lagerinfo);
             $mysqli->close();
         ?>
           <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Возрастное ограничение: 7-19 лет</p>
           <p style="font-family: Comic Sans MS, sans-serif;text-indent: 0px">Галерея:</p>

         <?php
  /* Функция для удаления лишних файлов: сюда, помимо удаления текущей и родительской директории, так же можно добавить файлы, не являющиеся картинкой (проверяя расширение) */
  function excess($files) {
    $result = array();
    for ($i = 0; $i < count($files); $i++) {
      if ($files[$i] != "." && $files[$i] != "..") $result[] = $files[$i];
    }
    return $result;
  }
  $dir = "img/dozor"; // Путь к директории, в которой лежат изображения
  $files = scandir($dir); // Получаем список файлов из этой директории
  $files = excess($files); // Удаляем лишние файлы
  /* Дальше происходит вывод изображений на страницу сайта (по 4 штуки на одну строку) */
?>
<?php for ($i = 0; $i < count($files); $i++) { ?>
  <img src="<?=$dir."/".$files[$i]?>" width="200" height="200" alt="" />
  <?php if (($i + 1) % 5 == 0) { ?><br /><?php } ?>
  <div id="img_big_block"><img src="" width="800px"></div>
<?php } ?>

<center>
  <br></br>
  <p style="font-size: 1.7em; font-family: Comic Sans MS, sans-serif;text-indent: 0px">Бронирование:</p>
</center>


         <?php  if ($_COOKIE['proverka'] == ''):?>
           <?
           $mysqli = new mysqli("localhost","admin_bd","2000","bd_lager");
           $mysqli->query( "SET NAMES 'utf8'");
           $one = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 7");
           $two = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 8");
           $three = $mysqli->query("SELECT * FROM `smena` WHERE `Id` = 9");
           function printplaces ($place){
                   while (($row = $place->fetch_assoc())!= false){
                          echo "".$row["Places"]."";
                   }}

           ?>
         <form class="" action="" method="post">
           <label>Выберите смену:</label><span style="color:red"><?=$error_mesta?></span><br />
           <input type="radio" name="smena" value="one" /> 03.06.2021 - 27.06.2021 Свободных мест: <?printplaces($one);?><br />
           <input type="radio" name="smena" value="two" /> 03.07.2021 - 27.07.2021 Свободных мест: <?printplaces($two);?><br />
           <input type="radio" name="smena" value="three" /> 03.08.2021 - 27.08.2021 Свободных мест: <?printplaces($three);?><br />
           <label>Телефон родителя:</label><br /><input type="text" name="phone"/><span style="color:red"><?=$error_phone?></span><br />
           <label>Фио ребенка:</label><br /><input type="text" name="fio_reb"/><span style="color:red"><?=$error_fio_reb?></span><br />
           <label>Дата рождения ребенка:</label><br /><input type="text" name="date" placeholder="ДД.ММ.ГГГГ"/><span style="color:red"><?=$error_date?></span><br />
           <center>
           <input type="submit" name="bron" id="bron" class="bron" value="Забронировать" style="
             font-size: 1.2em;
             background-color: #9ACD32;
             border-radius: 5px;
             border-radius: 2x solid silver;
             padding: 5px;
             width: 200px;"><span style="color:red"><?=$error_auth?></span><br />
           </center>
         </form>
         <?php endif; ?>

       </div>

    </div>

      <footer>
        <?
        require "footer.php"
        ?>
      </footer>
    </body>
</html>
