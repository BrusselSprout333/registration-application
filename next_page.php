<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- проверка перехода на другие страницы без повторной авторизации -->
<h1>Сайт</h1>
<h2>Контент сайта</h2>
<div class="main_theme">
    <a href="exit.php">Выйти</a>
    <p>Привет <?=$_COOKIE['user']?></p>
</div>
</body>