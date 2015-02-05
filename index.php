<?php
session_start();
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(!isset($_SESSION['userid'])){
	echo'
	Jus esate neprisijunges.<br>
	<form method="post" action="auth.php">
	<input type="text" name="username" placeholder="Vartotojo vardas" />
	<input type="password" name="password" placeholder="Slaptazodis" />
	<input type="submit" value="Jungtis" />
	</form>
	';
}
else{
	echo 'Esate prisijunges, jusu ID: '.$_SESSION['userid'].'';
}
?>
