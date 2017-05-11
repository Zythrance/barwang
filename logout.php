<?php 

/* Este archivo se utiliza para cerrar la sesión */

	session_start();
	unset($_SESSION["nomS"]); 
	session_destroy();
	header('location: home.html'); 
	exit;
  
?>
