<?php session_start();
if(isset($_SESSION['admin'])) { ?>
<!DOCTYPE html>
<html>
<head>
	<title>Eeppisen korttikannan adminisivu</title>
</head>
<body>
	<div align="right">
 		<form action="../mallit/uloskirjautuminen.php"><label>Admin mode</label><input type="submit" value="Logout"></form>
	</div>
</body>
</html>
<?php } ?>
