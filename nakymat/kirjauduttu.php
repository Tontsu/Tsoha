<?php session_start();
if(isset($_SESSION['admin'])) { ?>
<!DOCTYPE html>
<html>
<div align="right">
 <form action="logout.php"><label>Admin mode</label><input type="submit" value="Logout"></form>
</div>
</html>
<?php } ?>
