<?php
function productAction () {
    // Описание товара
    $sql_by_press = "SELECT id, file_name, width, product_name, views, price FROM images WHERE id =" . getId();
    $result = mysqli_query(getConnect(), $sql_by_press);
    $row = mysqli_fetch_assoc($result);
    $sql_views = "UPDATE images SET views = views + 1 WHERE images.id =" . getId();
    mysqli_query(getConnect(), $sql_views);
    $wiews = (int)$row['views'] + 1;
    $price = (int)$row['price'];
    // Отправка введённого отзыва в базу данных при нажатии кнопки "Отправить"
    feedback_add ();
    // Рендер имеющихся отзывов о товаре
    $feedback = feedback_all ();
    //
    return <<<php
        <div class="product">
            <img src = "img/{$row['file_name']}">
            <h3>{$row['product_name']}</h3>
            <p> Цена: {$price}$</p>
            <p>Число просмотров: {$wiews}</p>
            <a href="?p=basket&a=add&id={$row['id']}">В корзину</a>
            <a href="{$_SERVER['HTTP_REFERER']}">Назад</a>
        </div>
        <h2>Оставьте отзыв</h2>
        <form method="post">
            <label for="author">Укажите своё имя:</label>
            <input id="author" type="text" name="author"><br>
            <label for="text">Напишите свой отзыв:</label><br>
            <textarea id="text" rows="10" cols="45" name="text"></textarea><br>
            <input type="submit">
        </form>
        <h2>Отзывы</h2>
        <div class = 'all_feedback'>
            {$feedback}
        </div>
php;
}

function feedback_all () { // Функция рендера имеющихся отзывов о товаре
    $sql_all = "SELECT * FROM feedback WHERE id_product =" . getId();
    $result_fb = mysqli_query(getConnect(), $sql_all);
    $html = '';    
    while ($row_fb = mysqli_fetch_assoc($result_fb)) {
        $html .= <<<php
            <div>    
                <b><p>{$row_fb['author']}: {$row_fb['date']}</p></b>
                <p>{$row_fb['text']}</p><hr>
            </div>
php;
    }
    return <<<php
        <div class = 'all_feedback'>
        {$html}
        </div>
php;
}

function feedback_add () { // Функция отправки ввёдённого отзыва в базу данных
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $author = $_POST['author'];
        $text = $_POST['text'];
        $id_product = getId();
        $date = date('Y-m-d H:i');
        $sql_add = "INSERT INTO feedback 
            (author, text, id_product, date) 
        VALUES 
            ('$author', '$text', '$id_product', '$date')";
        mysqli_query(getConnect(), $sql_add);
        // if ($sql_add) {
        //     echo '<p>Данные успешно добавлены в таблицу.</p>';
        //   } else {
        //     echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
        //   }
    }
}

?>

