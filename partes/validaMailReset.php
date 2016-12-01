<?php 

date_default_timezone_set('America/Argentina/Buenos_Aires');
$time = time();
$fechaActual = date("Y-m-d", $time);

require_once("../clases/usuario.php");
require_once("../clases/resetPass.php");

function generarLinkTemporal($idusuario, $username){
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
   $token = sha1($cadena);
 
  $reset = new resetPass();
  $t=time();

  $reset->idusuario = $idusuario;
  $reset->username = $username;
  $reset->token = $token;
  $reset->creado = date("Y-m-d H:i:s",$t);

  $reset->InsertarReset();

   if($reset){
      // Se devuelve el link que se enviara al usuario
      $enlace = 'http://consultorio.hol.es/restablecer.php?idusuario='.sha1($idusuario).'&token='.$token;
      return $enlace;
   }
   else
      return FALSE;
}
 
function enviarEmail( $email, $link ){
   $mensaje = '<html>
     <head>
        <title>Restablece tu contrase&ntildea</title>
     </head>
     <body>
       <p>Hemos recibido una peticion para restablecer la contrase&ntildea de tu cuenta.</p>
       <p>Si hiciste esta peticion, haz clic en el siguiente enlace, si no hiciste esta peticion puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         <a href="'.$link.'"> Restablecer contraseña </a>
       </p>
     </body>
    </html>';
 
   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $cabeceras .= 'From: admin <admin@consultorio.hol.es>' . "\r\n";
   $cabeceras .= "Bcc: admin@consultorio.hol.es\r\n";
   // Se envia el correo al usuario
   mail($email, "Recuperar password", $mensaje, $cabeceras);
}


$email = $_POST['email'];
 
$respuesta = new stdClass();
 
if( $email != "" ){

   $resultado = usuario::TraerUnUsuario($email);

   if(!empty($resultado)){
    
      $tokenAsoc = resetPass::TraerResetPass();
    
      foreach ($tokenAsoc as $tokenA){
      
         if($tokenA->idusuario == $resultado->correo)
         {
           $fecha = substr((string) $tokenA->creado,0,10);
           $tok = $tokenA->token;
         }
      }

      if($fecha!=(string)$fechaActual)
       {
         $linkTemporal = generarLinkTemporal( $resultado->correo, $resultado->apellido );
         if($linkTemporal){
           resetPass::eliminarReset($tok);
           enviarEmail( $email, $linkTemporal );
           $respuesta->mensaje = "<div class='alert alert-info'>Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contrase&ntildea.</div>";
         }
       }
       else{
            $respuesta->mensaje ="<div class='alert alert-info'>Su pedido ya fue gestinado en el dia de hoy. Pruebe mana&ntildea.</div>";
       }
   }
    else{
    $respuesta->mensaje = "<div class='alert alert-warning'> No existe una cuenta asociada a ese correo.</div>";
   }
}
else{
      $respuesta->mensaje= "Debes introducir el email de la cuenta";

}



 echo json_encode( $respuesta );