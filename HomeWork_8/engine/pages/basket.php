<?php

function indexAction()
{
    $needAuth = need_auth(); // Присваиваем переменной результат проверки пользователя - прошел ли он аутентификацию.
    if ($_SESSION['goods']) {
        $arr = $_SESSION['goods'];
        $goods = '';
        foreach ($arr as $key => $val) {
            $goods .= <<<php
            <img src = "img/{$val['img_name']}"><br>
            <h3>{$val['good_name']}</h3><br>
            <p>Цена: {$val['price']}$</p><br>
            <p>Количество: {$val['count']}</p>
            <a href="?p=basket&a=add&id={$key}">Добавить</a>
            <a href="?p=basket&a=del&id={$key}">Удалить</a><br><hr>
php;
        }
        return <<<php
            <h2>Корзина</h2>
            <div class="basket">$goods</div>
            $needAuth
php;
    } else {
        return "<h2>Корзина</h2>
                <p>Корзина пуста</p>";
    }
}

function addAction() //Добавление товара в корзину
{
    $id = getId();
    $sql = "SELECT id, file_name, width, product_name, views, price FROM images WHERE id =" . getId();
    $result = mysqli_query(getConnect(), $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$_SESSION['goods'][$id]) {
        $good = [
            'id' => $row['id'],
            'img_name' => $row['file_name'],
            'good_name'=> $row['product_name'],
            'price' => $row['price'],
            'count'=> 1,
        ];
        $_SESSION['goods'][$id]= $good;
    } else {
        $_SESSION['goods'][$id]['count']++;
    }
    
    if (verify_id (getId())) {
        redirect("", 'Товар добавлен в корзину');
        return;
    } else {
        redirect('?p=products', 'Что-то пошло не так');
        return;
    }
}

function ajaxAddAction () {
    header('Content-Type: application/json');
    $responce = [
        'success' => addAction(),
        'count' => countBasket(),
    ]; 
    echo json_encode($responce);
}

function delAction() // Удаление товара из корзины
{
    if ($_SESSION['goods'][getId()]['count'] > 1) {
        $_SESSION['goods'][getId()]['count']--;
    } else {
        unset($_SESSION['goods'][getId()]);
    }
    return indexAction();
}

function verify_id ($id) {
    if (empty($id)) {
        return false;
    } else {
        return true; 
    }
}

function need_auth() {
    if (isAdmin()) {
        return '<a href="?p=orders">Оформить заказ</a>';
    } else {
        return '<p>Для оформления заказа необходимо авторизоваться в <a href="?p=auth_user">личном кабинете</a></p>';
    }
}