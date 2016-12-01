<?php 
require_once("clases/usuario.php");
require_once("clases/obraSoc.php");
require_once("clases/medico.php");
require_once("clases/turno.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

$queHago=$_POST['queHacer'];

switch ($queHago) {

					case 'VerEnMapa':
										include("partes/formMapa.php");
										break;	
					case 'MostrarLogin':
											include("partes/formLogin.php");
											break;		
					case 'ValidarLogin':
											include("partes/validarUsuario.php");
											break;
					case 'cargarTurno':
											$error=0;
											$turnos=0;
											$time = time();
											$time = date("d-m-Y", $time);

											setlocale(LC_ALL,"es_ES");
											$dias = array('','lu','ma','mi','ju','vi','sa','do');

											$fe = date("Y-m-d", strtotime($_POST['fecha']));;
											$dia = $dias[date('N', strtotime($fe))]; //obtengo el dia seleccionado

											$arrayTurnos = turno::TraerTurnos();
											$turnoBuscado = turno::TraerUnTurno($_POST['paciente'],$_POST['medico'],$_POST['fecha']);	
											$medicoSeleccionado = medico::TraerUnMedico($_POST['medico']);

											if(!empty($turnoBuscado))
											{
												$error = 1; //el turno ya esta registrado
											}else{
													if($medicoSeleccionado->dia==$dia)
													{
														$d1 = new DateTime($_POST['fecha']);//convierto el string a fecha
														$d2 = new DateTime($time); ////convierto el string a fecha
														if($d1>=$d2)
														{
															foreach ($arrayTurnos as $turno) {
																if($turno->fecha == $_POST['fecha'] && $turno->medico==$_POST['medico'])
																{
																	$turnos = $turnos + 1;
																}
															}

															if($turnos<5)//cantidad de turnos por dia
															{
																$newTurno = new turno();
																$newTurno->paciente = $_POST['paciente'];
																$newTurno->medico = $_POST['medico'];
																$newTurno->fecha = $_POST['fecha'];
																$newTurno->horario = $_POST['horario'];

																$newTurno->InsertarTurno();
															}
															else{
																$error = 3; //no hay mas turnos para el dia seleccionado
															}
														}else{
															$error = 4; //fecha posterior
														}																
													}else{
														$error = 2; //no se selecciono el dia que atiende
														if(empty($_POST['fecha']))
														{
															$error = 5;	
														}
													}											
											}

											echo $error; 
											break;																							
					case 'darAltaUser':
											$newUser = usuario::TraerUnUsuario($_POST['correo']);

											$error = 0;
											$tammax=200000;

											if(!empty($newUser) && !empty($_POST['contrasena'])){
												$error = 1; // El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>
															//exit($error);
												echo $error;
												break;
											}else{												
													if($_FILES['foto']['name'] !="")
													{
														$nombreArchivo = $_FILES['foto']['name'];
														$file_name = $_POST['correo'];

														$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/","@",".");
														$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;","","");

														$extensiones = array('jpg','jpeg','png');
														$temp=explode('.', $nombreArchivo);
														$extension = strtolower(end($temp));

														$file_name = str_replace($caracteres_malos, $caracteres_buenos, $file_name);

														if ($_FILES['foto']['size'] > $tammax)
														{
															$error = 3; // El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>
															//exit($error);
															echo $error;
															break;
														}

														if (!($_FILES['foto']['type'] =="image/jpeg" OR $_FILES['foto']['type'] =="image/jpg" OR $_FILES['foto']['type'] =="image/png"))
														{
															$error = 4; //Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>;
															echo $error;
															break;
																	//exit($error);
														}


														//$add = "uploads/".$file_name;
														//redimenciono la imagen
											        	$ruta_imagen =$_FILES['foto']['tmp_name'];
								                        $miniatura_ancho_maximo = 200;
								                        $miniatura_alto_maximo = 200;
								                        $info_imagen = getimagesize($ruta_imagen);
								                        $imagen_ancho = $info_imagen[0];
								                        $imagen_alto = $info_imagen[1];
								                        $imagen_tipo = $info_imagen['mime'];

								                        $lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

			                                            switch ( $imagen_tipo ){
			                                            							case "image/jpg":
			                                                						case "image/jpeg":
			                                                    										$imagen = imagecreatefromjpeg( $ruta_imagen );
			                                                    										break;
			                                               							case "image/png":
			                                                    										$imagen = imagecreatefrompng( $ruta_imagen );
			                                                   											break;
			                                            						}

			                            				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);
											
														//Si la extensión es correcta, procedemos a comprobar el tamaño del archivo subido
														//Y definimos el máximo que se puede subir
														//Por defecto el máximo es de 2 MB, pero se puede aumentar desde el .htaccess o en la directiva 'upload_max_filesize' en el php.ini

														$tamañoArchivo = $lienzo; //Obtenemos el tamaño del archivo en Bytes
														$tamañoArchivoKB = round(intval(strval( $tamañoArchivo / 1024 ))); //Pasamos el tamaño del archivo a KB
														$tamañoMaximoKB = "2048"; //Tamaño máximo expresado en KB
														$tamañoMaximoBytes = $tamañoMaximoKB * 1024; // -> 2097152 Bytes -> 2 MB
														if($tamañoArchivo > $tamañoMaximoBytes)
														{
															$error = 5; //Error al subir el archivo
															echo $error;
															break;
														}

													}//FIN FOTO
															
														if($error == 0) //nuevo usuario
														{
															if(empty($newUser))
															{
																$newUser = new usuario();
															}else
															{
																$categoria = $newUser->categoria;
																$fec_Ing = $newUser->fec_Ing;
															}

															

															
															$time = time();
															$newUser->correo = $_POST['correo'];
															$newUser->apellido = $_POST['apellido'];
															$newUser->nombre = $_POST['nombre'];
															$newUser->telefono = $_POST['telefono'];
															$newUser->obra_Soc = $_POST['obra_Soc'];
															$newUser->provincia = $_POST['provincia'];
															$newUser->localidad = $_POST['localidad'];
															$newUser->direccion = $_POST['direccion'];
																
															$newUser->activation_key = usuario::generate_random_key();
																
															//$newUser->validated=
															if($_FILES['foto']['name'] !="")
															{
																$newUser->foto = $file_name.".".$extension;
																imagejpeg( $lienzo, 'uploads/' . $file_name.".".$extension, 90 );	
															}else if( $_POST['f1'] !=""){
																	$newUser->foto = $_POST['f1'];	
															}else{
																$newUser->foto = "porDefecto.jpg";
															}
																																															
																//
															if(!empty($_POST['contrasena']))
															{
																if($_POST['contrasena']!=$_POST['contrasena1'])
																{
																	$error = 2; //Error 
																	echo $error;
																	break;
																}else{//Por primera vez
																		$newUser->contrasena = md5($_POST['contrasena']);
																		$newUser->categoria="usuario";
																		$newUser->fec_Reg = date("d-m-Y (H:i:s)", $time);

																		$asunto ='Finalizar registro';

																		$mensaje = '<h1>Ultimo paso:</h1> 
	      																<p> 
	      																	<b>Haga click en el siguiente link</b>:<br><b><a href="http://consultorio.hol.es/activate.php?activation='.$newUser->activation_key.'">http://consultorio.hol.es/activate.php?activation='.$newUser->activation_key.'</a></b> 
	      																</p>
	      																No responda este mail. ';																																					
																}
															}else
																{
																	if(!empty($_POST['categoria']))
																	{
																		$newUser->categoria=$_POST['categoria'];
																		if($_POST['categoria']=="clinico")
																		{
																			$newMedico = new medico();
																			$newMedico->matricula = $_POST['matricula'];
																			$newMedico->correo = $_POST['correo'];
																			$newMedico->dia = $_POST['dia'];
																			$newMedico->horario = $_POST['horario'];

																			$newMedico->GuardarMedico();
																		}else{
																			$med = medico::TraerUnMedico($_POST['correo']);
																			if(!empty($med)){
																				medico::eliminarMedico($_POST['correo']);
																			}
																		}	
																	}else
																	{
																		$newUser->categoria = $categoria;
																		$newUser->fec_Ing = $fec_Ing;
																	}
																	
																	$error = 6;//Modificacion correcta
																	//break;
															}
																																	
															$newUser->GuardarUsuario();

															if(!empty($asunto)&&!empty($mensaje))
															{
																usuario::enviar_Mail($asunto,$mensaje,$newUser->correo);	
															}
																
														}//FIN ERROR=0
												}//FIN ELSE		
			
												echo $error;
											break;	
							
					default:
							# code...
							break;
					}

 ?>