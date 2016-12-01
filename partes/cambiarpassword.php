<?php

require_once("../clases/usuario.php");
require_once("../clases/resetPass.php");

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idusuario = $_POST['idusuario'];
$token = $_POST['token'];

$respuesta = new stdClass();
 
if( $password1 != "" && $password2 != "" && $idusuario != "" && $token != "" ){

    $resultado = resetPass::TraerUnResetTK($token);
    
   if( !empty($resultado)){

      $usuario = $resultado->idusuario;
      
      if( sha1($resultado->idusuario) == $idusuario && $resultado->token == $token){ 
         
         if( $password1 == $password2 ){
         
          $password1 = md5($password1); 
          $result = usuario::ModificarPsw($usuario,$password1);
          
            if($result){

               resetPass::eliminarReset($token);
              $respuesta->mensaje = '<p class="alert alert-info"> La contraseÃ±a se actualizÃ³ con exito. </p>';
            
            }
            else{
            
              $respuesta->mensaje = '<p class="alert alert-danger"> OcurriÃ³ un error al actualizar la contraseÃ±a, intentalo mÃ¡s tarde </p>';
            
            }
         }//FIN password!=
         else{

           $respuesta->mensaje = '<p class="alert alert-danger"> Las contraseÃ±as no coinciden </p>';
           $respuesta->error = 'nc';
           
         }
      }//FIN idusuario
      else{

        $respuesta->mensaje ='<p class="alert alert-danger"> El token no es vÃ¡lido </p>';
        
      }
    }//FIN empty
   else{

        $respuesta->mensaje ='<p class="alert alert-danger"> El token no es vÃ¡lido </p>';
        
   }
}//FIN " "
else{
   $respuesta->mensaje= '<p class="alert alert-danger"> Error.</p>';
}
 echo json_encode( $respuesta );   
?>