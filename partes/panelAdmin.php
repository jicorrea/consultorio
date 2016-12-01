<script type="text/javascript">
    function borrarRegistro(id)
    {
      borrarUsuario(id);
    }
</script> <!-- ver -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 

  require_once("../clases/usuario.php");
  require_once("../clases/turno.php");
  require_once("../clases/medico.php");

  session_start();



  if(isset($_SESSION['registrado']) && usuario::validarCategoria($_SESSION['registrado'])==1)
  {
    if (isset($_POST['idBorrar'])) 
    { 
      //echo "<script>alert(".$_POST['idBorrar'].")</script>";
       $usu= usuario::TraerUnUsuario($_POST['idBorrar']);
       if($usu->categoria=="clinico")
       {
          medico::eliminarMedico($_POST['idBorrar']);
          turno::eliminarMedicoTurno($_POST['idBorrar']);
       }
      usuario::eliminarUsuario($_POST['idBorrar']); //borro el registro
      
    }
	 //echo "<section class='widget'><center><h2> Bienvenido: ". $_SESSION['registrado']."</h2></center>";
	  $usuario= usuario::TraerUnUsuario($_SESSION['registrado']);
    $ArrayDePersonas = usuario::TraerUsuarios();

    echo "<div class='container'>
            <img class='avatar' src='uploads/".$usuario->foto."'/>
            <div class='jumbotron text-center'>
              <h2>Bienvenido: <br>".$usuario->apellido." ".$usuario->nombre." ".$usuario->categoria."</h2>
            </div>
          <div class='container'>
    
          <div class='row'>
            <div class='col-sm-4'>
              <h3>Usuarios:</h3>
              <table class='table table-hover table-responsive'>
                <button class='btn btn-success' name='Modificar' onclick='mostrarExcel(\"".sha1($usuario->correo)."\",\"usuarios\")'>Mostrar grilla Completa <i class='fa fa-file-excel-o'></i></button>
                <thead style='color:white;'>
                  <tr>
                    <th>  Correo   </th>        
                    <th>  Categoria  </th>
                    <th>  Borrar   </th>        
                    <th>  Modif.  </th>          
                  </tr> 
                </thead>";    
    foreach ($ArrayDePersonas as $personaAux){
      if(($personaAux->categoria=="usuario" || $personaAux->categoria=="admin") && $personaAux->validated!==null){
    echo "      <tbody>
                  <tr>
                    <td>".$personaAux->correo."</td>
                    <td>".$personaAux->categoria."</td>
                    <td><button class='btn btn-danger' name='Borrar' onclick='borrarRegistro(\"".$personaAux->correo."\")'";
                    echo ($personaAux->correo== $usuario->correo)?"disabled":"";
                    echo">   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span></button></td>
                    <td><button class='btn btn-warning' name='Modificar' onclick='mostrarRegistro(\"".$personaAux->correo."\")'><span class='glyphicon glyphicon-edit'>&nbsp;</span></button></td>
                  </tr>
                </tbody>
              ";
      }
    } 

    echo"     </table>
            </div>

            <div class='col-sm-4'>
              <h3>Medicos:</h3>
              <table class='table table-hover table-responsive'>
                <button class='btn btn-success' name='Modificar' onclick='mostrarExcel(\"".sha1($usuario->correo)."\",\"medicos\")'>Mostrar grilla Completa <i class='fa fa-file-excel-o'></i></button>
                <thead style='color:white;'>
                  <tr>
                    <th>  Correo   </th>        
                    <th>  Categoria  </th>
                    <th>  Borrar   </th>        
                    <th>  Modif.  </th>              
                  </tr> 
                </thead>";    
    foreach ($ArrayDePersonas as $personaAux){
      if($personaAux->categoria=="clinico"){//ver
    echo "      <tbody>
                  <tr>
                    <td>".$personaAux->correo."</td>
                    <td>".$personaAux->categoria."</td>
                    <td><button class='btn btn-danger' name='Borrar' onclick='borrarRegistro(\"".$personaAux->correo."\")'>   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span></button></td>
                    <td><button class='btn btn-warning' name='Modificar' onclick='mostrarRegistro(\"".$personaAux->correo."\")'><span class='glyphicon glyphicon-edit'>&nbsp;</span></button></td>
                    </tr>
                </tbody>";
      }
    } 

    echo "    </table>
             </div>
          
              <div class='col-sm-4'>
                <h3>Turnos: </h3>
                <button class='btn btn-success' name='Modificar' onclick='mostrarExcel(\"".sha1($usuario->correo)."\",\"turnos\")'>Mostrar grilla Completa <i class='fa fa-file-excel-o'></i></button>
                <button class='btn btn-info' name='Modificar' onclick='mostrarEstadisticas(\"".sha1($usuario->correo)."\")'>Ver estadisticas</button>
              </div>
            </div>
          </div>
          </div>";

	}else
	{
			//no se encuentra logeado o se le vencio la sesion
	}

	 ?>