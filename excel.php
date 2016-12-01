<?php 
    require_once('clases/usuario.php');
    require_once('clases/turno.php');
    require_once('clases/medico.php');

$time = time();
$time = date("d-m-Y", $time);

header("Pragma: public");
header("Expires: 0");
$filename = $_GET['mostrar']."-".$time.".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 

 session_start();
    
   if(isset($_SESSION['registrado'])) {  

        $var = usuario::TraerUnUsuario($_SESSION['registrado']);
        $arrayT = turno::TraerTurnos();
        $arrayM = medico::TraerMedicos();
        $listaUsuario = usuario::TraerUsuarios();

        if(!empty($_GET['correo']) && !empty($_GET['mostrar']))
        {
            if($_GET['correo']==sha1($var->correo)&&$var->categoria=="admin")
            {
            	switch ($_GET['mostrar']) {
            		case "usuarios":
            echo"	<table class='table table-hover table-responsive'>
 
                <thead style='color:white;'>
                  <tr>
                  	<th></th>
                  	<th>  Categoria </th>	
                    <th>  Apellido   </th>        
                    <th>  Nombre  </th>
                    <th>  Correo   </th>        
                    <th>  Obra Soc.  </th> 
                    <th>  Telefono   </th>        
                    <th>  Provincia  </th>
                    <th>  Localidad   </th>        
                    <th>  direccion  </th>
                    <th>  Fec_Reg   </th>        
                    <th>  Fec_Ing  </th>                                                                               
                  </tr> 
                </thead>";    
    foreach ($listaUsuario as $personaAux){

    echo "      <tbody>
                  <tr>
                  	<td></td>
                    <td>".$personaAux->categoria."</td>
                    <td>".$personaAux->apellido."</td>
                    <td>".$personaAux->nombre."</td>
                    <td>".$personaAux->correo."</td>
                    <td>".$personaAux->obra_Soc."</td>
                    <td>".$personaAux->telefono."</td>
                    <td>".$personaAux->provincia."</td>
                    <td>".$personaAux->localidad."</td>
                    <td>".$personaAux->direccion."</td>
                    <td>".$personaAux->fec_Reg."</td>
                    <td>".$personaAux->fec_Ing."</td>                                                                                
                    </tr>
                </tbody>";
    } 

    echo "    </table>
             </div>";            			
            			break;
            case "medicos":
            echo"	<table class='table table-hover table-responsive'>
 
                <thead style='color:white;'>
                  <tr>
                  	<th></th>
                  	<th>  Matricula </th>	
                    <th>  Correo   </th> 
                    <th>  Apellido </th>
                    <th>  Nombre </th>
                    <th> Telefono </th>          
                    <th>  Dia  </th>
                    <th>  Horario   </th>                                                                                      
                  </tr> 
                </thead>";    
    foreach ($arrayM as $personaAux){

    echo "      <tbody>
                  <tr>
                  	<td></td>
                    <td>".$personaAux->matricula."</td>
                    <td>".$personaAux->correo."</td>
                    ";
                    foreach ($listaUsuario as $usuario) {
                        if($personaAux->correo == $usuario->correo)
                        {
                            echo "<td>".$usuario->apellido."</td>
                                  <td>".$usuario->nombre."</td>
                                  <td>".$usuario->telefono."</td>";
                            break;      
                        }
                    }
            echo"
                    <td>".$personaAux->dia."</td>
                    <td>".$personaAux->horario."</td>                                                                               
                    </tr>
                </tbody>";
    } 

    echo "    </table>
             </div>";
            		break;
    case "turnos":
            echo"	<table class='table table-hover table-responsive'>
 
                <thead style='color:white;'>
                  <tr>
                  	<th></th>
                  	<th>  Id </th>
                    <th>  Correo Med.   </th>	
                    <th>  Medico   </th>
                    <th>  Correo Pac.  </th>        
                    <th>  Paciente  </th>
                    <th>  Fecha </th>
                    <th>  Horario   </th>                                                                                      
                  </tr> 
                </thead>";    
    foreach ($arrayT as $personaAux){

    echo "      <tbody>
                  <tr>
                  	<td></td>
                    <td>".$personaAux->id."</td>";

                    foreach ($listaUsuario as $usuario) {
                        if($usuario->correo==$personaAux->medico)
                        {
                            echo "<td>".$usuario->correo."</td>";
                             echo "<td>".$usuario->apellido.", ".$usuario->nombre."</td>";
                             break;
                        }                   
                    }
                    foreach ($listaUsuario as $usuario) {
                        if($usuario->correo==$personaAux->paciente)
                        {
                             echo "<td>".$usuario->correo."</td>";
                             echo "<td>".$usuario->apellido.", ".$usuario->nombre."</td>";
                             break;
                        }                   
                    }                    

                    echo "
                    <td>".$personaAux->fecha."</td>
                    <td>".$personaAux->horario."</td>                                                                               
                    </tr>
                </tbody>";
    } 

    echo "    </table>
             </div>";    

    break;        		
            		default:
            			# code...
            			break;
            	}

            }
        }
    }    

?>
