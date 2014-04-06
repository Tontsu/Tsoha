<?php include_once ("libs/varmistus.php"); ?>
<!DOCTYPE html>
<html>
<table style ="width:100%">
 <tr align="left" bgcolor='grey'>
  <th>Nimi</th>
  <th>Mana</th>
   <th>Hyökkäys</th>
   <th>Kesto</th>
   <th>Ominaisuudet</th>
   </tr>
   <?php foreach ($hakutulos as $kortti) { ?>
   <tr>
   <td> <?php echo $kortti->nimi; ?> </td>
   <td> <?php echo $kortti->mana; ?> </td>
   <td> <?php echo $kortti->hyokkays; ?></td>
   <td> <?php echo $kortti->kesto; ?></td>
   <td></td>
   <td>
  <?php if($_SESSION['admin'] == 'login') {?>
    	<form action="nakymat/muokkausnakyma.php" method="POST">
	<input type="hidden" name="kohde" value="kortti">
	<input type="hidden" name="toiminto" value="muokkaus">
	<input type="hidden" name="kortti_id" value="<?php echo $kortti->id; ?>">
	<input type="hidden" name="kortti_nimi" value="<?php echo $kortti->nimi; ?>">
	<input type="hidden" name="kortti_mana" value="<?php echo $kortti->mana; ?>">
	<input type="hidden" name="kortti_hyokkays" value="<?php echo $kortti->hyokkays; ?>">
	<input type="hidden" name="kortti_kesto" value="<?php echo $kortti->kesto; ?>">
	<input type="submit" value="Muokkaa">	
	</form></td>
    	<td>
	<form action="../index.php" method="POST" class="poisto_form">
	<input type="hidden" name="kortti_id" value="<?php echo $kortti->id; ?>">
	<input type="hidden" name="kohde" value="kortti">
	<input type="hidden" name="toiminto" value="poisto">
	<button  class="poisto_painike" type="submit">Poista</button>
	</form>
	</td>
    <?php } ?>
   </tr>
<?php } ?>
</table>
</html>
