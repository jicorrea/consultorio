<?php
    require_once('AccesoDatos.php');

class turno
{

  public $id;
  public $medico;
  public $paciente;
  public $fecha;
  public $horario;
  

  public static function TraerTurnos()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM turno");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "turno"); 
  }


  public function GuardarTurno()
  {
    $var=medico::TraerUnTurno($this->id);
    
    if(empty($var)) //empty si esta vacia la variable
    {
          
      $this->InsertarTurno();
        
    }else
    {
        
      $this->ModificarTurno();
      
    }
  }


  public static function TraerUnTurno($paciente,$medico,$fecha)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM turno where paciente=:paciente and medico=:medico and fecha=:fecha");
     
    $consulta->bindValue(':paciente',$paciente, PDO::PARAM_STR);

    $consulta->bindValue(':medico',$medico, PDO::PARAM_STR);

    $consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('turno');
     
    return $usuarioBuscado; 
  }


  public static function TraerTurnosId($id)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM turno where id=:id");
     
    $consulta->bindValue(':id',$id, PDO::PARAM_INT);         
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('turno');
     
    return $usuarioBuscado; 
  }


  public function InsertarTurno()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO turno (medico,paciente,fecha,horario)values(:medico,:paciente,:fecha,:horario)");
       
    //$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
       
    $consulta->bindValue(':medico', $this->medico, PDO::PARAM_STR);
       
    $consulta->bindValue(':paciente', $this->paciente, PDO::PARAM_STR);
      
    $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);

    $consulta->bindValue(':horario', $this->horario, PDO::PARAM_STR);

    $consulta->execute();       
        
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
  }
   

  public static function eliminarTurno($id)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM turno WHERE id=:id");
    
    $consulta->bindValue(':id', $id, PDO::PARAM_INT);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }

   public static function eliminarMedicoTurno($medico)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM turno WHERE medico=:medico");
    
    $consulta->bindValue(':medico', $medico, PDO::PARAM_STR);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }


  public function ModificarTurno()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE turno SET paciente=:paciente, fecha=:fecha WHERE id=:id");
    
    $consulta->bindValue(':id',$this->id, PDO::PARAM_STR);
       
    $consulta->bindValue(':paciente', $this->paciente, PDO::PARAM_STR);
       
    $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
      
    
    return $consulta->execute();
  }

} //FIN clase turno

?>