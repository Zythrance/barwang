<?php		
//conexxion
session_start();
		  if (! empty($_SESSION["nom_in"])) 
  {
    echo "<a href='logout.php' title='Cerrar sesión'>Log out?</a> Bienvenido Sir/Sra " . $_SESSION["nom_in"];
  }

	function connect(){
	global $mysqli;
	$mysqli = mysqli_connect("localhost", "root", "", "Barwang");
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
  }
?>

<html>
  <head>
  
  <title>CLUB BARWANG</title>
  <meta charset="utf8">
  </head>
  
  <body>
</form>
				
				<h2>Detalle de la compra</h2>
                  
			<table border>
             <tr>
             <td>IDART</td>
			 <td>Nom</td>
			 <td>Descripción</td>
			 <td>Precio</td>
			 <td>Talla</td>
			 <td>Cantidad</td>
			 <td>Precio Total</td>
			 <td>Fecha</td>
			</tr>
			 
				<?php 
					connect();
					$sesion=$_SESSION['nom_in'];
					$select = 'select articulo.IDART,articulo.Nom, articulo.descripcion, articulo.precio,compra.talla, compra.cantidad, articulo.precio*compra.cantidad, compra.fecha from articulo inner join compra ON compra.articulo=articulo.IDART  where cliente =(select codigo from cliente  where Nom="'.$sesion.'") ';
					$resultado = mysqli_query($mysqli, $select);
				
					if (mysqli_num_rows($resultado) < 1){
					echo "No has hecho ninguna compra aun.";
					} else {
							while ($fila = mysqli_fetch_array($resultado)) { 
                  
							echo("<tr><td>" .$fila["IDART"]."</td>");
							echo("<td>" .$fila["Nom"]."</td>");
							echo("<td>" .$fila["descripcion"]."</td>");
							echo("<td>" .$fila["precio"]."</td>"); 
							echo("<tr><td>" .$fila["Talla"]."</td>");
							echo("<td>" .$fila["cantidad"]."</td>");
							echo("<td>" .$fila["articulo.precio*compra.cantidad"]."</td>");
							echo("<td>" .$fila["Fecha"]."</td>");
							
						echo("</tr></td>");				
							}
							}
						echo " Compra tu producto nuevo <a href='compra.php' title='compra'>aqui!</a><br> "; 
						
                 ?>
			</table>
			<h2>Tus datos</h2>
                  
			<table border>
             <tr>
             <td>Codigo</td>
			 <td>Nom</td>
			 <td>Apellidos</td>
			 <td>Ciudad</td>
			 <td>Correo</td>
			 <td>Telefono</td>
			 <td>Cuenta</td>
			</tr>
			<?php 
					connect();
					$sesion=$_SESSION['nomS'];
					$select = 'select cliente.IDART,cliente.Nom, cliente.apellidos, cliente.ciudad,cliente.correo, socio.telefono, socio.cuenta from cliente inner join socio ON socio.Cod_soci=cliente.codigo  where Cod_soci =(select codigo from cliente  where Nom="'.$sesion.'") ';
					$resultado = mysqli_query($mysqli, $select);
				
					
						while ($fila = mysqli_fetch_array($resultado)) { 
                  
							echo("<tr><td>" .$fila["Codigo"]."</td>");
							echo("<td>" .$fila["Nom"]."</td>");
							echo("<td>" .$fila["Apellidos"]."</td>");
							echo("<td>" .$fila["Ciudad"]."</td>"); 
							echo("<tr><td>" .$fila["Correo"]."</td>");
							echo("<td>" .$fila["Telefono"]."</td>");
							echo("<td>" .$fila["Cuenta"]."</td>");
							echo("<td>" .$fila[""]."</td>");
							
						echo("</tr></td>");				
							}
							
						echo " Completa tu perfil <a href='compra.php' title='compra'>aqui!</a><br> "; 
						
                 ?>
            </table>
  </body>
</html>