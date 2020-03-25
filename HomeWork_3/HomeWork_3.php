<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeWork_3</title>
</head>
<body>
<?php
                                                                // Task 1
echo 'Task_1<br>';
$a=0;
while ($a<=100) {
    if ($a % 3 === 0) {
        echo $a . ', ';
    }
    $a++;
}
                                                                // Task 2
echo '<br><br>Task_2<br>';
$b=0;
do {
    if ($b === 0) {
        echo "{$b} - это ноль.<br>";
    } elseif ($b % 2 === 0) {
        echo "{$b} - чётное число.<br>";
    } else {
        echo "{$b} - нечётное число.<br>";
    }
    $b++;
} while ($b <= 10);
                                                                // Task 3
echo '<br><br>Task_3';
$russianCities = [
    'Московская область' => ['Москва', 'Клин', 'Зеленоград'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Шацк', 'Касимов'],
];
foreach ($russianCities as $key => $value) {
    echo '<br><b>' . $key . ':</b><br>';
    for ($ci=0; $ci < count($value); $ci++) {
        if (count($value) - $ci === 1) {
            echo $value[$ci] . '.'; 
        } elseif (count($value) - $ci > 1) {
            echo $value[$ci] . ', '; 
        }
    }
}
                                                                // Task 4
echo '<br><br>Task_4<br>';
$letters = ['а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'ph','х'=>'h','ц'=>'zz','ч'=>'ch','ш'=>'sh','щ'=>'shch','ъ'=>'"','ы'=>'y','ь'=>'\'','э'=>'e','ю'=>'yu','я'=>'ya',' '=>' '];
$enteredText = 'щенок в чистеньком подъезде';
function trunslit ($cyrilText, $letters) {
    for ($i=0; $i < mb_strlen($cyrilText); $i++) { //можно использовать iconv_strlen
        $cyrilLetter = mb_substr($cyrilText, $i, 1); // можно использовать iconv_substr
        $latinLater = $letters [$cyrilLetter];
        echo $latinLater;
    }
}
trunslit ($enteredText, $letters);
                                                                // Task 5
echo '<br><br>Task_5<br>';
$latinString = 'We all are seating at home now.';
$cyrilString = 'Мы все сегодня сидим дома.';
function replaceElem ($string) {
    $newString = str_ireplace(' ', '_', $string);
    return $newString; 
}
echo replaceElem ($cyrilString) . '<br>';
echo replaceElem ($latinString);


?>
    
</body>
</html>
