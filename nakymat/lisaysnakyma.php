<?php 
session_start();
if (isset($_SESSION['admin'])) {?>
<!DOCTYPE html>
<html>
<head>
	<title>Eeppisen korttikannan eeppinen lisäyssivu</title>
</head>
<body>
  	<form action="../index.php">
		<label>Nimi</label>
		<input type="text" name="lisaanimi">
		<label>Mana</label>
		<input type="number" name="lisaamana" min="0">
		<label>Hyokkays</label>
		<input type="number" name="lisaahyokkays" min="0">
		<label>Kesto</label>
		<input type="number" name="lisaakesto" min="0">
		<label>Ominaisuudet</label>
		<input type="text" name="liitaominaisuus">
		<input type="hidden" name="kohde" value="kortti">
		<input type="hidden" name="toiminto" value="lisays"> 
    		<div>
			<label>Ominaisuus</label>
    			<input type="text" name="lisaaominaisuus" placeholder="Ominaisuus">
		</div>
		<div>
			<button type="button" onclick="parent.location='../index.php'">Takaisin</button>
			<input type="submit" value="Lisää">
		</div>
    	</form>
</body>
</html>
<?php }?>
