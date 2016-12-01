<?php
require_once("AccesoDatos.php");

class usuario
{

  public $correo;
  public $contrasena;
  public $apellido;
  public $nombre;
  public $telefono;
  public $obra_Soc;
  public $provincia;
  public $localidad;
  public $direccion;
  public $foto;
  public $fec_Reg;
  public $activation_key;
  public $validated;
  public $fec_Ing;
  public $categoria; //se agrego una nueva columna 
  
  public static function TraerUsuarios()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario"); 
  }


  public function GuardarUsuario()
  {
    $var=usuario::TraerUnUsuario($this->correo);
    
    if(empty($var)) //empty si esta vacia la variable
    {
          
      $this->InsertarUsuario();
        
    }else
    {
        
      $this->ModificarUsuario();
      
    }
  }


  public static function TraerUnUsuario($correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo=:correo");
     
    $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('usuario');
     
    return $usuarioBuscado; 
  }



  public function InsertarUsuario()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (correo,contrasena,apellido,nombre,telefono,obra_Soc,provincia,localidad,direccion,foto,fec_Reg,activation_key,validated,fec_Ing,categoria)values(:correo,:contrasena,:apellido,:nombre,:telefono,:obra_Soc,:provincia,:localidad,:direccion,:foto,:fec_Reg,:activation_key,:validated,:fec_Ing,:categoria)");
       
    $consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
       
    $consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
       
    $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
      
    $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
       
    $consulta->bindValue(':telefono', $this->telefono, PDO::PARAM_INT);
        
    $consulta->bindValue(':obra_Soc', $this->obra_Soc, PDO::PARAM_STR);
        
    $consulta->bindValue(':provincia', $this->provincia, PDO::PARAM_STR);
        
    $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        
    $consulta->bindValue(':direccion', $this->direccion, PDO::PARAM_STR);
        
    $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

    $consulta->bindValue(':fec_Reg', $this->fec_Reg, PDO::PARAM_STR);

    $consulta->bindValue(':activation_key', $this->activation_key, PDO::PARAM_STR);
        
    $consulta->bindValue(':validated', $this->validated, PDO::PARAM_INT);

    $consulta->bindValue(':fec_Ing', $this->fec_Ing, PDO::PARAM_STR);

    $consulta->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);    

    $consulta->execute();       
        
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
  }
   

  public static function validarUsuario($correo,$contrasena)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE correo=:correo && contrasena =:contrasena");
    
    $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
    
    $consulta->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
    
    $consulta->execute();
    
    $usuarioBuscado= $consulta->fetchObject('usuario');
    
    return $usuarioBuscado;
  }
  

  public static function eliminarUsuario($correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from usuarios where correo =:correo");
    
    $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }

    public static function activation_key($activation_key)
  {
   
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from usuarios where activation_key=:activation_key");
    
    $consulta->bindValue(':activation_key', $activation_key, PDO::PARAM_STR);

    $consulta->execute();

    $usuarioBuscado= $consulta->fetchObject('usuario');
     
    return $usuarioBuscado; 
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }


    public static function modificar_validated($activation_key)
  {
    $validated=1;

    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios set validated=:validated where activation_key=:activation_key");
    
    $consulta->bindValue(':activation_key', $activation_key, PDO::PARAM_STR);

    $consulta->bindValue(':validated', $validated, PDO::PARAM_INT);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }


  public function ModificarUsuario()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET telefono =:telefono, obra_Soc =:obra_Soc, apellido =:apellido, nombre =:nombre,provincia =:provincia, localidad =:localidad, direccion =:direccion, foto =:foto,fec_Ing =:fec_Ing, categoria=:categoria WHERE correo =:correo");
    
    $consulta->bindValue(':correo',$this->correo, PDO::PARAM_STR);
       
    //$consulta->bindValue(':contrasena', $this->contrasena, PDO::PARAM_STR);
       
    $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
      
    $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
       
    $consulta->bindValue(':telefono', $this->telefono, PDO::PARAM_INT);
        
    $consulta->bindValue(':obra_Soc', $this->obra_Soc, PDO::PARAM_STR);
        
    $consulta->bindValue(':provincia', $this->provincia, PDO::PARAM_STR);
        
    $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        
    $consulta->bindValue(':direccion', $this->direccion, PDO::PARAM_STR);
        
    $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);

    //$consulta->bindValue(':fec_Reg', $this->fec_Reg, PDO::PARAM_STR);

    //$consulta->bindValue(':validated', $this->validated, PDO::PARAM_INT);
        
    $consulta->bindValue(':fec_Ing', $this->fec_Ing, PDO::PARAM_STR);

    $consulta->bindValue(':categoria', $this->categoria, PDO::PARAM_STR);    
    return $consulta->execute();
  }


  public static function ModificarPsw($correo,$psw)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET contrasena =:psw WHERE correo =:correo");
    
     $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);   
    $consulta->bindValue(':psw', $psw, PDO::PARAM_STR);
       
   
    return $consulta->execute();
  }



    public static function generate_random_key() {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
 
    $new_key = "";
    for ($i = 0; $i < 32; $i++) {
        $new_key .= $chars[rand(0,35)];
    }
    return $new_key;
    }


  public static function validarCategoria($correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT categoria FROM usuarios WHERE correo =:correo");

    $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
            
    $consulta->execute();

    $resultado =$consulta->fetchColumn();

    if($resultado=="admin")
    {
      return 1;
    }else
    {
      return 0;
    }
  }

    public static function enviar_Mail($asunt,$mensaje,$correo)
    {
      $destinatario = $correo; 
      $asunto =$asunt ;//"Finalizar registro consultorio.hol.es"; 
      $cuerpo = ' 
      <html> 
      <head> 
         <title>Gracias por formar parte de nuestra familia</title> 
      </head> 
      <body> 
      '.$mensaje.'
      </body> 
      </html> 
      '; 

      //para el envío en formato HTML 
      $headers = "MIME-Version: 1.0\r\n"; 
      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

      //dirección del remitente 
      $headers .= "From: Administrador consultorio <admin@consultorio.hol.es>\r\n"; 

      //dirección de respuesta, si queremos que sea distinta que la del remitente 
      //$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 

      //ruta del mensaje desde origen a destino 
      //$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 

      //direcciones que recibián copia 
      //$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

      //direcciones que recibirán copia oculta 
      $headers .= "Bcc: admin@consultorio.hol.es\r\n"; 

      mail($destinatario,$asunto,$cuerpo,$headers); 
    }

} //FIN clase usuario

?>