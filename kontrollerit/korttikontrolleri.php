<?php
/**
 * Kontrolleri, joka lähettää korttimallille tietoja.
 **/

class Korttikontrolleri {
	private $malli;

	function __construct() {
		$this->malli = new Korttimalli();
	}

	public function listaa() {
		$hakutulos = $this->malli->haeKortit($_REQUEST['mana'], $_REQUEST['hyokkays'], $_REQUEST['kesto'], htmlspecialchars($_REQUEST['lisaparametrit']));
		include("nakymat/listanakyma.php");
	}
	public function poista() {
		$this->malli->poistakortti($_REQUEST['kortti_id']);
	}
	public function lisaa() {
		if($_REQUEST['lisaaominaisuus'] != null) {
			$this->malli->lisaaOminaisuus(htmlspecialchars($_REQUEST['lisaaominaisuus']));
                }
		if($_REQUEST['lisaanimi'] != null) {
			$this->malli->lisaaKortti(htmlspecialchars($_REQUEST['lisaanimi']), $_REQUEST['lisaamana'], $_REQUEST['lisaahyokkays'], $_REQUEST['lisaakesto'], htmlspecialchars($_REQUEST['liitaominaisuus']));
		}
	}
	public function muokkaa() {
		$this->malli->muokkaaKorttia($_REQUEST['muokkausid'], $_REQUEST['muokkaamana'], $_REQUEST['muokkaahyokkays'], $_REQUEST['muokkaakesto'], htmlspecialchars($_REQUEST['muokkaaominaisuus']));
	}
}
?>
