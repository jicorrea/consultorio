<?php 
require_once("../clases/usuario.php");

session_start();

if(isset($_SESSION['registrado']))
{
	$usuario=$_SESSION['registrado'];
	$tipo = usuario::validarCategoria($_SESSION['registrado']);

		
                   echo  "
                    <li>
                        <a href='#' onclick='mostrarPerfil(".$tipo.")' class='glyphicon glyphicon-user btn btn-lg'>Mi-Perfil</a>
                    </li>
                   <li>
                        <a href='#' onclick='deslogearUsuario()' class='glyphicon glyphicon-remove-sign btn btn-lg'>Salir</a>
                    </li>";


 
	}else
	{
				echo "<li><a href='#' onclick='mostrarLogin()'><span class='glyphicon glyphicon-user'></span>Login</a></li>
          <li><a href='#' onclick='mostrarRegistro(0)'><span class='glyphicon glyphicon-circle-arrow-right'></span> Registrarse</a></li>";
	}

	 ?>