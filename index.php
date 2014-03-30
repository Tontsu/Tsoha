<?php session_start();
include_once("kontrollerit/kirjautumiskontrolleri.php");
$kirjautumiskontrolleri = new Kirjautumiskontrolleri();
$kirjautumiskontrolleri->invoke();
include("nakymat/hakunakyma.php");
include("mallit/korttimalli.php");
include("kontrollerit/korttikontrolleri.php"); 

$kontrolleri = new Korttikontrolleri();
$kontrolleri->listaa($_REQUEST['mana'], $_REQUEST['hyokkays'], $_REQUEST['kesto']);
?>
