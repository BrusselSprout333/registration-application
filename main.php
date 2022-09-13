<?php session_start(); ?>
<div class="main_theme">
    <a href="exit.php">Выйти</a>
    <p>Привет <?=$_SESSION['user']?></p>
    <a href="next_page.php">Переход на следующие страницы</a>
</div>