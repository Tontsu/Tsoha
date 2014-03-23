<?php
require ('libs/varmistus.php')?>
<!DOCTYPE html>
<html>
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
  <td><input type="number" min="0" placeholder="0"></td>
  <td><input type="number" min="0" placeholder="1"></td>
  <td><input type="number" min="0" placeholder="1"></td>
  <td><input type="text" placeholder=""></td>
  <td><button onclick="varmistus()">Muokkaa</button></td>
 </tr>
</table>
</div>
<form action="index.php"><input type="submit" value="Takaisin"></form>
</html>
