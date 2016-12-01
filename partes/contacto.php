<?php
require_once("../clases/usuario.php");
if(isset($_POST['submit']))
{
  $correo ="admin@consultorio.hol.es";
  $mensaje =$_POST['comments'];
  $asunt =$_POST['email'];
  usuario::enviar_Mail($asunt,$mensaje,$correo);
echo "<script>$('#principal').load('partes/msg.php?titulo=Registro&msj=%Para%terminar%vaya%a%su%e-mail%y%valide%la%cuenta.%Gracias');</script>";

  //redireccionar a la pagina principal y mostrar mensaje de que se envio
}

?>
<script>
/*function enviar()
{
  var //recopilar todos los datos
} */ 

</script> 

    <a name="contacto"  style="text-decoration:none">
    <div id="googleMap"></div>
      <h3 class="text-center">Contacto</h3>
      <!--p class="text-center"><em>Respondemos a la brevedad</em></p>-->
      <div class="row test"> 
        <div class="col-md-4">
          <p><span class="glyphicon glyphicon-map-marker"></span>Av Bartolomé Mitre 750, B1870AAU Avellaneda, Buenos Aires</p>
          <p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
          <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
        </div>
        <form method="post" onsubmit="enviar();return false;"style="border-width:0;">
        <div class="col-md-8">
          <div class="row">
            <div class="col-sm-6 form-group">
              <input class="form-control" id="name" name="name" placeholder="Nombre" type="text" required>
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="text" required>
            </div>
          </div>
          <textarea class="form-control" id="comments" name="comments" placeholder="Comentario" rows="5"></textarea>
          <div class="row">
            <div class="col-md-12 form-group">
              <button class="btn pull-right" type="submit" name="submit">Enviar</button>
            </div>
          </div>
        </div>
        </form>
      </div>