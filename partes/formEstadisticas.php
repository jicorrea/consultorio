<?php
    require_once('../clases/obraSoc.php');
    require_once('../clases/usuario.php');
    require_once('../clases/turno.php');

    session_start();
    
   if(isset($_SESSION['registrado'])) {  

        $var = usuario::TraerUnUsuario($_SESSION['registrado']);

        if(!empty($_POST['correo']))
        {
            if($_POST['correo']==sha1($var->correo))
            {   
             echo "<br><br><div class='container'>
                    <div class='row'>
                        <div class='col-sm-4'>
                        </div>
                         <div class='col-sm-8'>
                            <button class='btn btn-warning' name='Modificar' onclick='mostrarGrafico(\"".$var->correo."\",\"usuarios\")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Mostrar Usuarios</button>
                            <button class='btn btn-warning' name='Modificar' onclick='mostrarGrafico(\"".$var->correo."\",\"tipos\")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Mostrar Tipo Usuario</button>
                         </div>
                    </div>
                    <br>
                        <div class='col-sm-2'>
                        </div>
                         <div class='col-sm-10' id='grafico'>
                            
                         </div>
                    </div>                    
                    <div class='col-sm-12'> 
                    </div>
                   </div>";    
            }    
        }
    }
?>
