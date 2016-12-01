<!--MODAL FORM-->
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'"
    class="close" title="Close Modal">&times;</span>
  <!-- Modal Content -->
    <form class="modal-content animate" onsubmit="validarLogin();return false;" id="formLogin">
      <div class="imgcontainer">
        <!--img src="img_avatar2.png" alt="Avatar" class="avatar">-->
      </div>
      <div class="loginF">
        <label><b>Usuario</b></label> 
        <input type="text" placeholder="Ingrese correo" name="uname" id="uname" value="<?php  if(isset($_COOKIE["registro"])){echo $_COOKIE["registro"];}?>" required>
        <label><b>Password</b></label>
        <input type="password" placeholder="Ingrese password" name="psw" id="psw" required>
        <button type="submit" class="botonform" onclick="">Login</button>
        <input type="checkbox" name="recordarme" id="recordarme" checked="checked"> Recordar
        <div id="inf"></div>
      </div>
      <div class="loginF" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn botonform">Cancel</button>
        <span class="psw">Forgot <a href="#" onclick='mostrarRestablecer(document.getElementById("uname").value)' >password?</a></span>
      </div>
    </form>
  </div>
<!--FIN MODAL FORM-->


