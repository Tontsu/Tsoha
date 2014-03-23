<?php session_start();
require ('libs/varmistus.php')?>

<!DOCTYPE html>
<html>
    <label>Mana</label>
    <input type="number" min="0" placeholder="Mana">
    <label>Hyokkays</label>
    <input type="number" min="0" placeholder="Hyökkäys">
    <label>Kesto</label>
    <input type="number" min="0"  placeholder="kesto">
    <label>Lisäparametrit</label>
    <input type="text" placeholder="Lisäparametrit">
    <input type="submit" value="Hae">
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
   <td>Wispi</td>
   <td>0</td>
   <td>1</td>
   <td>1</td>
   <td></td>
   <td>
    <?php if($_SESSION['admin']) {?>
    <form action="muokkaus.php"><input type="submit" value="Muokkaa"></form></td>
    <td><button onclick="varmistus()">Poista</button></td>
    <?php } ?>
   </tr>
  </table>
 </div>
 <?php if($_SESSION['admin']) {?>
 <form action="lisaa.php"><input type="submit" value="Lisää"></form>
 <?php } ?>
</html>
