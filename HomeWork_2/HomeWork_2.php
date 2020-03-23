<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <?php
                                   // Task 1
        echo 'Task 1<br>';
        $a=rand(-100,100);
        $b=rand(-100,100);
        echo 'a = ' . $a . '<br>';
        echo 'b = ' .$b . '<br>';
        if ($a>=0 && $b>=0) {
            echo $a-$b . '<br>';
        } elseif ($a<0 && $b<0) {
            echo $a*$b . '<br>';
        } elseif (($a>=0 && $b<0) || ($a<0 && $b>=0)) {
            echo $a+$b . '<br>';
        }
                                  // Task 2
        echo '<br>Task 2<br>';
        $c=rand(0,15);
        switch ($c) {
            case '0':
                echo '0, ';
            case '1':
                echo '1, ';
            case '2':
                echo '2, ';
            case '3':
                echo '3, ';
            case '4':
                echo '4, ';
            case '5':
                echo '5, ';
            case '6':
                echo '6, ';
            case '7':
                echo '7, ';
            case '8':
                echo '8, ';
            case '9':
                echo '9, ';
            case '10':
                echo '10, ';
            case '11':
                echo '11, ';
            case '12':
                echo '12, ';
            case '13':
                echo '13, ';
            case '14':
                echo '14, ';
            case '15':
                echo '15 <br>';
        }
                                 // Task 3
        echo '<br>Task 3<br>';
        function sum($a,$b) {
            return $a+$b;
        }
        function subt($a,$b) {
            return $a-$b;
        }
        function mult($a,$b) {
            return $a*$b;
        }
        function div($a,$b) {
            return $a/$b;
        }
        $d=7;
        $e=4;
        echo sum($d,$e) . '<br>';
        echo subt($d,$e) . '<br>';
        echo mult($d,$e) . '<br>';
        echo div($d,$e) . '<br>';
                               
                                                         // Task 4
        echo '<br>Task 4<br>';
        $sum = 'sum';
        $subt = 'subt';
        $mult = 'mult';
        $div = 'div';
        $f=10;
        $g=5;

        function mathOperation($arg1,$arg2,$operation) 
        {
            return $operation($arg1,$arg2);
        }
        
        $action = 'умножение';
        
        switch ($action) {
            case 'сложение':
                echo mathOperation($f,$g,$sum). '<br>';
                break;
            case 'вычитание':
                echo mathOperation($f,$g,$subt). '<br>';
                break;
            case 'умножение':
                echo mathOperation($f,$g,$mult). '<br>';
                break;
            case 'деление':
                echo mathOperation($f,$g,$div). '<br>';
                break;
            default:
                echo 'Допущена ошибка в написании названия арифметической операции';
        }
    
                                                         // Task 5
        echo '<br>Task 5<br>';
        $year = date("Y");
        $str = file_get_contents('source.html');
        echo str_replace('{YEAR}', $year, $str);
                                                            // Task 6
        echo '<br>Task 6<br>';
        function power($val, $pow) {
            if ($pow != 1) {
              return $val *= power($val,$pow - 1);
            } else {
              return $val;
            }
        }
        echo power(3,3) . '<br>';

                                                            // Task 7
        echo '<br>Task 7<br>';
        echo date('H.i');
        echo '<br>';
        function correct_name_time () {
            $nameH='';
            $nameM='';
            $cHour = date('H');
            $cHourMark = substr((string)$cHour,-1); // Получаем последнюю цифру текущего часа
            $cHourMarkPen = substr((string)$cHour,-2,1); // Получаем ПРЕДпоследнюю цифру текущего часа
            $cMinute = date('i');
            $cMinuteMark = substr((string)$cMinute,-1); // Получаем последнюю цифру текущей минуты
            $cMinuteMarkPen = substr((string)$cMinute,-2,1); // Получаем ПРЕДпоследнюю цифру текущей минуты 
            
            //
            if (($cHourMark == 1 && strlen((string)$cHour) == 1) || ($cHourMark == 1 && $cHourMarkPen != 1)) {
                $nameH='час';
            } elseif (($cHourMark == 2 || $cHourMark == 3 || $cHourMark == 4) && $cHourMarkPen != 1) {
                $nameH='часа';
            } else {
                $nameH='часов';
            }
            
            //
            if (($cMinuteMark == 1 && strlen((string)$cMinute) == 1) || ($cMinuteMark == 1 && $cMinuteMarkPen != 1)) {
                $nameM='минута';
            } elseif (($cMinuteMark == 2 || $cMinuteMark == 3 || $cMinuteMark == 4) && $cMinuteMarkPen != 1) {
                $nameM='минуты';
            } else {
                $nameM='минут';
            }
            
            //
            return "Текущее время - {$cHour} {$nameH}, {$cMinute} {$nameM}.";
        }
        echo correct_name_time ();
    
   ?>
    
</body>
</html>