<?php //Valida que exista el correo
	require_once("../clases/usuario.php");
	require_once("../clases/obraSoc.php");
	require_once("../clases/medico.php");

	$User = usuario::TraerUnUsuario($_POST['correo']);
	$med = medico::TraerUnMedico($_POST['correo']);

	

	if(!empty($med)&&isset($_POST['medico']))
	{
		$jsondata = array();
		$jsondata['horario'] = $med->horario;
		$jsondata['dia'] = $med->dia;
		echo json_encode($jsondata);
	}

    if(!empty($User)&&empty($med)) {
        echo 1;
    }

?>