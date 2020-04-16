<?php
function indexAction () { // Открытие личного кабинета пользователя или администратора при вводе логина и пароля
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            redirect('?p=auth_user', 'Не все данные переданы');
            return;
        }
        $login = clearStr($_POST['login']);
        $password = $_POST['password'];
        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql = "SELECT * FROM users WHERE `login` = '$login'";
        $result = mysqli_query(getConnect(), $sql);
        $row = mysqli_fetch_assoc($result);
        
        if (empty($row)) {
            redirect('?p=auth_user', 'Неверный логин');
            return;
            
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['auth'] = true;
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
        } else {
            redirect('?p=auth_user', 'Неверный пароль');
            return;
        }
    }

    if (!empty($_GET['exit'])) {
        session_destroy();
        header('Location: /');
    }
    $orders = orders();
    if (!empty($_SESSION['auth']) && $_SESSION['is_admin'] != 'admin') { // Вывод для пользователя
        return <<<php
        <div class="welcom">    
        <h1>Личный кабинет пользователя</h1>
        <h2>Добро пожаловать, {$_SESSION['user_name']}!</h2>
            <a href="?p=auth_user&exit=1">Выход</a>
            <h3>Мои заказы</h3>
            <a href="?p=auth_user&orders=1" style="margin-left: 10px">Посмотреть свои заказы</a>
            <a href="?p=auth_user&orders=0" style="margin-left: 10px">Скрыть</a><br>
            $orders
        </div>
php;
    } elseif (!empty($_SESSION['auth']) && $_SESSION['is_admin'] == 'admin') { // Вывод для администратора
        return <<<php
        <div class="welcom">    
        <h1>Кабинет администратора</h1>
            <a href="?p=auth_user&exit=1">Выход</a> 
            <h3>Заказы</h3>
            <a href="?p=auth_user&orders=2" style="margin-left: 10px">Посмотреть заказанные товары</a>
            <a href="?p=auth_user&orders=3" style="margin-left: 10px">Посмотреть заказы</a>
            <a href="?p=auth_user&orders=0" style="margin-left: 10px">Скрыть</a><br>
            <h3>Добавление товаров</h3>
            <form method="post" action="?p=auth_user&a=addNewGoog">
                <p>Название товара:</p><br>
                <input type="text" name="product_nm">
                <p>Название фото товара:</p><br>
                <input type="text" name="img_name"><br>
                <p>Цена:</p><br>
                <input type="text" name="price_b"><br>
                <input type="submit">
            </form>
            $orders
        </div>
php;
    } else {                                                                // Вывод если пароль НЕверен
        return <<<php
        <h3>Введите логин и пароль для входа в личный кабинет</h3>
        <form method="post">
            <p>Логин:</p><br>
            <input type="text" name="login">
            <p>Пароль:</p><br>
            <input type="text" name="password"><br>
            <input type="submit">
        </form>    
php;
    }
}

function orders() { // Вывод всех товаров, заказанных пользователем
    
    if ($_GET['orders'] == 1) {  // Вариант, когда список своих заказов запрашивает пользователь, нажав на кнопку "Посмотреть свои заказы"
        $user_id = $_SESSION['user_id'];
        $condition = "WHERE user_id = '$user_id'";
        $change_status = "";
        $userVisual = 'none';
    }
    
    if ($_GET['orders'] == 2) {  // Вариант, когда список всех заказов запрашивает администратор, нажав на кнопку "Посмотреть заказы"
        $condition = "";
        $userVisual = 'inline';
    }

    if ($_GET['orders'] == 3) {                 // Вариант запроса списка заказов таблицы orders администратором
        $sql_ord = "SELECT * FROM orders";
        $res_ord = mysqli_query(getConnect(), $sql_ord);
        $ords = '';          
        while ($qwe = mysqli_fetch_assoc($res_ord)) {   // Вывод html разметки списка заказов
            $ords .= <<<php
                <div>
                    <p>Заказ № {$qwe['id']}</p><br>
                    <p>Текущий статус: <span style="font-weight: 700">{$qwe['status']}</span></p><br>
                    <form method='post' action="?p=auth_user&a=changeStatus&order_id={$qwe['id']}">
                        <p>Указать новый статус:</p><br>
                        <select name = 'status_order'>
                            <option value='Предварительная обработка'>Предварительная обработка</option>
                            <option value='Ожидание оплаты'>Ожидание оплаты</option>
                            <option value='Сборка'>Сборка</option>
                            <option value='Доставка'>Доставка</option>
                        </select>
                        <input type='submit'>
                    </form>
                </div><hr>
php;
        }
        return <<<php
            <div class="basket" style="margin-top: 20px">$ords</div>
php;
    }

    if (empty($_GET['orders'])) {    // Вариант, когда список заказов никто не запрашивает (нет нажатия на кнопку запроса вывода списка заказов)
        return;
    }

    if ($_GET['orders'] < 3) { 
        $result = db_orders($condition);
        $orders = '';          
        while ($row = mysqli_fetch_assoc($result)) {  // Вывод html разметки списка заказанных товаров
            $total_cost = $row['price'] * $row['count'];
            $orders .= <<<php
            <img src = "img/{$row['file_name']}" style = "width: 70px">
            <h3>{$row['product_name']}</h3><br>
            <p>Цена: {$row['price']}$</p><br>
            <p>Количество: {$row['count']}</p><br>
            <p>Общая стоимость: {$total_cost}$</p><br>
            <p style="display: {$userVisual}">Заказчик № {$row['user_id']}</p><br><br>
            <p>Номер заказа: {$row['order_id']}</p><br>
            <p>Дата регистрации: {$row['date']}</p><br>
            <p>Статус: {$row['status']}</p><br><hr>
php;
        }
        return <<<php
            <div class="basket">$orders</div>
php;
    }
}

function db_orders($con) {  // MySQL запрос на объединённую таблицу (order_items + oreder + images)
    $sql = "SELECT images.product_name, images.file_name, order_items.price, order_items.count, order_items.order_id, orders.user_id, orders.date, orders.status FROM order_items 
                INNER JOIN orders ON orders.id = order_items.order_id 
                INNER JOIN images ON images.id = order_items.good_id " . $con;
    $result = mysqli_query(getConnect(), $sql);
    return $result;
}

function changeStatusAction() {  // Изменение статуса заказа в таблице orders при нажатии на кнопку "Отправить"
    if (!empty($_POST['status_order'])) {
        $order_stat = $_POST['status_order'];
        $order_id = $_GET['order_id'];
        $sql = "UPDATE orders SET status = '$order_stat' WHERE id = '$order_id'";
        mysqli_query(getConnect(), $sql);
    }
    redirect("", "Статус заказа № {$order_id} изменён на '{$order_stat}'");
    return;
}

function addNewGoogAction() {
    if (!empty($_POST['product_nm'])) {
        $prodName = $_POST['product_nm'];
        $imgName = $_POST['img_name'];
        $price = $_POST['price_b'];
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql = "INSERT INTO images 
            (file_name, width, product_name, price) 
        VALUES 
            ('$imgName', '252', '$prodName', '$price')";
        mysqli_query(getConnect(), $sql);

        redirect("?p=auth_user", "Новый товар добавлен в базу данных!");
        return;
    }
}

?>