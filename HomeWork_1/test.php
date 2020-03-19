                                       <!-- Задание 4 -->
   <?php
    $title = 'Home Work #1';
    $header = 'Current date';
    $currDate = date("d.m.Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title> <!-- Задание 4 -->
</head>
<body>
                                                        <!-- Задание 2 -->
  <?php echo 'Hi, World! <br>' ?>
  
  <?php
    $name = "GeekBrains user";
    echo "Hello, $name!<br>";
  ?>
  
  <?php
    define('MY_CONST', 100);
    echo MY_CONST;
    echo '<br>';
  ?>
  
  <?php
    $int10 = 42;
    $int2 = 0b101010;
    $int8 = 052;
    $int16 = 0x2A;
    echo "Десятеричная система $int10 <br>";
    echo "Двоичная система $int2 <br>";
    echo "Восьмеричная система $int8 <br>";
    echo "Шестнадцатеричная система $int16 <br>";
  ?>
  
  <?php
    $precise1 = 1.5;
    $precise2 = 1.5e4;
    $precise3 = 6E-8;
    echo "$precise1 | $precise2 | $precise3";
    echo '<br>';
  ?>
  
  <?php
    $a = 1;
    echo $a . '<br>';
    echo '$a <br>';
  ?>
  
  <?php
    $a = 10;
    $b = (boolean) $a;
    echo $b . '<br>';
  ?>
  
  <?php
    $a = 'Hi, ';
    $b = 'World!';
    $c = $a . $b;
    echo $c . '<br>';
  ?>
  
  <?php
    $a = 4;
    $b = 5;
    echo $a + $b . '<br>';    // сложение
    echo $a * $b . '<br>';    // умножение
    echo $a - $b . '<br>';    // вычитание
    echo $a / $b . '<br>';  // деление
    echo $b % $a . '<br>'; // остаток от деления
    echo $a ** $b . '<br>'; // возведение в степень
  ?>
  
  <?php
    $a = 4;
    $b = 5;
    $a += $b;
    echo 'a = ' . $a . '<br>';
    $a = 0;
    echo $a++ . '<br>';     // Постинкремент
    echo ++$a . '<br>';    // Преинкремент
    echo $a-- . '<br>';     // Постдекремент
    echo --$a . '<br>';    // Предекремент
  ?>
  
  <?php
    $a = '5';
    $b = 5;
    var_dump($a == $b);  // Сравнение по значению
    echo '<br>';
    var_dump($a === $b); // Сравнение по значению и типу
    echo '<br>';
    var_dump($a > $b);    // Больше
    echo '<br>';
    var_dump($a < $b);    // Меньше
    echo '<br>';
    var_dump($a <> $b);  // Не равно
    echo '<br>';
    var_dump($a != $b);   // Не равно
    echo '<br>';
    var_dump($a !== $b); // Не равно без приведения типов
    echo '<br>';
    var_dump($a <= $b);  // Меньше или равно
    echo '<br>';
    var_dump($a >= $b);  // Больше или равно
    echo '<br>';
    echo '<br>';
  ?>
                                                                     <!-- Задание 3 -->
  <?php
    $a = 5;
    $b = '05';
    var_dump($a == $b);         // Почему true? Потому что это сравнение по значению без учёта типа
    echo '<br>';
    var_dump((int)'012345');     // Почему 12345? Приведение к целому числу с помощью (int) всегда будет приведено к базе по умолчанию.
    $qwe = 012345;
    echo '<br>';
    echo $qwe;
    echo '<br>';
    var_dump((float)123.0 === (int)123.0); // Почему false? Потому что разные типы данных. 
    echo '<br>';
    var_dump((float)'123.0');
    echo '<br>';
    var_dump((int)'123.0');
    echo '<br>';
    var_dump((int)0 === (int)'hello, world'); // Почему true? (int) 'Текст' равно 0. Так как типы данных одинаковые, то 0 действительно равно 0.
    echo '<br>';
    var_dump((int)0);
    echo '<br>';
    var_dump((int)'hello, world');
    echo '<br>';
  ?>
  
                                                                     <!-- Задание 4 -->
  <h1><?php echo $header ?></h1>
  <?php echo $currDate . '<br>' ?>
                                                                      <!-- Задание 5 -->
  <?php
    $a=1;
    $b=2;
    echo $a+=1;
    echo '<br>';
    echo $b-=1;
  ?>
  
</body>
</html>