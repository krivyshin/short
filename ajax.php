<?php
require_once 'Shortener.php';
$s = new Shortener;

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    if ($code = $s->makeCode($url)) {
        $adres = "http://".$_SERVER['SERVER_NAME'];
        echo "Сгенирировано! Ваш короткий URL: <a href='".$adres."/".$code."'>".$adres."/".$code."</a>";
    } 
    else {
        echo "Возникла проблема. Неверный URL";
    }
} 
?>
