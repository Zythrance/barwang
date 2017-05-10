<?php

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
		<title>Registre</title>
	</head>
	<body>
		<h2 style="color:#9F0000;">Introdueixi les seves dades per completar el registre.</h2>
		<h5 style="color:#9F0000;">(en lo possible intenti no fer servir apòstrofs)</h5>
		
	<form method="post">
	<p>Nom: <input type="text" name="nombre" required></p>
	<p>Cognom: <input type="text" name="apellidos" required></p>
	<p>Ciutat: <input type="text" name="ciudad" required></p>
	<p>Correu electrònic: <input type="email" name="correo" required></p>
	
	<label for="formapago">Forma de pagament:</label>
	<br>
	<select id="formapago" name="formapago" size="1" required>
		<option value="" selected>- Selecciona -</option>
		<option value="paypal">PayPal</option>
		<option value="VISA">VISA</option>
		<option value="mastercard">Mastercard</option>
	</select>
	</br>
	<p>Contrasenya: <input type="password" name="contrasena" required></p>
	<input type="submit" name="Registrarse" value="Registrarse">
	<br>
	</form>
	</body>
</html>
	
<?php

	if(isset($_POST["Registrarse"])) {
	connect();
	
	$nombre=$_POST["nombre"];
	$apellidos=$_POST["apellidos"];
	$ciudad=$_POST["ciudad"];
	$correo=$_POST["correo"];
	$formapago=$_POST["formapago"];
	$contrasena=$_POST["contrasena"];
	
	global $check_res, $res;
			$check_sql = "SELECT nombre FROM cliente WHERE nombre = '".$nombre."'";
			$check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
	
	if (mysqli_num_rows($check_res) < 1) {
			$insertar = "INSERT INTO cliente (nombre,apellidos,ciudad,correo,formapago,contrasena) VALUES ('$nombre', '$apellidos', '$ciudad', '$correo', '$formapago', '$contrasena')";
			$res = mysqli_query($mysqli, $insertar);
		
			echo "Registrat correctament!<br>";
			echo "<a href='home.html'>Fes click aquí per tornar a la página principal.</a>";
		
		}else{
			echo "Aquest usuari ya esta registrat!";
		}

	}

?>
