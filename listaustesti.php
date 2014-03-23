<?php
	require 'libs/tietokantayhteys.php';
	$yhteys = getTietokantayhteys();
	$sql = "SELECT nimi from kortit";
	$kysely = getTietokantayhteys()->prepare($sql);
	$kysely->execute();

	$tulokset = array();
	foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
	  $tulokset[] = $tulos->nimi;
	}
	
	?><!DOCTYPE HTML>
	<html>
	 <head><title>Eeeppisen korttitietokannan testi</title></head>
	  <body>
	   <h1>Listaelementtitesti</h1>
	    <ul>
	     <?php foreach($tulokset as $asia) { ?>
	       <li><?php echo $asia; ?></li>
		<?php } ?>
	     </ul>
	   </body>
         </html>
