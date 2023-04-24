<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../smile.png">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <title>Document</title>
</head>
<body>
    <section  class="tables-example">
        <?php
        require_once ('../config/connect.php'); //импортируем код из файла
        $forms = mysqli_query($connect, "SELECT * FROM `forms`"); //создаём переменную и указываем переменную из файла и sql запрос на всю таблицу
        $forms = mysqli_fetch_all($forms); //парсим полученный объект из sql запроса
        foreach ($forms as $formValue){  //перебираем продукты циклом
            ?>
        <table>
            <colgroup>
                <col span="1" class="question">
                <col span="1" class="answer">
            </colgroup>
    
            <thead>
                <tr>
                    <th colspan="2">Данные пользователя ID: <?= $formValue[0]?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>name:</td>
                    <td><?= $formValue[1]?></td>
                </tr>
                <tr>
                    <td>email:</td>
                    <td><?= $formValue[2]?></td>
                </tr>
    
                <tr>
                    <td>password:</td>
                    <td><?= $formValue[3]?></td>
                </tr>
    
                <tr>
                    <td>userMessage:</td>
                    <td><?= $formValue[4]?></td>
                </tr>

                <tr>
                    <td>gender:</td>
                    <td><?= $formValue[5]?></td>
                </tr>

                <tr>
                    <td>agree:</td>
                    <td><?= $formValue[6];
                    if ($formValue[6] == null){ echo "<p style='color: red'>Он отказался</p>";}?></td>
                </tr>
                <tr>
                    <td>Update:</td>
                    <td>
                        <a href='../vendor/update_form.php?id=<?= $product[0] ?>'>Update</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Delete inquiry:</td>
                    <td><a style="color: red" href='../vendor/delete.php?id=<?= $formValue[0] ?>'>Delete</a></td>
                </tr>
            </tfoot>
        </table>
        <?php
            }
        ?>
        <div class="link">
            <a href='../index.php'>BACK</a>
        </div>
    </section>

</body>
</html>