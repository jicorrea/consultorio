<?php 
require_once("clases/usuario.php");

$activation_key = $_GET['activation'];

$user = usuario::activation_key($activation_key);

//var_dump($user);
if(!empty($user))
{
if ($user->activation_key == $activation_key && is_null($user->validated)) { // Si se ha encontrado...

	usuario::modificar_validated($activation_key);


echo "<script>
location.href='index.html?est=ok';
</script>";

    }
    else {

echo "<script>
location.href='index.html?est=completo';
</script>";
 
    }
}else {
	echo "<script>
location.href='index.html?est=error';
</script>";
}
?>