<?php
require_once("AccesoDatos.php");

class resetPass
{

  public $id;
  public $idusuario;
  public $username;
  public $token;
  public $creado;

  public static function TraerResetPass()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM resetpass");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "resetPass"); 
  }


  public function GuardarResetPass()
  {
    $var=usuario::TraerUnResetTK($this->token);
    
    if(empty($var)) //empty si esta vacia la variable
    {
          
      $this->InsertarReset();
        
    }else
    {
        
      $this->ModificarReset();
      
    }
  }


  public static function TraerUnReset($id)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM resetpass WHERE id=:id");
     
    $consulta->bindValue(':id',$id, PDO::PARAM_INT);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('resetPass');
     
    return $usuarioBuscado; 
  }


    public static function TraerUnResetTK($token)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM resetpass WHERE token=:token");
     
    $consulta->bindValue(':token',$token, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('resetPass');
     
    return $usuarioBuscado; 
  }



  public function InsertarReset()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO resetpass (idusuario,username,token,creado)values(:idusuario,:username,:token,:creado)");
       
    //$consulta->bindValue(':id',$this->id, PDO::PARAM_STR);
       
    $consulta->bindValue(':idusuario', $this->idusuario, PDO::PARAM_STR);
       
    $consulta->bindValue(':username', $this->username, PDO::PARAM_STR);
      
    $consulta->bindValue(':token', $this->token, PDO::PARAM_STR);

    $consulta->bindValue(':creado', $this->creado, PDO::PARAM_STR);

    $consulta->execute();       
        
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
  }
   
  public static function eliminarReset($token)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from resetpass WHERE token=:token");
    
    $consulta->bindValue(':token', $token, PDO::PARAM_STR);
    
    $consulta->execute();
  }

} //FIN clase resetPass

?>