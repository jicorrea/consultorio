<?php
    require_once('AccesoDatos.php');


class obraSoc
{

  public $obra_Soc;
  public $estado;
  public $fec_Reg;
  public $fec_Mod;
  

  public static function TraerObraSoc()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM obrasoc");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "obraSoc"); 
  }


  public function GuardarObraSoc()
  {
    $var=usuario::TraerUnaObraSoc($this->obra_Soc);
    
    if(empty($var)) //empty si esta vacia la variable
    {
          
      $this->InsertarObraSoc();
        
    }else
    {
        
      $this->ModificarObraSoc();
      
    }
  }


  public static function TraerUnaObraSoc($obraSoc)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
     
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM obrasoc where obra_Soc=:obra_Soc");
     
    $consulta->bindValue(':obra_Soc',$obra_Soc, PDO::PARAM_STR);            
    
    $consulta->execute();           
     
    $usuarioBuscado= $consulta->fetchObject('obraSoc');
     
    return $usuarioBuscado; 
  }



  public function InsertarObraSoc()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        
    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO obrasoc (obra_Soc,estado,fec_Reg,fec_Mod)values(:obra_Soc,:estado,:fec_Reg,:fec_Mod)");
       
    $consulta->bindValue(':obra_Soc',$this->obra_Soc, PDO::PARAM_STR);
       
    $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
       
    $consulta->bindValue(':fec_Reg', $this->fec_Reg, PDO::PARAM_STR);
      
    $consulta->bindValue(':fec_Mod', $this->fec_Mod, PDO::PARAM_STR);

    $consulta->execute();       
        
    return $objetoAccesoDato->RetornarUltimoIdInsertado();
  }
   

  public static function eliminarObraSoc($obra_Soc)
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM obraSoc WHERE obra_Soc=:obra_Soc");
    
    $consulta->bindValue(':obra_Soc', $obra_Soc, PDO::PARAM_STR);
    
    $consulta->execute();
    //$provBuscado= $consulta->fetchObject('voto');
   // return $provBuscado;
  }


  public function ModificarObraSoc()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    
    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE obraSoc SET estado=:estado, fec_Reg=:fec_Reg, fec_Mod=:fec_Mod WHERE obra_Soc=:obra_Soc");
    
    $consulta->bindValue(':obra_Soc',$this->obra_Soc, PDO::PARAM_STR);
       
    $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
       
    $consulta->bindValue(':fec_Reg', $this->fec_Reg, PDO::PARAM_STR);
      
    $consulta->bindValue(':fec_Mod', $this->fec_Mod, PDO::PARAM_STR);
    
    return $consulta->execute();
  }

} //FIN clase obraSoc

?>