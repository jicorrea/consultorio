<?php
require_once('fpdf/fpdf.php');

class PDF extends FPDF
{
   //Cabecera de página
   function Header()
   {

       $logo = "picture/logo.png"; 

       $this->Image($logo,11,11,33);

   }
}


?> 