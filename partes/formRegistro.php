<?php
    require_once('../clases/obraSoc.php');
    require_once('../clases/categoria.php');
    require_once('../clases/usuario.php');
    require_once('../clases/medico.php');

    $ArrayDeObraSoc = obraSoc::TraerObraSoc();
    $ArrayDeCategoria = categoria::TraerCategorias();
    session_start();
    
    if(isset($_SESSION['registrado'])) {  
        $var = usuario::TraerUnUsuario($_POST['correo']);//verifica que exista
        $var1=medico::TraerUnMedico($var->correo);
    }
?>

<div class="container"><!--contenedor-->
    <?php echo isset($var) ? "<h2>Modificar:</h2>" : "<h2>Registrarse:</h2>" ; ?>
    <form role="form" id="formRegistro" class="form-horizontal" method="POST"  action ="#" accept-charset="utf-8" enctype="multipart/form-data">
        <ul class="nav nav-pills">
            <li class="active"><a href="#basic-tab" data-toggle="tab">Paso 1</a></li>
            <li><a href="#database-tab" data-toggle="tab">Paso 2</a></li>
        </ul>
        <div class="tab-content">         
            <!-- First tab -->
            <div class="tab-pane active" id="basic-tab">
                <div class="form-group">
                    <div class="col-md-3 formRegist">
        	            <label for="apellido" class="sr-only">Apellido:</label>
        	            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo isset($var) ?  $var->apellido : "" ; ?>" size="30">
                    </div>
                    <div class="col-md-4 formRegist">
                        <label for="nombre" class="sr-only">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo isset($var) ?  $var->nombre : "" ; ?>" size="30">
                    </div>               
                </div>           
                <div class="form-group">    
                    <div class="col-md-2 formRegist">
        	           <label for="telefono" class="sr-only">Telefono:</label>
        	           <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo isset($var) ?  $var->telefono : "" ; ?>" size="30">
                    </div>
                    <div class="col-md-5 formRegist">
                        <label for="obra_Soc" class="sr-only">Obra social:</label>
                        <select  class="form-control" name="obra_Soc" id="obra_Soc">
                            <option value="">---Seleccione Obra Social---</option>
            	           <?php 
                                foreach ($ArrayDeObraSoc as $obraSoc){
                                    if($obraSoc->estado!="Suspendido")
                                    {

                                        echo "<option value='".$obraSoc->obra_Soc."'";
                                        if(!empty($var))
                                        {
                                            if($obraSoc->obra_Soc==$var->obra_Soc)
                                            {
                                                echo "selected";        
                                            }
                                        }
                                        echo ">".$obraSoc->obra_Soc."</option>";    
                                    }     
                                }
                                echo "</select> ";
                            ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-3 formRegist">
        	           <label for="provincia" class="sr-only">Provincia:</label>
        	           <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" value="<?php echo isset($var) ?  $var->provincia : "" ; ?>" size="30">
                    </div>
                    <div class="col-md-4 formRegist">
        	           <label for="localidad" class="sr-only">Localidad:</label>
        	           <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Localidad" value="<?php echo isset($var) ?  $var->localidad : "" ; ?>" size="30">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8 formRegist">
        	           <label for="direccion" class="sr-only">Direccion:</label>
        	           <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo isset($var) ?  $var->direccion : "" ; ?>" size="30">
                    </div>                
                </div>            
            </div>
            <!-- Second tab -->
            <div class="tab-pane" id="database-tab">
                <div class="form-group">    
                    <div class="col-md-7 formRegist">
                        <label for="foto" >Foto de perfil:</label>
                        <input type="hidden" id="f1" name="f1" value="<?php echo isset($var) ? $var->foto : "";?>"/>
                        <input type="file"  id="foto" name="foto" placeholder="Foto" size="30" accept="image/*"><br>
                        <center><img class="avatar" src="uploads/<?php echo isset($var) ? $var->foto : "porDefecto.jpg" ; ?>" id="img_destino"/>
                        <p style="  color: black;">*La foto se actualiza al guardar.</p></center>
                    </div>
                </div>    
                <div class="form-group">
                    <div class="col-md-7 formRegist" id="cor">
        	            <label for="correo" class="sr-only">Correo:</label>
        	            <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo isset($var) ?  $var->correo : "" ; ?>" <?php echo isset($var) ?  "readonly": "" ; ?> size="30">
                        <div id="msgUsuario">   
                        </div>   
                    </div>
                </div>
                <?php 
                if(!isset($_SESSION['registrado']))
                {

                echo "
                <div class='form-group'> 
                    <div class='col-md-7 formRegist' id='cor1'>
                       <label for='contrasena' class='sr-only'>Password:</label>
                       <input type='password' class='form-control' id='contrasena' name='contrasena' placeholder='Password' size='30'>
                    </div>
                </div>
                <div class='form-group'>    
                    <div class='col-md-7 formRegist'>
                       <label for='contrasena1' class='sr-only'>Confirmar Password:</label>
                       <input type='password' class='form-control' id='contrasena1' id='contrasena1' name='contrasena1' placeholder='Repita password' size='30'>
                    </div>    
                </div>  ";
            }else{

                    if(usuario::validarCategoria($_SESSION['registrado'])==1)
                    {
                    echo " 
                <div class='form-group'> 
                    <div class='col-md-4 formRegist'>
                        <label for='obra_Soc' class='sr-only'>Categoria:</label>
                        <select  class='form-control' name='categoria' id='categoria'>
                            <option value=''>---Seleccione categoria---</option>
                         ";  
                                foreach ($ArrayDeCategoria as $categoria){

                                        echo "<option value='".$categoria->categoria."'";
                                        if($categoria->categoria==$var->categoria)
                                        {
                                            echo "selected";
                                        }
                                        echo ">".$categoria->categoria."</option>";     
                                }
            echo"     </select>
                    </div>
                </div>";?>
                        <div id='medico'>
                            <div class='form-group'>    
                                <div class='col-md-3 formRegist'>
                                    <label for='matricula' class='sr-only'>Matricula:</label>
                                    <input type='text' class='form-control' id='matricula' name='matricula' placeholder='Matricula' value='<?php echo !empty($var1) ? $var1->matricula:""; ?>' size='30'<?php echo !empty($var1) ? "readonly":""; ?>/>
                                </div>
                            </div>
                            <div class='form-group'>    
                                <div class='col-md-3 formRegist'>
                                    <label for='dia' class='sr-only'>Dia:</label>
                                    <h3>Dia:</h3><br>
                                        <input type='radio' name='dia' id='dia' value='lu' <?php echo (!empty($var1)&&$var1->dia=="lu")? "checked":"checked" ;?> > Lunes<br>
                                        <input type='radio' name='dia' id='dia' value='ma' <?php echo (!empty($var1)&&$var1->dia=="ma")? "checked":"" ;?>> Martes<br>
                                        <input type='radio' name='dia' id='dia' value='mi' <?php echo (!empty($var1)&&$var1->dia=="mi")? "checked":"" ;?>> Miercoles<br>
                                        <input type='radio' name='dia' id='dia' value='ju' <?php echo (!empty($var1)&&$var1->dia=="ju")? "checked":"" ;?>> jueves<br>
                                        <input type='radio' name='dia' id='dia' value='vi' <?php echo (!empty($var1)&&$var1->dia=="vi")? "checked":"" ;?>> Viernes<br>  
                                </div>    
                                <div class='col-md-3 formRegist'>
                                    <label for='horario' class='sr-only'>Horario:</label>
                                    <select  class='form-control' name='horario' id='horario'>
                                        <option value='mañana' <?php echo (!empty($var1)&&$var1->horario=="mañana")? "selected":"selected" ;?> >Mañana</option>
                                        <option value='tarde' <?php echo (!empty($var1)&&$var1->horario=="tarde")? "selected":"" ;?> >Tarde</option>
                                    </select>
                                </div>
                            </div>                                                
                        </div>                      
            <?php   }
                }    

                ?>
  
                <input type="hidden"  id="estado" name="estado" value=""/>
                <!--button type="button" name="enviar" id="enviar" onclick="darAltaUser()" class="btn btn-default">Enviar</button-->
            </div>
                <!-- Previous/Next buttons -->
            <div class="form-group">
                <div class="col-md-8 formRegist">
                    <ul class="pager wizard" >
                        <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                        <li class="next"><a href="javascript: void(0);">Next</a></li>
                    </ul>
                </div>
            </div>    
        </div>    
    </form>
</div><!--FIN contenedor-->

<script>

    $(document).ready(function() {

         if($("#categoria").val()=="clinico")
         {
            $("#medico").show();
            //alert($("#categoria").val());
         }else
         {
            $("#medico").hide();
         } 
//Muestra la imagen al momento de seleccionarla
        function mostrarImagen(input) {
         if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
           $('#img_destino').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
         }
        }
         
        $("#foto").change(function(){
         mostrarImagen(this);
        });
//

// SELECT clinico
        $("#categoria").change(function(){
         if($("#categoria").val()=="clinico")
         {
            $("#medico").show(1000);
            //alert($("#categoria").val());
         }else
         {
            $("#medico").hide(1000);
         }
        });

//

    //Valida cuando pierde foco si correo esta registrado
        $('#correo').focusout(function() {
            if(!$('#correo').attr("readonly")) {
                $.ajax({
                        type: "POST",
                        url: "partes/validar.php",
                        data: {correo:$('#correo').val()},
                        beforeSend: function(){
                            $('#msgUsuario').html('<img src="picture/loader.gif"/> verificando');
                        },
                        success: function( respuesta ){
                            //alert(respuesta);
                        if(respuesta == '1')
                            $('#msgUsuario').html("<label for='correo' style='color:red;'>Correo registrado</label>");
                        else
                            $('#msgUsuario').html("<label for='correo' style='color:green'>Disponible</label>");
                        }
                        });
            }
        });
        ///////////////////////////////////////////////////////
        $("#correo").click(function(){
            $("#cor").removeClass("has-error");
        });
        $("#contrasena").focus(function(){
            $("#cor1").removeClass("has-error");
        });
        // You don't need to care about this function
        // It is for the specific demo
        /*function adjustIframeHeight() {
            var $body   = $('body'),
            $iframe = $body.data('iframe.fv');
            if ($iframe) {
                // Adjust the height of iframe
                $iframe.height($body.height());
            }
        }*/
        $('#formRegistro')
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
                    matricula: {
                        validators: {
                            notEmpty: {
                                message: 'La matricula es requerida'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'La matricula solo puede contener n�meros' 
                            }
                        }
                    },                    
                    nombre: {
                        validators: {
                            notEmpty: {
                                message: 'El nombre es requerido'
                            }
                        }
                    },
                    apellido: {
                        validators: {
                            notEmpty: {
                                message: 'EL apellido es requerido'
                            }
                        }
                    },
                    telefono: {
                        validators: {
                            notEmpty: {
                                message: 'El telefono es requerido'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'El teléfono solo puede contener números' 
                            }
                        }
                    },
                    obra_Soc: {
                        validators: {
                            notEmpty: {
                                message: 'tipo de Obra Social es requerida'
                            }
                        }
                    },
                    provincia: {
                        validators: {
                            notEmpty: {
                                message: 'La provincia es requerida'
                            }
                        }
                    },
                    localidad: {
                        validators: {
                            notEmpty: {
                                message: 'La localidad es requerida'
                            }
                        }
                    },
                    direccion: {
                        validators: {
                            notEmpty: {
                                message: 'La direccion es requerido'
                            }
                        }
                    },
                    contrasena: {
                        validators: {
                            notEmpty: {
                                message: 'La contraseña es requerida'
                            },
                            stringLength: {
                                min: 6,
                                message: 'El password debe contener al menos 6 caracteres'
                            }    
                        }
                    },                                                                                                 
                    correo: {
                        validators: {
                            notEmpty: {
                                message: 'El correo es requerido'
                            },
                            emailAddress: {
                                message: 'El correo no es valido'
                            }
                        }
                    }
                }
            })
            .bootstrapWizard({
                tabClass: 'nav nav-pills',
                onTabClick: function(tab, navigation, index) {
                    return validateTab(index);
                },
                onNext: function(tab, navigation, index) {
                    var numTabs    = $('#formRegistro').find('.tab-pane').length,
                    isValidTab = validateTab(index - 1);
                    if (!isValidTab) {
                        return false;
                    }
                    if (index === numTabs) {
                        // We are at the last tab
                        // Uncomment the following line to submit the form using the defaultSubmit() method
                        //$('#formRegistro').formValidation('defaultSubmit');
                        darAltaUser();    
                        // For testing purpose
                        //$('#completeModal').modal();
                    }
                    return true;
                },
                onPrevious: function(tab, navigation, index) {
                    return validateTab(index + 1);
                },
                onTabShow: function(tab, navigation, index) {
                    // Update the label of Next button when we are at the last tab
                    var numTabs = $('#formRegistro').find('.tab-pane').length;
                    $('#formRegistro')
                        .find('.next')
                        .removeClass('disabled')    // Enable the Next button
                        .find('a')
                        .html(index === numTabs - 1 ? 'Guardar' : 'Next');
                        // You don't need to care about it
                        // It is for the specific demo
                        //adjustIframeHeight();
                }
            });
            function validateTab(index) {
                var fv  = $('#formRegistro').data('formValidation'), // FormValidation instance
                // The current tab
                $tab = $('#formRegistro').find('.tab-pane').eq(index);
                // Validate the container
                fv.validateContainer($tab);
                var isValidStep = fv.isValidContainer($tab);
                if (isValidStep === false || isValidStep === null) {
                    // Do not jump to the target tab
                    return false;
                }
                return true;
            }
    });
</script>
