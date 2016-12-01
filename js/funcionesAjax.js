function mostrarRegistro(id)
{
	//alert(id);
	var idx=id;

	$("#principal").load("partes/formRegistro.php",{correo:idx});

}//FIN mostrarRegistro()

function mostrarEstadisticas(id)
{
	//alert(id);
	var idx=id;

	$("#principal").load("partes/formEstadisticas.php",{correo:idx});

}//FIN mostrarEstadisticas()

function mostrarGrafico(id,usu)
{
	//alert(id);
	var idx=id;
	var mostrar=usu;
	switch (mostrar) {
						case "usuarios":
							$("#grafico").html("<h3>Usuario: "+idx+"<h3><img src='partes/graficas.php' />");
						break;
						case "tipos":
							$("#grafico").html("<h3>Usuario: "+idx+"<h3><img src='partes/graficas2.php' />");
						break;										        
					} 
	

}//FIN mostrarGrafico()

function mostrarExcel(id,usu)
{
	//alert(id);
	//alert(usu);
	var idx=id;
	var mostrar=usu; //que voy a mostrar
	window.open("excel.php?correo="+idx+"&mostrar="+mostrar,"nueva", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no,width=400, height=200");
	//$("#principal").load("excel.php",{correo:idx});

}//FIN mostrarExcel()


function mostrarCarnetPDF(id)
{
	//alert(id);
	var idx=id;

	//$("#principal").load("partes/pdf.php",{correo:idx});
	//window.open("partes/pdf.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");

	window.open("Pdf.php?correo="+idx,"nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");

}//FIN mostrarCarnetPDF()


function mostrarTurnoPDF(id)
{
	//alert(id);
	var idx=id;

	//$("#principal").load("partes/pdf.php",{correo:idx});
	//window.open("partes/pdf.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");

	window.open("Pdf.php?id="+idx,"nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");

}//FIN mostrarTurnoPDF()



function mostrarRestablecer(id)
{
	//alert(id);
	var idx=id;

	document.getElementById('id01').style.display='none';

	$("#principal").load("partes/formRestablecerPass.php",{correo:idx});

}//FIN mostrarRestablecer()


function mostrarLogin() {
	//Muestra el formLogin en el index
	var funcionAjax=$.ajax({
							url:"nexo.php",
							type:"post",
							data:{
									queHacer:"MostrarLogin"
								 }
   	});
	funcionAjax.done(function(retorno){
										//alert(retorno);
										$("#info").html(retorno);
										document.getElementById('id01').style.display='block';
	});
	funcionAjax.fail(function(retorno){
										//	$("#botonesABM").html(":(");
										//$("#informe").html(retorno.responseText);	
	});
	funcionAjax.always(function(retorno){
											//alert("siempre "+retorno.statusText);
	});
}//FIN mostrarLogin()

function validarLogin()
{
	//Valida el usuario y muestra el panel de usuario
		var varUsuario=$("#uname").val();

		var varClave=$("#psw").val();

		var recordar=$("#recordarme").is(':checked');
		
		//$("#informe").html("<img src='imagenes/ajax-loader.gif' style='width: 30px;'/>");
	
		var funcionAjax=$.ajax({
			
								url:"nexo.php",
								
								type:"post",
								
								data:{
										
										queHacer:"ValidarLogin",
										
										recordarme:recordar,
										
										correo:varUsuario,
										
										contrasena:varClave
										
										}
								});

		funcionAjax.done(function(retorno){
											//alert(retorno);
											//$("#principal").html(retorno);
		
											if(retorno == 0) //fallo el loging
											{
												
												$("#psw").val("");
												
												$("#psw").focus();	
												
												$("#inf").addClass("alert alert-danger");	
												
												$("#inf").html("* Error de logeo, verifique los datos y/o que haya validado su cuenta.");	
											}
											
											if(retorno == 2) //logeo exitoso
											{
												
												$("#login").load("partes/botonDeslogear.php");
												mostrarPerfil(0);
												//alert("Login Exitoso");
												document.getElementById('id01').style.display='none';
												
											}
											
											if(retorno == 1) //admin panel
											{
												
												$("#login").load("partes/botonDeslogear.php");
												mostrarPerfil(1);
												//alert("Admin");
												document.getElementById('id01').style.display='none';
												
											}

		
											});

		funcionAjax.fail(function(retorno){
											
											//	$("#botonesABM").html(":(");
											
											//$("#informe").html(retorno.responseText);	
											
											});
		
		funcionAjax.always(function(retorno){
											
												//alert("siempre "+retorno.statusText);

											});
}//FIN validarLogin()


function deslogearUsuario()
{//deslogea el usuario	
	$("#login").load("partes/deslogearUsuario.php");
	location.href = "";
} //FIN deslogearUsuario()

function mostrarPerfil(tipo)
{
	if(tipo==0)
	{
		$("#principal").load("partes/panelUsuario.php");	
	}
	if(tipo==1)
	{
		$("#principal").load("partes/panelAdmin.php");
	}
}//FIN mostrarPerfil()