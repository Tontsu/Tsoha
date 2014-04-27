<?php session_start();
include_once("kontrollerit/kirjautumiskontrolleri.php");
$kirjautumiskontrolleri = new Kirjautumiskontrolleri();
$kirjautumiskontrolleri->kirjaudu();
include("mallit/korttimalli.php");
include("nakymat/hakunakyma.php");
include("kontrollerit/korttikontrolleri.php"); 

	if(isset($_REQUEST['kohde'])) {	
		if($_REQUEST['kohde'] == 'kortti') {
			$kontrolleri = new Korttikontrolleri();
			if($_REQUEST['toiminto'] == 'poisto') {
				$kontrolleri->poista();
			}
			if($_REQUEST['toiminto'] == 'haku') {
				$kontrolleri->listaa();
			}
			if($_REQUEST['toiminto'] == 'lisays') {
				$kontrolleri->lisaa();
			}
			if($_REQUEST['toiminto'] == 'muokkaus') {
				$kontrolleri->muokkaa();
			}
		}
	}	
	
?>
