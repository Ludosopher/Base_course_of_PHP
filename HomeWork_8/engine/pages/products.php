<?php
function productsAction () {
    $sql = "SELECT id, file_name, width, product_name, price, views FROM images ORDER BY views DESC";
    $result = mysqli_query(getConnect(), $sql);
    $html = '<script src="js/test.js"></script>';
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= <<<php
            <div>
                <a href="?p=product&a=product&id={$row['id']}"><img src = "img/{$row['file_name']}"></a>
                <h3>{$row['product_name']}</h3>
                <p>Цена: {$row['price']}$</p>
                <a href="?p=basket&a=add&id={$row['id']}">В корзину</a>
            </div>
php;
    }
    return <<<php
          <h1>Каталог</h1>
          <div class = 'img_block'>
          {$html}
          </div>
php;
} 
//<p onclick="addAction()" style="cursor: pointer">add</p>
//<p onclick="addGoodInBasket({$row['id']})" style="cursor: pointer">add</p>

?> 