<?php 
session_start();
if (isset($_SESSION['admin'])) {?>
<!DOCTYPE html>
<html>
  	<form action="../index.php">
		<label>Nimi</label>
		<input type="text" name="lisaanimi" required="required">
		<label>Mana</label>
		<input type="number" name="lisaamana" min="0" required="required">
		<label>Hyokkays</label>
		<input type="number" name="lisaahyokkays" min="0" required="required">
		<label>Kesto</label>
		<input type="number" name="lisaakesto" min="0" required="required">
		<label>Ominaisuudet</label>
		<input type="text" placeholder="Ominaisuudet">
		<input type="hidden" name="kohde" value="kortti">
		<input type="hidden" name="toiminto" value="lisays"> 
    		<div>
		<label>Ominaisuus</label>
    		<input type="Ominaisuus" placeholder="Ominaisuus">
		</div>
		<div>
		<button type="button" onclick="parent.location='../index.php'">Takaisin</button>
		<input type="submit" value="Lisää">
		</div>
    	</form>
</html>
<?php }?>
