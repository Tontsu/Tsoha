<?php session_start();
$_SESSION['admin'] = true;
header('Location: http://tonjudin.users.cs.helsinki.fi/index.php');
die();
?>
