<?php
if (!empty($_GET['fullsize'])) {  // При нажатии на ссылку "Заказать" открывается страница single.php с фотографией выбранного товара в большем размере и информацией о количестве просмотров
    $id = (int)$_GET['fullsize'];
    $link_by_press = mysqli_connect('127.0.0.1', 'root', '', 'shop');
    $sql_by_press = "SELECT id, file_name, width, product_name, views FROM images WHERE id = $id";
    $result_by_press = mysqli_query($link_by_press, $sql_by_press);
    $row_by_press = mysqli_fetch_assoc($result_by_press);
    $sql_views = "UPDATE images SET views = views + 1 WHERE images.id = $id"; // запрос на увеличение числа просмотров товара в таблице mysql
    mysqli_query($link_by_press, $sql_views); // увеличение числа просмотров товара в таблице mysql в поле views 
    $wiews = (int)$row_by_press['views'] + 1; // присвоение переменной значения числа просмотров с учётом текущего просмотра (+1)
    $single = <<<php
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
    img {
       display: block;
       margin: 50px auto;
       border: 1px solid DarkGrey;
    }
    h3, p {
        text-align: center;
    }
    a {
        display: block;
        text-align: center;
    }
    </style>
    <body>
        <img src = "HW_4_img/{$row_by_press['file_name']}">
        <h3>{$row_by_press['product_name']}</h3>
        <p>Число просмотров: {$wiews}</p>
        <a href = 'HomeWork_5.php'>В каталог</a>
    </body>
    </html>
php;
    file_put_contents ('single.php', $single);
    header('Location: single.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    h1 {
        text-align: center;
    }

    .img_block {
       display: flex;
       justify-content: space-around;
    }

    .img_block > div {
        width: 105px;
    }

    .img_block > div > a {
        display: block;
    }

    .img_block > div > h3 {
        font-size: 12px;
    }

    .img_block > div > a > img {
        width: 100px;
    }
    </style>
    <h1>Каталог</h1>
    <?php
    $link = mysqli_connect('127.0.0.1', 'root', '', 'shop');
    $sql = "SELECT id, file_name, width, product_name, views FROM images ORDER BY views DESC";
    $result = mysqli_query($link, $sql);
    echo "<div class = 'img_block'>";    
    while ($row = mysqli_fetch_assoc($result)) { // размещение на странице фотографий товаров и их названий исходя из данных таблицы mysql images
        echo <<<php
            <div>
            <a href="HW_4_img/{$row['file_name']}" target='_blank'><img src = "HW_4_img/{$row['file_name']}"></a>
            <h3>{$row['product_name']}</h3>
            <a href="?fullsize={$row['id']}">Заказать</a>
            </div>
php;
    }
    echo "</div>";
          
    ?>
    
</body>
</html>