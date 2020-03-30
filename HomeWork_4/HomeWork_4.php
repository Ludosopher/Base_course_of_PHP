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

    .img_block > a > img {
        width: 100px;
    }
    </style>
    <h1>Каталог</h1>
    <?php
                                                                                                // Task_1.1
    // $images = [
    //     'HW_4_img/Card-1.jpg', 
    //     'HW_4_img/Card-2.jpg', 
    //     'HW_4_img/Card-3.jpg', 
    //     'HW_4_img/Card-4.jpg', 
    //     'HW_4_img/Card-5.jpg', 
    //     'HW_4_img/Card-6.jpg'
    // ];
    // echo "<div class = 'img_block'>";
    // for ($i = 0; $i < count($images); $i++) {
    //     echo "<a href='{$images[$i]}' target='_blank'><img src = '{$images[$i]}'></a>";
    // }
    // echo "</div>";
    ///
                                                                                                // Task_1.2
    $dirImg = '/HW_4_img';
    $arrImg = scandir(__DIR__ . $dirImg);
    function creatCatal ($dir,$arr) {
        echo "<div class = 'img_block'>";
        for ($i = 2; $i < count($arr); $i++) {
        echo "<a href='{$dirImg}/{$arr[$i]}' target='_blank'><img src = '{$dir}/{$arr[$i]}'></a>";
        }
        echo "</div>";
    }
    creatCatal ($dirImg,$arrImg);
    
    //                                                                                            
                                                                                                // Task_2.1 and Task_2.2
    $file = file_get_contents ('HomeWork_4.php');
    function regRequest ($file,$dirLogs) {
       if ($file) {
        file_put_contents("{$dirLogs}/log.txt", 'Request: ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
       } 
       $requestes = file_get_contents ("{$dirLogs}/log.txt"); // Получаем содержимое файла log.txt
       $numberReq = substr_count($requestes, 'Request'); // Подсчитываем число повторений слова 'Request', и так определяем число запросов
       if ($numberReq === 10) {
           $arrLogF = scandir(__DIR__ . "/{$dirLogs}"); // Получаем массив файлов папки 'logs'
           $numLogF = count($arrLogF) - 3; // подсчитываем число элементов в массиве; отнимаем 3 элемента, которые не формируют число созданных   файлов 'logx.txt' ('..', '..' и 'log/txt'). Таким образом получаем номер следующего файла 'logx/txt'.
           copy ("{$dirLogs}/log.txt", "{$dirLogs}/log{$numLogF}.txt");
           file_put_contents("{$dirLogs}/log.txt", '');
       }
    }
    regRequest($file, 'logs');
    
    ?>
</body>
</html>