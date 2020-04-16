<?php

function add_userAction () {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $date = $_POST['date'];
            
        $sql = "INSERT INTO users 
            (name, login, password, date) 
        VALUES 
            ('$name', '$login', '$password', '$date')";
    
        mysqli_query(getConnect(), $sql);
        $res = '';
        if ($sql) {
            $res = '<p>Поздравляем, Вы зарегистрированы! Можете войти в личный кабинет.</p>';
          } else {
            $res = '<p>Произошла ошибка! Попробуйте снова!</p>';
          }
    }

    return <<<php
    <form method="post">
        <p>Укажите своё имя:</p><br>
        <input type="text" name="name">
        <p>Укажите свой логин:</p><br>
        <input type="text" name="login">
        <p>Укажите свой пароль:</p><br>
        <input type="text" name="password"><br>
        <p>Укажите свою дату рождения:</p><br>
        <input type="date" name="date"><br>
        <input type="submit">
    </form>
    $res
php;
}

?>

