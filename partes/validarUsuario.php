<?php 
		
	require_once("clases/usuario.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

	session_start();

	$correo=$_POST['correo'];

	$contrasena=md5($_POST['contrasena']); 

	$recordar=$_POST['recordarme'];

	$buscado = usuario::validarUsuario($correo,$contrasena);

	$retorno;

	if($buscado !=Null && $buscado->validated==1)
	{			
	
		if($recordar=="true")
		{
			
			setcookie("registro",$correo,  time()+36000 , '/');
		
		}else
		{
			
			setcookie("registro",$correo,  time()-36000 , '/');
		
		}

		$_SESSION['registrado']=$correo;

		$time = time();
		
		$buscado->fec_Ing= date("d-m-Y (H:i:s)", $time);

		$buscado->ModificarUsuario();

		if(usuario::validarCategoria($correo)==1)
		{
			$retorno = 1;
		}else{
			$retorno = 2;
		}

	}else
	{
	
		$retorno= 0;
	
	}

	echo $retorno;
?>