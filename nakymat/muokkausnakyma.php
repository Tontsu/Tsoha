<?php session_start();
require ('../libs/varmistus.php');
if(isset($_SESSION['admin'])) { ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Eeppinen korttikantamuokkaus</title>
	</head>
	<body>
<div> 
	<table style ="width:100%">
 		<tr align="left" bgcolor='grey'>
  			<th>Nimi</th>
  			<th>Mana</th>
  			<th>Hyökkäys</th>
  			<th>Kesto</th>
  			<th>Ominaisuudet</th>
 		</tr>
 		<tr>
  			<form action="../index.php" method="POST" class="muokkaus_form">
  				<td><?php echo htmlspecialchars($_REQUEST['kortti_nimi']);?></td>
				<td><input type="number" name="muokkaamana" min="0" required="required" value="<?php echo $_REQUEST['kortti_mana'];?>"></td>
  				<td><input type="number" name="muokkaahyokkays" min="0" value="<?php echo $_REQUEST['kortti_hyokkays'];?>"></td>
  				<td><input type="number" name="muokkaakesto" min="0" value="<?php echo $_REQUEST['kortti_kesto'];?>"></td>
  				<td><input type="text" name="muokkaaominaisuus" placeholder="<?php echo $_REQUEST['kortti_ominaisuus'];?>"></td>
  				<input type="hidden" name="muokkausid" value="<?php echo $_REQUEST['kortti_id'];?>">
  				<input type="hidden" name="kohde" value="kortti">
  				<input type="hidden" name="toiminto" value="muokkaus">
  				<td><button class="muokkauspainike" type="submit">Muokkaa</button>
  			</form></td>
 		</tr>
	</table>
</div>
	<form action="../index.php"><input type="submit" value="Takaisin"></form>
</body>
</html>
<?php } ?>
