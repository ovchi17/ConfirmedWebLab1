<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Europe/Moscow');
session_start();


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

if (!isset($_SESSION['tableD'])) {
    $_SESSION['tableD'] = "
        <tr>
        <th>Result</th>
        <th>X</th>
        <th>Y</th>
        <th>R</th>
        <th>Current Time</th>
        <th>Script time</th>
        </tr>";
}


$curTime = date("H:i:s");
$arrayOfX = array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2);
$arrayOfR = array(1, 1.5, 2, 2.5, 3);

if(isset($_POST["onLoad"])){
    if ($_POST["onLoad"] == "true"){
        exit($_SESSION['tableD']);
    }else{
        echo '<script>alert("bad arg for onLoad");</script>';
        exit();
    }
}

if(isset($_POST["clearF"])){
    if ($_POST["clearF"] == "true"){
        $_SESSION['tableD'] = "
            <tr>
            <th>Result</th>
            <th>X</th>
            <th>Y</th>
            <th>R</th>
            <th>Current Time</th>
            <th>Script time</th>
            </tr>";
        exit();
    }else{
        echo '<script>alert("bad arg for clearF");</script>';
        exit();
    }
}

if ((isset($_POST["x"]) && isset($_POST["y"]) && isset($_POST["r"]))){
    $uncheckedX = $_POST["x"];
    $uncheckedY = $_POST["y"];
    $uncheckedR = $_POST["r"];

    if (is_numeric($uncheckedX) && is_numeric($uncheckedY) && is_numeric($uncheckedR)){
        $x = floatval($uncheckedX);
        $y = floatval($uncheckedY);
        $r = floatval($uncheckedR);
        if (in_array($x, $arrayOfX) && in_array($r, $arrayOfR) && $y > -5 && $y < 5 && strlen((string)$y) <= 7){
            $scriptStart = microtime(true);
            $checkResult = ifEnter($x, $y, $r);
            if ($checkResult){
                $checkResultText = "True";
            }else{
                $checkResultText = "False";
            }
            $scriptResultTime = round((microtime(true) - $scriptStart) * 1000000, 1);
            $_SESSION['tableD'] = $_SESSION['tableD'] . "
            <tr>
                <th>$checkResultText</th>
                <th>$x</th>
                <th>$y</th>
                <th>$r</th>
                <th>$curTime</th>
                <th>$scriptResultTime</th>
            </tr>";
            exit($_SESSION['tableD']);
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