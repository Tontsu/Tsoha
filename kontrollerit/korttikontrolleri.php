<?php
class Korttikontrolleri {
	private $malli;

	function __construct() {
		$this->malli = new Korttimalli();
	}

	public function listaa($mana, $hyokkays, $kesto) {
		$hakutulos = $this->malli->haeKortit($mana, $hyokkays, $kesto);
		include("nakymat/listanakyma.php");
	}
}
?>
