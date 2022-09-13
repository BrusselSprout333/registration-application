<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>авторизация</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Сайт</h1>
    <?php
        session_start();
        if(!isset($_COOKIE['user']) && !$_SESSION['auth']): //если уже авторизован
    ?>
    <div class="container">
    <div class="row">
        <div class = "col">
           <form id="mailForm">
               <label for="mailForm">Регистрация</label>
               <input type="text" class="form-control" name="login" id="login1" placeholder="Введите логин">
                    <label for="login1" id="error_login1" class="errorMess"></label> <br>
               <input type="password" class="form-control" name="password" id="password1" placeholder="Введите пароль">
                    <label for="login1" id="error_pass1" class="errorMess"></label> <br>
               <input type="password" class="form-control" name="password" id="password_confirm" placeholder="Подтвердите пароль">
                    <label for="login1" id="error_pass2" class="errorMess"></label> <br>
               <input type="email" class="form-control" name="email" id="email" placeholder="Введите email">
                    <label for="login1" id="error_email" class="errorMess"></label> <br>
               <input type="text" class="form-control" name="name" id="name" placeholder="Введите ваше имя">
                    <label for="login1" id="error_name" class="errorMess"></label> <br>
               <button type="button" id="registration">Регистрация</button>
            </form>
        </div>
        <div class = "col">
            <form id="authForm">
                <label for="authForm">Авторизация</label>
                <input type="text" class="form-control" name="login" id="login2" placeholder="Введите логин">
                    <label for="login2" id="error_login2" class="errorMess"></label> <br>
                <input type="password" class="form-control" name="password" id="password2" placeholder="Введите пароль">
                    <label for="password2" id="error_pass" class="errorMess"></label> <br>
                <button type="button" id="authorization">Войти в аккаунт</button>
            </form>
        </div>
    </div>
    </div>
        <div class="main_theme">
        <?php else:
            include "main.php";
         endif;?>
        </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript" src='js/post.js'></script>
  <noscript><span>У Вас отключён JavaScript. Формы не будут отправлены</span></noscript>

</body>
</html>
