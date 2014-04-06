<?php
class Korttikontrolleri {
	private $malli;

	function __construct() {
		$this->malli = new Korttimalli();
	}

	public function listaa() {
		$hakutulos = $this->malli->haeKortit($_REQUEST['mana'], $_REQUEST['hyokkays'], $_REQUEST['kesto']);
		include("nakymat/listanakyma.php");
	}
	public function poista() {
		$this->malli->poistakortti($_REQUEST['kortti_id']);
	}
	public function lisaa() {
		$this->malli->lisaaKortti($_REQUEST['lisaanimi'], $_REQUEST['lisaamana'], $_REQUEST['lisaakesto'], $_REQUEST['lisaahyokkays']);
	}
	public function muokkaa() {
		$this->malli->muokkaaKorttia($_REQUEST['muokkausid'], $_REQUEST['muokkaamana'], $_REQUEST['muokkaahyokkays'], $_REQUEST['muokkaakesto']);
	}
}
?>
