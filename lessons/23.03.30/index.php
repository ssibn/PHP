<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body style="padding-left: 5%; padding-right: 5%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
  <form action="./backpage.php" method="post" name="form" style="width: 50%; display: flex; flex-direction: column; justify-content: center; align-content: center;">
    <!-- Поле ввода имени -->
    <input name="name" type="text" placeholder="Ваше имя" />
    <br>
    <!-- Поле ввода почты  -->
    <input name="email" type="email" placeholder="Ваша почта" />
    <br>
    <!-- Поле ввода для темы сообщения -->
    <input size="30" name="header" type="text" placeholder="Тема" />
    <br>
    <!-- Текстовое поле для самого сообщения -->
    <textarea cols="32" name="message" rows="5" placeholder="Введите сообщение"></textarea>
    <br>
    <!-- Кнопка с надписью «Отправить», которая запускает обработчик формы -->
    <input type="submit" value="Отправить" />
    <div>
      <input type="checkbox" name="checkbox"/>
      <div>
        Would you like its?
      </div>
    </div>
  </form>
  <br />
  <div style="width: 50%; align-content: start;  border-bottom: 2px solid black">
    <?php
    echo 'Здраствуйте ' . htmlspecialchars($_POST["name"]) . '!' . '<br />';
    echo 'Ваш E-mail: ' . htmlspecialchars($_POST["email"]) . '<br />';
    echo 'Ваша тема: ' . htmlspecialchars($_POST["header"]) . '<br />';
    echo 'Ваше сообщение: ' . '<br />' . htmlspecialchars($_POST["message"]) . '<br />';
    ?>
  </div>
  <div style="width: 50%; align-content: start;">
  <?php
  
    require_once('functions.php');
    isRequared($_POST["name"], 'Name');
    isRequared($_POST["email"], 'Email');
    isRequared($_POST["header"], 'Header');
    isRequared($_POST["message"], 'Message');
    isRequared($_POST["message"], 'Message');

    ?>
  </div>
</body>

</html>

