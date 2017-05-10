<?php

	/* Esta página solo se muestra cuando el login es incorrecto. */

	function connect(){
	global $mysqli;
	$mysqli = mysqli_connect("localhost", "root", "", "barwang");
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
  }
?>

<html>
	<head>
		<title>Iniciant sessió</title>
	</head>
	<body>
	<h2 style="color:#9F0000;">Introdueixi les seves dades, si us plau.</h2>
	<form method="post">
	<p>Nom: <input type=text name="nom_in" required></p>
	<p>Contrasenya: <input type="password" name="pass_in" required></p>
	<input type=submit name="IniciarSessio" value="Iniciar sessio">
	</form>
	<h5 style="color:red;">ERROR: Nom o contrasenya incorrectes.</h5>
	</body>
</html>

<?php

	if(isset ($_POST["IniciarSessio"])){
	connect();
	
	$nom_in=$_POST["nom_in"];
	$pass_in=$_POST["pass_in"];
	
	global $check_res1, $check_sql1, $check_res2, $check_sql2;
	
	$check_sql = "SELECT nombre FROM cliente WHERE nombre = '".$nom_in."' and contrasena = '".$pass_in."'";
	$check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
	
	
if (mysqli_num_rows($check_res)<1) {
		header("location: login_failure.php");
	}else{
		session_start();
		$_SESSION["nom_in"]=$_POST["nom_in"];
		
		if (!empty($_SESSION["nom_in"])) {
				header("location:perfil.php"); /* <--- Aquí TAMBIÉN se tiene que incluir el perfil del cliente. */
			}
	}
}

?>
