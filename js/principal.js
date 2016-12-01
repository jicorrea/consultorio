//Desplazamiento EFECTO
$(document).ready(function(){
              $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {      
                   
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                   
                  if (target.length) {
                    $('html, body').animate({
                      scrollTop: target.offset().top
                    }, 1000);
                    return false;
                  }

                }
              });

              $("#login").load("partes/botonDeslogear.php");          
              $("#contacto").load("partes/contacto.php");
              var myCenter = new google.maps.LatLng(-34.6623101, -58.36470509999998);//LatLng UTN Ave.

              function initialize() {
                                      var mapProp = {
                                                      center:myCenter,
                                                      zoom:16,
                                                      scrollwheel:false,
                                                      draggable:false,
                                                      mapTypeId:google.maps.MapTypeId.ROADMAP
                                      };

                                      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

                                      var marker = new google.maps.Marker({
                                                                            position:myCenter,
                                                                             //icon:'pinkball.png',
                                                                            animation:google.maps.Animation.BOUNCE
                                      });

                                      marker.setMap(map); 
                                      
                                      //mostrar Modal 
                                      var modal = document.getElementById('id01');

                                      // When the user clicks anywhere outside of the modal, close it
                                      window.onclick = function(event) {
                                                                          if (event.target == modal) {
                                                                            modal.style.display = "none";
                                                                          }
                                      }
                                      //FIN mostrar Modal                          
                                      
                                      //sessionStorage.setItem("Usuario",user);
                                      var session = sessionStorage.getItem("Usuario");
                                      if(session==null){
                                        //mostrar boton de inicio de login
                                        $("#login").removeClass("hidden"); 
                                      }else{
                                        //no mostrar boton de login
                                        $("#login").addClass("hidden");
                                      }
                                      
                                      query=window.location.search.substring(1);
                                      q=query.split("&");
                                      vars=[];
                                      for(i=0;i<q.length;i++){
                                        x=q[i].split("=");
                                        k=x[0];
                                        v=x[1];
                                        vars[k]=v;
                                      }
                                     if(vars['est']=="ok"){
                                        $('#info').load('partes/msg.php?titulo=Registro&msj=%Completo%con%exito%su%registro%!');
                                      }
                                     if(vars['est']=="completo"){
                                        $('#info').load('partes/msg.php?titulo=Realizado&msj=%Link%ya%usado.');
                                      }
                                     if(vars['est']=="error"){
                                        $('#info').load('partes/msg.php?titulo=Error&msj=%Error%pongase%en%contacto%con%nosotros.');
                                      }                                      
                                      //alert(vars['est']);
              }

              google.maps.event.addDomListener(window, 'load', initialize);

  //FIN ubicacion MAPA
});
//FIN Desplazamiento EFECTO
  
  //ubicacion MAPA
  
  
