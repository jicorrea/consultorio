<!DOCTYPE html>
<html lang="es">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Restablecer contraseÃ±a </title>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="css/principal.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
  <script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>  

    <!-- Include Bootstrap Wizard -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
  

  <script>
  $(document).ready(function(){


    $("#frmRestablecer").submit(function(event){
      event.preventDefault();

         if($('#password1').val()!=""&&$('#password2').val()!=""){

            $('#btnRestablecer').removeClass('disabled');
            $('#btnRestablecer').prop('disabled', false);

            $.ajax({
                    url:'partes/cambiarpassword.php',
                    type:'post',
                    dataType:'json',
                    data:$("#frmRestablecer").serializeArray(),
                    success: function(data) {
                      $('#mensaje').html(data['mensaje']);
                      if(data['error']=='nc')
                      {
                        $('#btnRestablecer').addClass('disabled');
                        $("#password1").val('');
                        $("#password2").val('');
                        $("#password1").focus();                   
                      }else{
                        setTimeout(function(){ location.href = '../index.html'; }, 3000);
                      }
                    //setTimeout(function(){ location.href = '../index.html'; }, 3000);
                    },
                    error: function(res) {
                      var myWindow = window.open("", "MsgWindow", "width=200,height=100");
                      myWindow.document.write(JSON.stringify(res));
                      //alert("There was an error: " + JSON.stringify(res));
                    }
                  }); 
            
       }
      else
      {
         $("#password2").focus(); 
         $('#btnRestablecer').addClass('disabled');
         $('#btnRestablecer').prop('disabled', true);
         $('#mensaje').html('<p class="alert alert-danger">Vuelva a repetirla</p>');
 
      }
    });
    
    $('#frmRestablecer')
                        .formValidation({
                          framework: 'bootstrap',
                          icon: {
                                  valid: 'glyphicon glyphicon-ok',
                                  invalid: 'glyphicon glyphicon-remove',
                                  validating: 'glyphicon glyphicon-refresh'
                          },
                          // This option will not ignore invisible fields which belong to inactive panels
                          excluded: ':disabled',
                err: {
                      // You can set it to popover
                    // The message then will be shown in Bootstrap popover
                      container: 'tooltip'
                     }, 
                            fields: {
                              password1: {
                                validators: {
                                    notEmpty: {
                                      message: 'El password es requerido'
                                    },
                                    stringLength: {
                                      min: 6,
                                      message: 'El password debe contener al menos 6 caracteres'
                                    }    
                                }
                              },
                              password2: {
                                validators: {
                                    notEmpty: {
                                      message: 'El password es requerido'
                                    },
                                    stringLength: {
                                      min: 6,
                                      message: 'El password debe contener al menos 6 caracteres'
                                    }    
                                }
                              }
                            }
                        });

    $('#btnRestablecer').addClass('disabled');
    $('#btnRestablecer').prop('disabled', true);
  });

</script>
 </head>
<?php

require_once("clases/usuario.php");
require_once("clases/resetPass.php");

$token = $_GET['token'];
$idusuario = $_GET['idusuario'];
 
$resultado = resetPass::TraerUnResetTK($token);
 
if( !empty($resultado)){
   
   if( sha1($resultado->idusuario) == $idusuario ){
?>
 
 <body>
  <div class="container" role="main">
   <div class="col-md-4"></div>
   <div class="col-md-4">
    <form action="partes/cambiarpassword.php" id="frmRestablecer" method="post">
     <div class="panel panel-default">
      <div class="panel-heading"> Restaurar contraseÃ±a </div>
      <div class="panel-body">
       <p></p>
       <div class="form-group">
        <label for="password"> Nueva contraseÃ±a </label>
        <input type="password" class="form-control" name="password1" id="password1" minlength="6" required>
       </div>
       <div class="form-group">
        <label for="password2"> Confirmar contraseÃ±a </label>
        <input type="password" class="form-control" name="password2" id="password2" minlength="6" required>
       </div>
       <input type="hidden" name="token" value="<?php echo $token ?>">
       <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
       <div class="form-group">
        <input type="submit" class="btn btn-primary" id="btnRestablecer" value="Recuperar contraseÃ±a" >
       </div>
      </div>
     </div>
    </form>
   </div>
  <div class="col-md-4"><div id="mensaje"></div></div>
  </div> <!-- /container -->

 </body>
</html>
<?php
   }
   else{
     header('Location:index.html');
   }
 }
 else{
    echo "
    <body>
    <div id='principal'></div>

    <script>
    $('#principal').load('partes/msg.php?titulo=Error&msj=%Link%ya%utilizado.');
    setTimeout(function(){ location.href = '../index.html'; }, 3000);
    </script>
    </body>
    </html>
    ";
 }
?>