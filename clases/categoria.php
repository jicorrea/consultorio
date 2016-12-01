<?php
    require_once('AccesoDatos.php');


class categoria
{

  public $categoria;  

  public static function TraerCategorias()
  {
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM categorias");
            
    $consulta->execute();           
            
    return $consulta->fetchAll(PDO::FETCH_CLASS, "categoria"); 
  }



} //FIN clase categoria

?>