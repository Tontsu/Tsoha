<?php session_start();

 class Kirjautumismalli {

  public function getlogin() { 

   if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
	if($_REQUEST['username']=='admin' && $_REQUEST['password'] =='admin') {
		return 'login';
	}
	else {
		return 'invaliidi useri';
	}
   }
 }
}

?>
