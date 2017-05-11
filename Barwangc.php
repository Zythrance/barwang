<?php		
//conexxion
session_start();
		  if (! empty($_SESSION["nom_in"])) {
			  $sesion=$_SESSION['nom_in'];
    echo "<a href='logout.php' title='Cerrar sesión'>Log out?</a> Bienvenido Sir/Sra " . $sesion;
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
				<h2>Catalogo de articulos</h2>
            
				 <h4>Mueble Grande XXL</h4>
				  <form method="post" >
				 <img class="camiseta" src="muebleGrande.jpg" alt="camiseta"><br>
				 
				 Talla:<input  type='radio' name='talla1' value='s' checked><input  type='submit' name='comprar1' value='comprar'> <br>
				       <input  type='radio' name='talla1' value='m'>
					   <input  type='radio' name='talla1' value='l'>
					   
					   <select name="talla1"><option selected> elige talla </option>
					   <option>s</option>
					   <option>m</option>
					   <option>l</option>
					   </select>
				 Unidades:<input  type='number' name='numero1' value='numero' required><input  type='submit' name='comprar1' value='comprar'> <br>
				 <select name="talla1"><option selected> forma de pago </option>
					   <option>contado</option>
					   <option>visa</option>
					   <option>adeudo</option>
					   </select>
				 </form>
				 <?php //boton1
					connect();
			
		if(isset ($_POST["comprar1"])){
				$sesion=$_SESSION['nom_in'];
				$unidades=$_POST['numero1'];
				$talla=$_POST[''];	
                $fpago=$_POST[''];				
	        
			if($talla='s'){
			$checkStock = "select stock_s from articulo where IDART=1";
			$stockRes = mysqli_query($mysqli, $checkStock);		
			}
			if($talla='m'){
			$checkStock = "select stock_m from articulo where IDART=1";
			$stockRes = mysqli_query($mysqli, $checkStock);
		    }
		    if($talla='l'){
			$checkStock = "select stock_l from articulo where IDART=1";
			$stockRes = mysqli_query($mysqli, $checkStock);
		    }
		
		   
		
		
			if ($checkStock < $unidades) {
				echo "No hay stock de este producto, sentimos las molestias.";
		} else {
				$hoy = date('Ymd');
					echo "Gracias por su compra! <br>";
					
			$selectID = "select codigo from cliente where nombre = '".$sesion."'";
			$idcliente = intval(mysqli_query($mysqli, $selectID));
			//echo $idcliente;
			
			$selectComprar1 = "insert into compra(fecha,cliente,articulo,talla,cantidad,forma_pago) values ('$hoy','$idcliente','1','$talla','$unidades','$fpago')";
			$selectComprarT = mysqli_query($mysqli, $selectComprar1);
			//echo $selectComprar1; 
			
			$update1 = "UPDATE articulo SET stock_s=stock_s-".$unidades." where IDART=1 AND talla='s'";
			$update1 = "UPDATE articulo SET stock_s=stock_m-".$unidades." where IDART=1 AND talla='m'";
			$update1 = "UPDATE articulo SET stock_s=stock_l-".$unidades." where IDART=1 AND talla='l'";
			$resUpdate1 = mysqli_query($mysqli, $update1);	
		}	
				
			}
			?>
				 
				 <form method="post" >
				 <h4>muebleMedioGrande XL</h4>
				 <img class="muebleGrande" src="muebleMedioGrande.jpg" alt="muebleMedioGrande"><br>
				 Unidades:<input  type='number' name='numero2' value='numero' required><input  type='submit' name='comprar2' value='comprar'> <br>
				 </form>
				 
				 <?php //boton2
					connect();
		if(isset ($_POST["comprar2"])){
				$sesion=$_SESSION['nomS'];
				$unidades=$_POST['numero2'];
		
				$checkStock2 = "select stock from mueble where id_mueble=1";
				$resStock2=mysqli_query($mysqli, $checkStock2);
		
				if (mysqli_num_rows($resStock2) < 1) {
			echo "No hay stock de este producto, sentimos las molestias.";
			
				} else {
					
				$hoy = date('Ymd');
					echo "Gracias por su compra! <br>";
			$selectID = "select codigo from cliente where nombre = '".$sesion."'";
			$idcliente = intval(mysqli_query($mysqli, $selectID));	
	
			$selectComprar2 = "insert into compra(fecha,cliente,mueble,cantidad) values ('$hoy','$idcliente','1','$unidades')";
			mysqli_query($mysqli, $selectComprar2);
			
			$update2 = "UPDATE mueble SET stock=stock-".$unidades." where id_mueble=1";
			$resUpdate2 = mysqli_query($mysqli, $update2);	
		}	
				
			}
			?>
				 
				 
				 <form method="post" >
				 <h4>Mueble Mediano L</h4>
				 <img class="muebleGrande" src="muebleMediano.jpg" alt="muebleMedioGrande"><br>
				 Unidades:<input  type='number' name='numero3' value='numero' required><input  type='submit' name='comprar3' value='comprar'> <br>
				 </form>
				 
				 <?php //boton3
		if(isset ($_POST["comprar3"])){
				$sesion=$_SESSION['nomS'];
				$unidades=$_POST['numero3'];
		
				$checkStock3 = "select stock from mueble";
				mysqli_query($mysqli, $checkStock3);
		
				if (mysqli_num_rows($checkStock3) < 1) {
				echo "No hay stock de este producto, sentimos las molestias.";
		} else {
				$hoy = date('Ymd');
					echo "Gracias por su compra! <br>";
			$selectID = "select codigo from cliente where nombre = '".$sesion."'";
			$idcliente = intval(mysqli_query($mysqli, $selectID));	
			
			$selectComprar3 = "insert into compra(fecha,cliente,mueble,cantidad) values ('$hoy','$idcliente','1','$unidades')";
			mysqli_query($mysqli, $selectComprar3);
			
			$update3 = "UPDATE mueble SET stock=stock-".$unidades." where id_mueble=3";
			$resUpdate3 = mysqli_query($mysqli, $update3);	
		}	
				
			}
			?>
				 
				 <form method="post" >
				 <h4>Mueble Pequeño M</h4>
				 <img class="muebleGrande" src="mueblePequeno.jpg" alt="muebleMedioGrande"><br>
				 Unidades:<input  type='number' name='numero4' value='numero' required><input  type='submit' name='comprar4' value='comprar'> <br>
				 </form>
				 
				 <?php //boton4
				if(isset ($_POST["comprar4"])){
				$sesion=$_SESSION['nomS'];
				$unidades=$_POST['numero4'];
		
				$checkStock4 = "select stock from mueble where id_mueble=4";
				$resStock4=mysqli_query($mysqli, $checkStock4);
		
				if (mysqli_num_rows($checkStock4) < 1) {
				echo "No hay stock de este producto, sentimos las molestias.";
				} else {
					
				$hoy = date('Ymd');
				
				echo "Gracias por su compra! <br>";
			$selectID = "select codigo from cliente where nombre = '".$sesion."'";
			$idcliente = intval(mysqli_query($mysqli, $selectID));	
				
			$selectComprar4 = "insert into compra(fecha,cliente,mueble,cantidad) values ('$hoy','$idcliente','1','$unidades')";
			mysqli_query($mysqli, $selectComprar4);
			
			$update4 = "UPDATE mueble SET stock=stock-".$unidades." where id_mueble=1";
			$resUpdate4 = mysqli_query($mysqli, $update4);	
		}	
				
			}
			?>

  </body>
</html>