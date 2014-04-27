<?php session_start();
include_once("mallit/kirjautumismalli.php");
/**
* Kontrolleri, joka hakee kirjautumismallilta tietoja ja päättää mitä niillä tehdään.
**/
class Kirjautumiskontrolleri {
 public $malli;
 public $tulos;
 
 public function __construct() {
  
  $this->malli = new Kirjautumismalli();
 }

 public function kirjaudu() {	
	
	if(!isset($_SESSION['admin'])) {
		$_SESSION['admin'] = $this->malli->haeKirjautumisenTila();
	} 
	if($_SESSION['admin'] == 'estetty') {
		$_SESSION['admin'] = null;
        	echo "<script type='text/javascript'>alert('Väärä käyttäjänimi tai salasana!')</script>";
	}
	
	if($_SESSION['admin'] == 'kirjauduttu') {
		include 'nakymat/kirjauduttu.php';
	}
	else {
		include 'nakymat/kirjautuminen.php';
	}
 }
}
?>

