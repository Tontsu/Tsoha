<?php 
	class Korttimalli {
	
		private $parametrit = array();		
		
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
                                        $stringiominaisuus = " kuvaus = ?";
                                }
                                else {
                                        $stringiominaisuus = " and kuvaus = ?";

                                }
                        }
                        return $stringiominaisuus;
		}
			
		public function haeKortit($mana, $hyokkays, $kesto, $ominaisuus) {
				
			if($mana != null or $hyokkays != null or $kesto != null or $ominaisuus != null) {
				$where = " WHERE";
			}	
			$stringimana = $this->manatarkistus($mana);
			$stringihyokkays = $this->hyokkaystarkistus($mana, $hyokkays);
			$stringikesto = $this->kestotarkistus($mana, $hyokkays, $kesto);
			$stringiominaisuus = $this->ominaisuustarkistus($mana, $hyokkays, $kesto, $ominaisuus);
			
			$sql = "SELECT distinct kortit.id, nimi, mana, hyokkays, kesto, array_to_string(array(select distinct kuvaus FROM ominaisuudet inner join kortinOminaisuus on kortit.id = kortinOminaisuus.korttiId inner join kortit on kortinOminaisuus.ominaisuusId = kortit.id where kortinOminaisuus.ominaisuusId = ominaisuudet.id), ', ') as ominaisuudet FROM kortit inner join kortinOminaisuus on kortit.id = kortinOminaisuus.korttiId inner join ominaisuudet on kortinOminaisuus.ominaisuusId = ominaisuudet.id".$where.$stringimana.$stringihyokkays.$stringikesto.$stringiominaisuus;			
			$tulos = $this->tietokantakysely($sql, $this->parametrit);
			return $tulos;
		}
		public function poistaKortti($id) {
			$parametrit = array(&$id);
			$sql = "DELETE FROM kortit WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);
		}
		public function lisaaKortti($nimi, $mana, $hyokkays, $kesto, $ominaisuus) {
			$parametrit = array(&$nimi, &$mana, &$hyokkays, &$kesto);
			$sql = "INSERT INTO kortit (nimi, mana, hyokkays, kesto) VALUES (?, ?, ?, ?)";
			$this->tietokantakysely($sql, $parametrit);
			$kortinId = $this->haeKortinId($nimi);
			if($ominaisuus == null) {
				$this->liitaKorttiOminaisuuteen($kortinId, 1);
			}
			else {
				$this->liitaKorttiOminaisuuteen($kortinId, $this->haeOminaisuudenId($ominaisuus));
			}
		}
		
		private function haeKortinId($nimi) {
			$parametrit = array(&$nimi);
			$sql = "SELECT id FROM kortit WHERE nimi = ?";
			$tulos = $this->tietokantakysely($sql, $parametrit);
			return $tulos[0]->id;
		}
		public function muokkaaKorttia($id, $mana, $hyokkays, $kesto, $ominaisuus) {
			$parametrit = array(&$mana, &$hyokkays, &$kesto, &$id);
			$sql = "UPDATE kortit SET mana = ?, hyokkays = ?, kesto = ? WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);	
			if($ominaisuus != null) {
				$ominaisuudenId = $this->haeOminaisuudenId($ominaisuus);
				$this->liitaKorttiOminaisuuteen($id, $ominaisuudenId);
			}
		}
		public function lisaaOminaisuus($ominaisuus) {
			$parametrit = array(&$ominaisuus);
			$sql = "INSERT INTO ominaisuudet (kuvaus) VALUES (?)";
			$this->tietokantakysely($sql, $parametrit);
		}
		private function liitaKorttiOminaisuuteen($id, $ominaisuus) {
                        $parametrit = array(&$id, &$ominaisuus);        
                        $sql = "INSERT INTO kortinOminaisuus (korttiid, ominaisuusid) VALUES (?, ?)";
			$this->tietokantakysely($sql, $parametrit);
		}
		private function haeOminaisuudenId($ominaisuus) {
			$parametrit = array(&$ominaisuus);
			$sql = "SELECT id from ominaisuudet WHERE kuvaus = ?";
			$tulos = $this->tietokantakysely($sql, $parametrit);
			if($tulos != null ){
				return $tulos[0]->id;
			}
			else echo("Ei löytyny");
		
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
