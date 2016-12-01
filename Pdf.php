<?php
    require_once('clases/obraSoc.php');
    require_once('clases/PDF.php');
    require_once('clases/usuario.php');
    require_once('clases/turno.php');

    session_start();

   if(isset($_SESSION['registrado'])) {  

        $var = usuario::TraerUnUsuario($_SESSION['registrado']);
        $arrayT = turno::TraerTurnos();
        $listaUsuario = usuario::TraerUsuarios();

        if(!empty($_GET['correo']))
        {
            if($_GET['correo']==sha1($var->correo))
            {
                $pdf=new PDF();
                $pdf->AddPage();
                $pdf->SetFont('Times','',16);

                $imagen ="uploads/".$var->foto;
                $pdf->SetTextColor(102, 0, 255);
                $pdf->Cell(185,65,'',1,0,'C');//cuadrado
                $pdf->Cell(13,16,$pdf->Image($imagen,50 ,15, 30 , 30)."1",1,2,'C');
                $pdf->Cell(13,16,"2",1,2,'C');
                $pdf->Cell(13,16,"3",1,2,'C');
                $pdf->Cell(13,17,"4",1,0,'C');
                $pdf->SetXY(15, 15);
                $pdf->Cell(75);
                $pdf->SetFillColor(0, 179, 0);
                $pdf->Rect(11, 50, 95, 20, 'F');
                $pdf->Cell(0,0,"consultorio.hol.es",0,1,'L'); //1 al comienzo de la sig linea
                $pdf->Cell(85);
                $pdf->Cell(0,15,"* Obra Social: ".$var->obra_Soc,0,2,'L');
                $pdf->Cell(0,0,"* Apellido y nombre: ".$var->apellido.','.$var->nombre,0,1,'L');
                $pdf->Cell(10,20,"",0,2,'L');
                $pdf->Cell(0,10,"* Direccion: ".$var->provincia.", ".$var->localidad.", ".$var->direccion,0,2,'L');
                $pdf->Cell(0,0,"* Telefono: ".$var->telefono,0,2,'L');
                $pdf->Cell(0,10,"* Correo: ".$var->correo,0,2,'L');
                ob_get_clean();
                $pdf->Output();
            }
        }
    if(!empty($_GET['id']))
    {       
        $turno = 0;
        foreach ($arrayT as $turno) {
            if($_GET['id']==sha1($turno->id))
            {
                $turno = $turno->id;
                break;
            }            
        }

        if(!empty($turno))
        {
            $turnoBuscado = turno::TraerTurnosId($turno);
            $pdf=new PDF();
                $pdf->AddPage();
                $pdf->SetFont('Times','',16);


                $pdf->SetTextColor(102, 0, 255);
                $pdf->Cell(170,100,'',1,0,'C');//cuadrado
                $pdf->SetXY(15, 15);
                $pdf->Cell(75);
                $pdf->SetFillColor(0, 179, 0);
                $pdf->Rect(40, 50, 95, 40, 'F');
                $pdf->Cell(0,0,"consultorio.hol.es",0,1,'L'); //1 al comienzo de la sig linea
                $pdf->Cell(85);
                $pdf->Cell(0,15,"Av Bartolome Mitre 750,",0,2,'L');
                $pdf->Cell(0,0,"     Avellaneda, Buenos Aires",0,1,'L');
                $pdf->SetXY(40, 32);
                $pdf->Cell(10,20,"",0,2,'L');
                $pdf->Cell(0,10,"* Turno num.: ".$turnoBuscado->id,0,2,'L');
                $pdf->Cell(0,0,"* Fecha: ".$turnoBuscado->fecha,0,2,'L');
                $pdf->Cell(0,10,"* Asistir por la: ".$turnoBuscado->horario,0,2,'L');   
                $pdf->Cell(0,0,"* Paciente: ".$var->apellido.','.$var->nombre,0,2,'L');
                $pdf->Cell(0,10,"* Obra social: ".$var->obra_Soc,0,2,'L');
                foreach ($listaUsuario as $usuario){
                    if($usuario->categoria=="clinico" && $usuario->correo==$turnoBuscado->medico)
                    {
                        $pdf->Cell(0,0,"* Medico: ".$usuario->apellido.", ".$usuario->nombre,0,2,'L');
                        break;
                    }
                }
                $pdf->SetXY(100, 100);                   
                $pdf->Cell(0,10,"*Turno por orden de llegada",0,2,'L');
                ob_get_clean();                 
                $pdf->Output();     
        }
    }    
}

?>



