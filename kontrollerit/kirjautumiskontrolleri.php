<?php session_start();
include_once("mallit/kirjautumismalli.php");

class Kirjautumiskontrolleri {
 public $malli;
 public $tulos;
 
 public function __construct() {
  
  $this->malli = new Kirjautumismalli();
 }

 public function invoke() {	
	
	if(!isset($_SESSION['admin'])) {
		$_SESSION['admin'] = $this->malli->getlogin();
	} 
	if($_SESSION['admin'] == 'invaliidi useri') {
		$_SESSION['admin'] = null;
        	echo "<script type='text/javascript'>alert('Väärä käyttäjänimi tai salasana!')</script>";
	}
	
	if($_SESSION['admin'] == 'login') {
		include 'nakymat/kirjauduttu.php';
	}
	else {
		include 'nakymat/kirjautuminen.php';
	}
 }
}
?>

