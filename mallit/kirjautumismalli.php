<?php session_start();

/**
* Malli, joka tarkistaa kirjautumistiedot tietokannasta.
**/

 class Kirjautumismalli {
  /**
  * Funktio tarkistaa tietokannasta nimen ja salasanan, mikäli ne on syötetty kenttiin.
´ * Funktio palauttaa hyväksyttävän kirjautumisen, mikäli tiedot löytyvät kannasta. Muuten estää kirjautumisen.
  **/

  public function haeKirjautumisenTila() { 

   if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
	$kayttajat = $this->haeKayttajatKannasta();
	foreach ($kayttajat as $kayttaja) {
		if($_REQUEST['username']== $kayttaja->nimi && $_REQUEST['password'] == $kayttaja->salasana) {
			return 'kirjauduttu';
		}
	}
	return 'estetty';
   }
 }
 private function haeKayttajatKannasta() {
	$sql = "SELECT * FROM kayttajat";
	$tulos = $this->tietokantakysely($sql);
	return $tulos;
 }

 private function tietokantakysely($sql, $parametrit) {
 	include_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        return $tulos;
        }



}

?>
