<?php
 require_once ('../clases/jpgraph/src/jpgraph.php');
 require_once ('../clases/jpgraph/src/jpgraph_pie.php');
 require_once ('../clases/jpgraph/src/jpgraph_pie3d.php');
 require_once ('../clases/usuario.php');
 session_start();
if(isset($_SESSION['registrado'])){
	$arrayUsuario = usuario::TraerUsuarios();

	$admins=0;
	$medicos=0;
	$usuarios=0;

	foreach ($arrayUsuario as $usuario) {
		if($usuario->categoria=="admin")
		{
			$admins = $admins + 1;
		}
		if($usuario->categoria=="usuario")
		{
			$usuarios = $usuarios + 1;
		}
		if($usuario->categoria=="clinico")
		{
			$medicos = $medicos + 1;
		}	
	}

	// Some data
	$data = array($admins,$medicos,$usuarios);

	// Create the Pie Graph. 
	$graph = new PieGraph(700,440);

	$theme_class= new VividTheme;
	$graph->SetTheme($theme_class);

	// Set A title for the plot
	$graph->title->Set("Tipos de Usuarios");

	// Create
	$p1 = new PiePlot3D($data);
	$p1->value->SetFont(FF_FONT1,FS_BOLD);
	$p1->SetLabelPos(0.2); 
	$nombres=array("admins","medicos","usuarios");
	$p1->SetLegends($nombres);

// Explode all slices
$p1->ExplodeAll(); 

	$graph->Add($p1);



	$p1->ShowBorder();
	$p1->SetColor('black');
	$p1->ExplodeSlice(1);
	$graph->Stroke();
}
?>