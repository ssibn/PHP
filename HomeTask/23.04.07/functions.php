<?php
    if ($_POST["service"] != null){
        echo "Услуга ", $_POST["service"];
    }
    if ($_POST["numberService"] != null){
        echo "<br>Номер услуги: ", $_POST["numberService"];
    }
    if ($_POST["personalAccount"] != null){
        echo "<br>Лицевой счет: ", $_POST["personalAccount"];
    }
    if ($_POST["message"] != null){
        echo "<br>Сообщение: ", $_POST["message"];
    }
    if ($_POST["family"] != null){
        echo "<br>Фамилия: ", $_POST["family"];
    }
    if ($_POST["name"] != null){
        echo "<br>Имя: ", $_POST["name"];
    }
    if ($_POST["surname"] != null){
        echo "<br>Отчество: ", $_POST["surname"];
    }
    if ($_POST["phone"] != null){
        echo "<br>Контактный телефон: ", $_POST["phone"];
    }
    if ($_POST["email"] != null){
        echo "<br>Электронная почта: ", $_POST["email"];
    }
    if ($_POST["sDRegion"] != null){
        echo "<br>Регион оказания услуги: ", $_POST["sDRegion"];
    }
    if ($_POST["locality"] != null){
        echo "<br>Населенный пункт: ", $_POST["locality"];
    }
    if ($_POST["street"] != null){
        echo "<br>Улица: ", $_POST["street"];
    }
    if ($_POST["house"] != null){
        echo "<br>№ дома: ", $_POST["house"];
    }
    if ($_POST["apartament"] != null){
        echo "<br>Квартира: ", $_POST["apartament"];
    }
    echo "<br><a href='./index.php'>Назад</a>";
?>