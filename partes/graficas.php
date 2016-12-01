<?php
 require_once ('../clases/jpgraph/src/jpgraph.php');
 require_once ('../clases/jpgraph/src/jpgraph_bar.php');
 require_once ('../clases/usuario.php');
 session_start();
if(isset($_SESSION['registrado'])){
	$arrayUsuario = usuario::TraerUsuarios();
	$registrado=0;
	$cant=0;
	$pendiente=0;	
	foreach ($arrayUsuario as $usuario) {
		if($usuario->validated==1)
			{
				$registrado = $registrado + 1;
			}
			$cant = $cant + 1;
		}

	$pendiente = $cant - $registrado;
	//$cant,$registrado,$cant-$registrado
	$datos = array($cant,$registrado,$pendiente);
 
	//Instancia del objeto del tipo Graph en donde como parametro
	// se le pasan los valore de ancho y altura
	$grafica = new Graph(700,440);
	$grafica->SetScale("textlin");
 
	//Posición de los puntos del eje de las Y
 
	$grafica->yaxis->SetTickPositions(array(0,1,2,3,4,5,6,8,9,10,12,16,20), null); 
	$grafica->SetBox(false);
	//Nombre de las columnas
	$columnas = array('Registrados','Completado','Pendiente');
	$grafica->xaxis->SetTickLabels($columnas);
 
	//Objeto del tipo BarPlot que se le enviara a la gráfica y el cual
	//recibe como parametros los datos a graficar
	$barras = new BarPlot($datos);
 
	$grafica->Add($barras);
	//Color de los bordes 
 
	//Color de borde de las barras
	$barras->SetColor("white");
	//Color de relleno de las barras
	$barras->SetFillColor("#4B0082");
	//Ancho de las barras
	$barras->SetWidth(45);
 
	$grafica->title->Set("Registro usuarios");
	$grafica->title->SetFont(FF_TIMES,FS_ITALIC,18);
	$grafica->Stroke();
}
?>