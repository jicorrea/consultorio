function borrarUsuario(id)
{
	var idx=id;

	$("#principal").load("partes/panelAdmin.php",{idBorrar:idx});

}//FIN borrarUsuario()

function borrarTurn(id)
{
	var idx=id;

	$("#principal").load("partes/panelUsuario.php",{idBorrar:idx});

}//FIN borrarTurn()


function darAltaUser() {
	var formData = new FormData(document.getElementById("formRegistro")); //capturo todo lo del form
	formData.append("queHacer","darAltaUser"); //agrego una variable y su valor
    //event.preventDefault();
	var funcionAjax = $.ajax({
								url:"nexo.php",
								type:"post",
								dataType: "HTML",
								data: formData,
								cache: false,
								contentType: false,
								processData: false	
	});
	funcionAjax.done(function(retorno){
										//alert(retorno);
										switch (retorno) 
										{
											 case "0"://USUARIO NUEVO
										        $("#principal").load("partes/msg.php?titulo=Registro&msj=%Para%terminar%vaya%a%su%e-mail%y%valide%la%cuenta.%Gracias");
										        //$('#formRegistro').formValidation('defaultSubmit');
										        break;
    										case "1":
										        //alert("el usuario existe");
										        $("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> El usuario ya esta registrado.</div>");
										        $("#cor").addClass("has-error");
										        break;
										    case "2":
										        //alert("contraseña ingresadas diferentes");
										        $("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Contraseñas ingresada diferentes.</div>");
										        $("#cor1").addClass("has-error");										        
										        break;
										    case "3":
										       	//alert("El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo");
										       	$("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo.</div>");
										        break;
										    case "4":
										       	//alert("Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos");
										       	$("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos.</div>");
										        break;
										    case "5":
										        $("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> al subir la imagen.</div>");
										        break;
										    case "6":
										        $("#principal").load("partes/msg.php?titulo=Modificacion&msj=%Correcta.%Gracias");
										        break;
										    case "7":
										        $("#info").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Matricula ya registrada.</div>");
										        break;										        										        
										} 
	});
	funcionAjax.fail(function(retorno){
										alert(retorno);
	});
} 

function GuardarTurno() {
	var formData = new FormData(document.getElementById("formTurno")); //capturo todo lo del form
	formData.append("queHacer","cargarTurno"); //agrego una variable y su valor
    //event.preventDefault();
	var funcionAjax = $.ajax({
								url:"nexo.php",
								type:"post",
								dataType: "HTML",
								data: formData,
								cache: false,
								contentType: false,
								processData: false	
	});
	funcionAjax.done(function(retorno){
										switch (retorno) 
										{
											 case "0":
										        	$("#principal").load("partes/panelUsuario.php");
										        //$('#formRegistro').formValidation('defaultSubmit');
										        break;
    										case "1":
										        $("#info1").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Ya tiene un turno registrado.</div>");
										        $("#cor").addClass("has-error");
										        break;
										    case "2":
										        $("#info1").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> El medico no atiende ese dia.</div>");
										        $("#cor").addClass("has-error");										        
										        break;
										    case "3":
										       	$("#info1").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> No hay mas turno para el dia seleccionado.</div>");
										        break;
										    case "4":
										       	$("#info1").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Seleccione una fecha valida.</div>");
										        break;										        
										    case "5":
										       	$("#info1").html("<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!,</strong> Seleccione una fecha valida.</div>");
										        break;									        
										} 
	});
	funcionAjax.fail(function(retorno){
										alert(retorno);
	});
}
