<?php 
	class Korttimalli {
		
		public function haeKortit($mana, $hyokkays, $kesto) {
			require 'libs/tietokantayhteys.php';
			$yhteys = getTietokantayhteys();
			$sql = "SELECT * from kortit where mana = $mana";
			$kysely = getTietokantayhteys()->prepare($sql);
			$kysely->execute();

			$tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
			return $tulos;
		}
	}
?>
