<?php 
	class Korttimalli {
	
			
		public function haeKortit($mana, $hyokkays, $kesto) {
			
			$parametrit = array();
			
			if($mana != null) {
				array_push($parametrit, &$mana);
				$stringimana = " mana = ?";
			}
			if($hyokkays != null) {
				array_push($parametrit, &$hyokkays);
				if($mana == null) {
					$stringihyokkays = " hyokkays = ?";
				}
				else {
					$stringihyokkays = " and hyokkays = ?";
				}
			}
			if($kesto != null) {
				array_push($parametrit, &$kesto);
				if($mana == null && $hyokkays == null) {
					$stringikesto = " kesto = ?";
				}
				else {
					$stringikesto = " and kesto = ?";
				
				}
			}
			$sql = "SELECT * FROM kortit WHERE ".$stringimana.$stringihyokkays.$stringikesto;			
			$tulos = $this->tietokantakysely($sql, $parametrit);
			return $tulos;
		}
		public function poistaKortti($id) {
			$parametrit = array(&$id);
			$sql = "DELETE FROM kortit WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);
		}
		public function lisaaKortti($nimi, $mana, $hyokkays, $kesto) {
			$parametrit = array(&$nimi, &$mana, &$hyokkays, &$kesto);
			$sql = "INSERT INTO kortit (nimi, mana, hyokkays, kesto) VALUES (?, ?, ?, ?)";
			$this->tietokantakysely($sql, $parametrit);
		}
		public function muokkaaKorttia($id, $mana, $hyokkays, $kesto) {
			$parametrit = array(&$mana, &$hyokkays, &$kesto, &$id);
			$sql = "UPDATE kortit SET mana = ?, hyokkays = ?, kesto = ? WHERE id = ?";
			$this->tietokantakysely($sql, $parametrit);
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
