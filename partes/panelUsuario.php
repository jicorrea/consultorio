<script type="text/javascript">
    function borrarTurno(id)
    {
      borrarTurn(id);
    }
    function altaTurno()
    {
      GuardarTurno();
    }
</script> 

<script type="text/javascript" src="js/calendario_dw.js"></script>
  <link href="css/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php 
require_once("../clases/usuario.php");
require_once("../clases/medico.php");
require_once("../clases/turno.php");
session_start();


if(isset($_SESSION['registrado']))
{

    if (isset($_POST['idBorrar'])) 
    { 
      //echo "<script>alert(".$_POST['idBorrar'].")</script>";
      turno::eliminarTurno($_POST['idBorrar']); //borro el registro
    }

	//echo "<section class='widget'><center><h2> Bienvenido: ". $_SESSION['registrado']."</h2></center>";
	$usuario= usuario::TraerUnUsuario($_SESSION['registrado']);
  $turnosRegistrados=turno::TraerTurnos();
  $listaMedico = medico::TraerMedicos();
  $listaUsuario = usuario::TraerUsuarios();

  $categoriaUsuario= $usuario->categoria;

echo "<div class='container'>
        <img class='avatar' src='uploads/".$usuario->foto."'/>
        <div class='jumbotron text-center'>
          <h2>Bienvenido: <br>".$usuario->apellido." ".$usuario->nombre."</h2>
        </div>
        <div class='container'>
          <div class='row'>";
          echo ($categoriaUsuario!="clinico")? "<div class='col-sm-4'>":"<div class='col-sm-8'>";
          echo "
              <h3>Mi Perfil:</h3>

              <input class='form-control btn btn-primary btn-md' type='button' onclick='mostrarRegistro(\"".$usuario->correo."\")' value='Modificar mi perfil'/><br>
              Apellido: <label class='form-control' for='".$usuario->apellido."'>".$usuario->apellido."</label>
              Nombre: <label class='form-control' for='".$usuario->nombre."'>".$usuario->nombre."</label>
              Correo: <label class='form-control' for='".$usuario->correo."'>".$usuario->correo."</label>
              Telefono: <label class='form-control' for='".$usuario->telefono."'>".$usuario->telefono."</label>
              Obra Social: <label class='form-control' for='".$usuario->obra_Soc."'>".$usuario->obra_Soc."</label>
              Direccion: <label class='form-control' for='".$usuario->provincia.", ".$usuario->localidad.", ".$usuario->direccion."'>".$usuario->provincia.", ".$usuario->localidad.", ".$usuario->direccion."</label>
              Fecha de registro: <label class='form-control' for='".$usuario->fec_Reg."'>".$usuario->fec_Reg."</label>
              Ingreso por ultima vez el: <label class='form-control' for='".$usuario->fec_Ing."'>".$usuario->fec_Ing."</label>
              <input class='form-control btn btn-info btn-md' type='button' onclick='mostrarCarnetPDF(\"".sha1($usuario->correo)."\")' value='Imprimir Carnet'/><br>
";

if($categoriaUsuario!="clinico"){
echo "      </div>
            <form id = 'formTurno'>
              <div class='col-sm-4'>
                <input type='hidden' id='paciente' name='paciente' value='";
                  echo isset($usuario)? $usuario->correo: "";
                echo "'/>
                <h3>Sacar turno: </h3>";?>
                <div class='col-md-7 formRegist'>
                  <h4>Medico:</h4><label for='medico' class='sr-only'>Medico:</label>
                  <select  class='form-control' name='medico' id='medico'>
                    <option value="">--Seleccione medico--</option>
                    <?php
                    foreach ($listaUsuario as $usuario){
                     if($usuario->categoria=="clinico")
                     {
                        echo "<option value='".$usuario->correo."'>".$usuario->apellido.", ".$usuario->nombre."</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
                  <?php 
echo"         </div>
              <div class='col-sm-5'>
                <h4>Atiende por la:</h4>
                <input id='horario' name='horario' value='' readonly/> 
              </div>
              <div class='col-sm-5'>
                <h4>Los dias:</h4>
                <input id='dia' name='dia' value='' readonly/> 
              </div>            
              <div class='col-sm-2'>
                <h4>Fecha:</h4>
                <input type='text' name='fecha' id='fecha' class='campofecha' placeholder='Ingrese fecha'size='12'>
                <input class='form-control btn btn-primary btn-md' id='bTurno' type='button' onclick='altaTurno()' value='Confirmar turno' disabled/>
                *Recuerde que es por horario de llegada
                <div id='info1'></div> 
              </div>
            </form>";

          }

            echo "        
            <div class='col-sm-8'>
              <br>
              <hr>
              <h3>";
              echo ($categoriaUsuario!="clinico") ? "Mis Turnos: " : "Turnos vigentes: ";
       echo " </h3>
              <table class='table table-hover table-responsive'>
                <thead style='color:white;'>
                  <tr>
                    <th>  id   </th>        
                    <th>  medico  </th>
                    <th>  fecha   </th>        
                    <th>  horario  </th> 
                    <th>  PDF  </th>
                    <th>  Canc. </th>          
                  </tr> 
                </thead>
              ";
                $time = time();
                $time = date("d-m-Y", $time);
                $d2 = new DateTime($time);

                foreach ($turnosRegistrados as $turno){
                  $d1 = new Datetime($turno->fecha);
                  if($categoriaUsuario!="clinico")
                  {
                    $var=$turno->paciente;
                  }else{
                    $var=$turno->medico;
                  }
                  if( strcmp($var, $_SESSION['registrado'])==0){//si son iguales devuelve 0
                   if($d1>$d2){ 
    echo "        <tbody>
                    <tr>
                      <td>".$turno->id."</td>";

                      foreach ($listaUsuario as $usuario){
                        if($categoriaUsuario!="clinico"){ 
                          if($usuario->categoria=="clinico" && $usuario->correo==$turno->medico)
                          {
                            echo "<td>".$usuario->apellido.", ".$usuario->nombre."</td>";
                            break;
                          }
                        }else{
                          if($usuario->categoria!="clinico" && $usuario->correo==$turno->paciente)
                          {
                            echo "<td>".$usuario->apellido.", ".$usuario->nombre."</td>";
                            break;
                          }                        
                        }
                      }                          
                                         
            echo"       
                      <td>".$turno->fecha."</td>
                      <td>".$turno->horario."</td>
                      <td><button class='btn ' style='color:red' name='Modificar' onclick='mostrarTurnoPDF(\"".sha1($turno->id)."\")'><i class='fa fa-file-pdf-o'></i></button></td>
                      <td><button class='btn btn-danger' name='Borrar' onclick='borrarTurno(\"".$turno->id."\")'>   <span class='glyphicon glyphicon-remove-circle'>&nbsp;</span></button></td>
                    </tr>
                  </tbody>
              ";   }
                  }
                } 
              echo"
              </table> 
            </div>
          </div><!--ROW-->
        </div>
      </div>";


 
	}else
	{
			//no se encuentra logeado o se le vencio la sesion
	}

	 ?>


<script>

  $(document).ready(function() {
    $(".campofecha").calendarioDW();

    $("#medico").focusout(function(){
        $("#bTurno").prop("disabled", false);
      });


// SELECT clinico
        $("#medico").change(function(){
                $.ajax({
                        type: "POST",
                        url: "partes/validar.php",
                        data: {correo:$('#medico').val(),
                                medico:"medico"
                              },
                        success: function( respuesta ){
                          //alert(respuesta);
                          ajaxResponse = $.parseJSON(respuesta);
                          //alert(ajaxResponse.horario);
                        if(String(ajaxResponse.horario) !="" || String(ajaxResponse.dia) !=""){
                            $('#horario').val(String(ajaxResponse.horario));
                            var dia = String(ajaxResponse.dia);
                            switch(dia) {
                              case "lu":
                                      $('#dia').val("lunes");
                                      break;
                              case "ma":
                                      $('#dia').val("martes");
                                      break;
                              case "mi":
                                      $('#dia').val("miercoles");
                                      break;
                              case "ju":
                                      $('#dia').val("jueves");
                                      break;
                              case "vi":
                                      $('#dia').val("viernes");
                                      break;                                                                                                                                                        
                            default:
                                    $('#dia').val("");
                            } 
                        }else{
                            $('#horario').val("");
                          $('#dia').val("");}
                        }
                        });
        });

//

  });

</script> 
