<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./smile.png">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <title>Form</title>
</head>
<body>
    <div class="openForm">Открыть форму</div>
    <div class="form-wrap box-shadow none">
        <span class="close">×</span>
        <h2>Форма для отправки данных</h2>
        <form action="./vendor/create.php" method="POST">
            <div class="form-input">
                <label for="userName">name:</label>
                <input type="text" id="userName" name="userName" placeholder="Ваше имя" required="">
            </div>
            
            <div class="form-input">
                <label for="email">email:</label>
                <input type="email" id="email" name="userEmail" placeholder="Ваш e-mail">
            </div>

            <div class="form-input">
                <label for="password">password:</label>
                <input type="password" id="password" name="userPassword" />
            </div>

            <!-- <div class="form-input">
                <label for="date">birthday:</label>
                <input type="date" id="date" name="date" />
            </div> -->

            <div class="form-input">
                <label for="message">message:</label>
                <textarea id="message" name="userMessage" rows="0"></textarea>
            </div>

            <fieldset>
                <legend>gender</legend>
                <div class="form-flex-wrap">
                    <input type="radio" value="women" id="genderw" name="gender" checked>
                    <label for="genderw">women</label>
                </div>

                <div class="form-flex-wrap">
                    <input type="radio" value="men" id="genderm" name="gender">
                    <label for="genderm">men</label>
                </div>
            </fieldset>

            <div class="form-checkbox">
                <div class="form-flex-wrap">
                    <input type="checkbox" id="agree" name="agree" checked>
                    <label for="agree">i agree</label>
                </div>
            </div>

            <div class="flex form-btn">
                <div class="form-input">                                        
                    <input type="reset" value="очистить">
                </div>
                <div class="form-input">                                        
                    <input type="submit" value="отправить запрос">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
