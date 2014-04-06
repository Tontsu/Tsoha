<?php session_start();?>

<!DOCTYPE html>
<html>
<form action="../index.php" method ="POST">
	<label>Mana</label>
	<input id ="mana" name="mana" type="number" min="0"/>
	<label>Hyokkays</label>
	<input id ="hyokkays" name="hyokkays" type="number" min="0"/>
	<label>Kesto</label>
	<input id ="kesto" name="kesto" type="number" min="0"/>
	<label>Lisäparametrit</label>
	<input id ="lisaparametrit" name="lisaparametrit" type="text" placeholder="Ei toimi vielä"/>
  	<input type="hidden" name ="kohde" value="kortti">
	<input type="hidden" name ="toiminto" value="haku">
	<button type="submit" name="hae"><span>Hae</span></button>
</form>
 <?php if($_SESSION['admin'] == 'login') {?>
 <form action="nakymat/lisaysnakyma.php"><input type="submit" value="Lisää"></form>
 <?php } ?>
</html>
