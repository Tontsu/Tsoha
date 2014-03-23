<?php session_start(); ?>
<!DOCTYPE html>
<html>
<div>
<?php 
if ($_SESSION['admin']) { ?>
<?php include 'kirjauduttu.php'; ?>
<?php }
else { ?>
<?php include 'kirjautuminen.php'; ?>
<?php } ?>
</div>
<div>
<?php include 'haku.php'; ?>
</div>

</html>
