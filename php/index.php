<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Europe/Moscow');

function ifEnter($x, $y, $r){
    $resultF = false;
    if ($x >= 0 && $y <= 0){
        if ((-1 * $y) + $x <= $r/2){
            $resultF = true;
        }
    }
    if ($x <= 0 && $y <= 0){
        if ($x >= -$r && $y >= (-$r / 2)){
            $resultF = true;
        }
    }
    if ($x >= 0 && $y >= 0){
        if ( $x <= $r / 2 && $y <= $r / 2  && pow($x, 2) + pow($y, 2) <= pow($r/2, 2)){
            $resultF = true;
        }
    }
    return $resultF;
}

$curTime = date("H:i:s");
$arrayOfX = array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2);
$arrayOfR = array(1, 1.5, 2, 2.5, 3);

if ((isset($_POST["x"]) && isset($_POST["y"]) && isset($_POST["r"]))){
    $uncheckedX = $_POST["x"];
    $uncheckedY = $_POST["y"];
    $uncheckedR = $_POST["r"];

    if (is_numeric($uncheckedX) && is_numeric($uncheckedY) && is_numeric($uncheckedR)){
        $x = floatval($uncheckedX);
        $y = floatval($uncheckedY);
        $r = floatval($uncheckedR);
        if (in_array($x, $arrayOfX) && in_array($r, $arrayOfR) && $y > -5 && $y < 5){
            $scriptStart = microtime(true);
            $checkResult = ifEnter($x, $y, $r);
            if ($checkResult){
                $checkResultText = "True";
            }else{
                $checkResultText = "False";
            }
            $scriptResultTime = round((microtime(true) - $scriptStart) * 1000000, 1);
            exit("
            <tr>
                <th>$checkResultText</th>
                <th>$x</th>
                <th>$y</th>
                <th>$r</th>
                <th>$curTime</th>
                <th>$scriptResultTime</th>
            </tr>");
        }else{
            // header("HTTP/1.1 400 Bad Request");
            echo '<script>alert("Something wrong with X Y R, seems like some values are not in range");</script>';
            exit();
        }

    }else{
        // header("HTTP/1.1 400 Bad Request");
        echo '<script>alert("Something wrong with X Y R, seems there is some String");</script>';
        exit();
    }
}else{
    exit("Not enough data");
}