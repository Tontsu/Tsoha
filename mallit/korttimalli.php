<?php
	/**
	* Tämä luokka hoitaa kortteihin liittyviä tietokantatoimintoja.
	**/ 
	class Korttimalli {
	
		private $parametrit = array();		
		
		/**
		* Apufunktioita hakukyselyn luomiseen. Funktioilla tarkistetaan, mitä parametreja käyttäjä on syöttänyt ja muokkaa hakulausetta niiden mukaan.
		**/
		 private function manatarkistus($mana) {
                        if($mana != null) {
                                array_push($this->parametrit, $mana);
                                $stringimana = " mana = ?";
                        }
                        return $stringimana;
                }
		
		private function hyokkaystarkistus($mana, $hyokkays) {
			if($hyokkays != null) {
                                array_push($this->parametrit, $hyokkays);
                                if($mana == null) {
                                        $stringihyokkays = " hyokkays = ?";
                                }
                                else {
                                        $stringihyokkays = " and hyokkays = ?";
                                }
                        }
			return $stringihyokkays;
		}
		private function kestotarkistus($mana, $hyokkays, $kesto) {
                        if($kesto != null) {
                                array_push($this->parametrit, $kesto);
                                if($mana == null && $hyokkays == null) {
                                        $stringikesto = " kesto = ?";
                                }
                                else {
                                        $stringikesto = " and kesto = ?";

                                }
                        }
			return $stringikesto;
                }
		private function ominaisuustarkistus($mana, $hyokkays, $kesto, $ominaisuus) {
		              if($ominaisuus != null) {
                                array_push($this->parametrit, $ominaisuus);
                                if($mana == null && $hyokkays == null && $kesto == null) {
                                        $stringiominaisuus = " UPPER(kuvaus) = UPPER(?)";
                                }
                                else {
                                        $stringiominaisuus = " and UPPER(kuvaus) = UPPER(?)";

                                }
                        }
                        return $stringiominaisuus;
		}
		private function wheretarkistus ($mana, $hyokkays, $kesto, $ominaisuus) {
			if($mana != null or $hyokkays != null or $kesto != null or $ominaisuus != null) {
                                $where = " WHERE";
                        }
				return $where;
		}
		/**
		* Hakee annetuilla parametreilla kortteja tietokannasta.
		**/
		public function haeKortit($mana, $hyokkays, $kesto, $ominaisuus) {
				
			$where = $this->wheretarkistus($mana, $hyokkays, $kesto, $ominaisuus);	
			$stringimana = $this->manatarkistus($mana);
			$stringihyokkays = $this->hyokkaystarkistus($mana, $hyokkays);
			$stringikesto = $this->kestotarkistus($mana, $hyokkays, $kesto);
			$stringiominaisuus = $this->ominaisuustarkistus($mana, $hyokkays, $kesto, $ominaisuus);
			
			$sql = "SELECT distinct kortit.id, nimi, mana, hyokkays, kesto, 
			array_to_string(array(SELECT distinct kuvaus FROM ominaisuudet 
			INNER JOIN kortinOminaisuus ON kortit.id = kortinOminaisuus.korttiId 
			WHERE kortinOminaisuus.ominaisuusId = ominaisuudet.id), ', ') 
			AS ominaisuudet FROM kortit 
			INNER JOIN kortinOminaisuus ON kortit.id = kortinOminaisuus.korttiId 
			INNER JOIN ominaisuudet ON kortinOminaisuus.ominaisuusId = ominaisuudet.id".$where.$stringimana.$stringihyokkays.$stringikesto.$stringiominaisuus;			
			$tulos = $this->tietokantakysely($sql, $this->parametrit);
			return $tulos;
		}
		/**
		* Poistaa tietokannasta parametrina annetun kortin.
		**/
		public function poistaKortti($id) {
			$this->poistaKortiltaOminaisuudet($id);
			$parametrit = array(&$id);
			$sql = "DELETE FROM kortit WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);
		}
		/**
		* Poistaa kortilta kaikki ominaisuudet.
		**/
		private function poistaKortiltaOminaisuudet($kortti_id) {
			$parametrit = array(&$kortti_id);
			$sql = "DELETE FROM kortinOminaisuus WHERE korttiid = ?";
			$this->tietokantakysely($sql, $parametrit);
		}
		/**
		* Funktio kortin lisäämiseen tietokantaan. Tarkistaa onko kortille syötetty ominaisuuksia, vai lisätäänkö kortti tyhjillä ominaisuuksilla.
		**/
		public function lisaaKortti($nimi, $mana, $hyokkays, $kesto, $ominaisuus) {
			if($ominaisuus == null) {
				$this->lisaaKorttiTietokantaan($nimi, $mana, $hyokkays, $kesto);
				$kortti_id = $this->haeKortinId($nimi);
				$this->liitaKorttiOminaisuuteen($kortti_id, 1);
			}
			else {
				$ominaisuus_id = $this->haeOminaisuudenId($ominaisuus);
				if($ominaisuus_id != null) {
					$this->lisaaKorttiTietokantaan($nimi, $mana, $hyokkays, $kesto);
                                	$kortti_id = $this->haeKortinId($nimi);
					$this->liitaKorttiOminaisuuteen($kortti_id, $ominaisuus_id);
				} 
			}
		}
		/**
		* Tekee tietokantapyynnön kortin lisäämiseksi.
		**/
		private function lisaaKorttiTietokantaan($nimi, $mana, $hyokkays, $kesto) {
			$parametrit = array(&$nimi, &$mana, &$hyokkays, &$kesto);
                        $sql = "INSERT INTO kortit (nimi, mana, hyokkays, kesto) VALUES (?, ?, ?, ?)";
                        try {
				$this->tietokantakysely($sql, $parametrit);
			}
			catch (Exception $e) {
				echo "<script>alert('Et antanut tarvittavia tietoja. Lisäys epäonnistui.')</script>";
			}
		}
		
		/**
		* Apufunktio kortin id:n selvittämiseksi nimellä.
		**/
		private function haeKortinId($nimi) {
			$parametrit = array(&$nimi);
			$sql = "SELECT id FROM kortit WHERE nimi = ?";
			$tulos = $this->tietokantakysely($sql, $parametrit);
			return $tulos[0]->id;
		}
		/**
		* Funktio, jolla muokataan kortin tietoja.
		**/
		public function muokkaaKorttia($id, $mana, $hyokkays, $kesto, $ominaisuus) {
			$parametrit = array(&$mana, &$hyokkays, &$kesto, &$id);
			$sql = "UPDATE kortit SET mana = ?, hyokkays = ?, kesto = ? WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);	
			if($ominaisuus != null) {
				$ominaisuus_id = $this->haeOminaisuudenId($ominaisuus);
				if($ominaisuus_id != null) {
					$this->liitaKorttiOminaisuuteen($id, $ominaisuus_id);
				}
			}
		}
		/**
		* Funktio, joka tarkistaa onko kortille asetettu ominaisuuksia.
		**/
		private function onkoKortillaOminaisuuksia($kortti_id) {
			$parametrit = array($kortti_id);
			$sql = "SELECT * FROM kortinOminaisuus WHERE korttiid = ? AND ominaisuusid = 1";
			$tulos = $this->tietokantakysely($sql, $parametrit);
			if($tulos[0] != null) {
				return true;
			}
			else {
				return false;
			}	
		}
		/**
		* Funktio, jolla lisätään ominaisuuksia ominaisuustauluun.
		**/
		public function lisaaOminaisuus($ominaisuus) {
			$parametrit = array(&$ominaisuus);
			$sql = "INSERT INTO ominaisuudet (kuvaus) VALUES (?)";
			$this->tietokantakysely($sql, $parametrit);
		}
		/**
		* Funktio, jolla liitetään ominaisuus korttiin.
		**/
		private function liitaKorttiOminaisuuteen($kortti_id, $ominaisuus_id) {
			if($this->onkoKortillaOminaisuuksia($kortti_id)) {
				$this->poistaKortiltaOminaisuudet($kortti_id);
			}
			$parametrit = array(&$kortti_id, &$ominaisuus_id);        
                        $sql = "INSERT INTO kortinOminaisuus (korttiid, ominaisuusid) VALUES (?, ?)";
			$this->tietokantakysely($sql, $parametrit);
		}
		/**
		* Apufunktio, jolla haetaan ominaisuuden id kannasta ominaisuuden nimellä.
		**/
		private function haeOminaisuudenId($ominaisuus) {
			$parametrit = array(&$ominaisuus);
			$sql = "SELECT id from ominaisuudet WHERE UPPER(kuvaus) = UPPER(?)";
			$tulos = $this->tietokantakysely($sql, $parametrit);
			if($tulos != null ){
				return $tulos[0]->id;
			}
			else echo "<script type='text/javascript'>alert('Ominaisuutta ei löytynyt. Lisäys epäonnistui.')</script>";
		
		}
		
		private function tietokantakysely($sql, $parametrit) {
			include_once 'libs/tietokantayhteys.php';
                        $kysely = getTietokantayhteys()->prepare($sql);
                        $kysely->execute($parametrit);
                        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
                        return $tulos;
                }	
			
	}
?>
