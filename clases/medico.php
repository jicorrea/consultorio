<?php
    require_once('AccesoDatos.php');

class medico
{

  public $matricula;
  public $correo;
  public $dia;
  public $horario;
  

  public static function TraerMedicos()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM medico");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "medico"); 
  }


  public function GuardarMedico()
  {
    $var=medico::TraerUnMedico($this->correo);
    
    if(empty($var)) //empty si esta vacia la variable
    {
          
      $this->InsertarMedico();
        
    }else
    {
        
      $this->ModificarMedico();
      
    }
  }


  public static function TraerUnMedico($correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM medico where correo=:correo");
     
    $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('medico');
     
    return $usuarioBuscado; 
  }

    public static function TraerUnMedicoMatricula($matricula,$correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM medico where matricula=:matricula && correo=:correo");
     
    $consulta->bindValue(':matricula',$matricula, PDO::PARAM_INT); 

     $consulta->bindValue(':correo',$correo, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('medico');
     
    return $usuarioBuscado; 
  }



  public function InsertarMedico()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO medico (matricula,correo,dia,horario)values(:matricula,:correo,:dia,:horario)");
       
    $consulta->bindValue(':matricula',$this->matricula, PDO::PARAM_STR);
       
    $consulta->bindValue(':correo', $this->correo, PDO::PARAM_STR);
       
    $consulta->bindValue(':dia', $this->dia, PDO::PARAM_STR);
      
    $consulta->bindValue(':horario', $this->horario, PDO::PARAM_STR);

    $consulta->execute();       
        
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
  }
   

  public static function eliminarMedico($correo)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM medico WHERE correo=:correo");
    
    $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }


  public function ModificarMedico()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE medico SET dia=:dia, horario=:horario WHERE matricula=:matricula");
    
    $consulta->bindValue(':matricula',$this->matricula, PDO::PARAM_STR);
       
    $consulta->bindValue(':dia', $this->dia, PDO::PARAM_STR);
       
    $consulta->bindValue(':horario', $this->horario, PDO::PARAM_STR);
      
    
    return $consulta->execute();
  }

} //FIN clase medico

?>