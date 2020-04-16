<?php
function indexAction() { // Создание списка заказываемых товаров
    if ($_SESSION['goods']) {
        $arr = $_SESSION['goods'];
        $goods = '';
        foreach ($arr as $key => $val) {
            $total_cost = $val['price'] * $val['count'];
            $goods .= <<<php
            <img src = "img/{$val['img_name']}">
            <h3>{$val['good_name']}</h3><br>
            <p>Цена: {$val['price']}$</p><br>
            <p>Количество: {$val['count']}</p><br>
            <p>Общая стоимость: $total_cost$</p><br><hr>
php;
        }
        return <<<php
            <h1>Оформление заказа</h1>
            <h2>Товары</h2>
            <div class="basket">$goods</div>
            <h2>Укажите адрес доставки</h2>
            <form method="post" action="?p=orders&a=addOrder">
                <input type="text" size="50" name="adress">
                <input type="submit">
            </form>
php;
    } else {
        return "<h1>Оформление заказа</h1>
                <p>Корзина заказа пуста.</p>";
    }
}

function addOrderAction() {  // Запись сведений о заказанных товарах в базу данных mysql - в таблицы orders и order_items
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['adress'])) {
            redirect('?p=auth_user', 'Для оформления заказа укажите адрес доставки');
            return;
        }
        
        $user_id = $_SESSION['user_id'];
        $adress = $_POST['adress'];
        $date = date('Y-m-d H:i');

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql_add = "INSERT INTO orders 
            (user_id, adress, date) 
        VALUES 
            ('$user_id', '$adress', '$date')";
        mysqli_query(getConnect(), $sql_add); // вносим сведения о заказе в таблицу orders.
    }
    //Определяем номер сделанного только что заказа в базе данных, в таблице orders.
    //
    $user_id = $_SESSION['user_id'];
    $sql_ord = "SELECT * FROM orders WHERE user_id = '$user_id' AND date = '$date'";
    $result = mysqli_query(getConnect(), $sql_ord);
    $use_ord = mysqli_fetch_assoc($result);
    $orderNumber = $use_ord['id']; // Номер сделанного только что заказа в базе данных, в таблице orders.
    //
    foreach ($_SESSION['goods'] as $val) {
        $idOI = $val['id'];
        $countOI = $val['count'];
        $price = $val['price'];
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql_items = "INSERT INTO order_items 
            (order_id, good_id, count, price)
        VALUES 
            ('$orderNumber', '$idOI', '$countOI', '$price')";
        mysqli_query(getConnect(), $sql_items); // вносим сведения о товарах сделанного заказа в таблицу order_items
    }  
    redirect('?p=auth_user', "Заказ оформлен!");
    return;
}

?>