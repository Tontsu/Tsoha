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
    <form action="muokkaus.php"><input type="submit" value="Muokkaa"></form></td>
    <td><button onclick="varmistus()">Poista</button></td>
    <?php } ?>
   </tr>
<?php } ?>
</table>
</html>
