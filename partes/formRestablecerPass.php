
<script>
  $(document).ready(function(){

    $("#frmRestablecer").submit(function(event){
      event.preventDefault();
      
      $.ajax({
        url:'partes/validaMailReset.php',
        type:'post',
        dataType:'json',
        data:$("#frmRestablecer").serializeArray(),
        success: function(data) {
                $('#mensaje').html(data['mensaje']);
                $("#email").val('');
                setTimeout(function(){ location.href = '../index.html'; }, 3000);
            },
        error: function(res) {
               var myWindow = window.open("", "MsgWindow", "width=200,height=100");
               myWindow.document.write(JSON.stringify(res));

        //alert("There was an error: " + JSON.stringify(res));

        }
      });
    });
  });
</script>

<div class='container'>
<form id="frmRestablecer" action="partes/validaMailReset.php" method="post">
  <div class="panel panel-default">
    <div class="panel-heading"> <b>Restaurar contrase&ntildea</b> </div>
    <div class="panel-body">
      <div class="form-group">
        <label for="email"> Escribe el email asociado a tu cuenta: </label>
        <input type="email" id="email" class="form-control" name="email" value="<?php echo isset($_POST['correo']) ?  $_POST['correo'] : "" ; ?>" required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Recuperar" >
      </div>
    </div>
  </div>
</form>

<div id="mensaje"></div>
 </div>