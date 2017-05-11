<?php 

	session_start();
	unset($_SESSION["nomS"]); 
	session_destroy();
	header('location: home.html'); 
	exit;
  
?>