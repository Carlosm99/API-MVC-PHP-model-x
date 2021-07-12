<?php

require('fpdf/fpdf.php');
require('controller2.php');


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
   /// $this->Cell(30,10,'reporteg Generado',1,0,'C');
   $this->Cell(30,10,'reporte Generado','C');
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
}

function headerTable(){
    $this->SetFont('Times','B',8);
    $this-> cell(20,10,'BuslineName',1,0,'C');
    $this-> cell(20,10,'Origen',1,0,'C');
    $this-> cell(30,10,'Destino',1,0,'C');
    $this-> cell(30,10,'Inicial_origen',1,0,'C');
    $this-> cell(30,10,'Inicial_destino',1,0,'C');
    $this-> cell(30,10,'Hora_de_partida',1,0,'C');
     $this-> cell(30,10,'dias_de_operacion',1,0,'C');
     $this->Ln();
}

function viewTable()
{
	$db=Db::conectar();
    $this->SetFont('Times','B',8);
    $select =$db->query('SELECT BuslineName ,Origen, Destino, Inicial_origen,Inicial_destino,Hora_de_partida,dias_de_operacion FROM busline Join corridas  ON busline.id_busline = corridas.id_busline ORDER BY `corridas`.`Inicial_destino` ASC');
    while($data =  $select ->fetch(PDO::FETCH_OBJ)){
        $this-> cell(20,10, $data -> BuslineName,1,0,'L');
        $this-> cell(20,10, $data -> Origen,1,0,'L');
        $this-> cell(30,10, $data -> Destino,1,0,'L');
        $this-> cell(30,10, $data -> Inicial_origen,1,0,'L');
        $this-> cell(30,10, $data -> Inicial_destino,1,0,'L');
        $this-> cell(30,10, $data -> Hora_de_partida,1,0,'L');
        $this-> cell(30,10, $data -> dias_de_operacion,1,0,'L');
        $this->Ln();
         


        
    }
 
    
}

 

}



    $pdf = new PDF();
    $pdf->AddPage();
    
    $pdf->headerTable();
    $pdf->viewTable();
    ///$pdf->Cell(40,10,'hola este es un prueba!');
    $pdf->Output();
    
 

   
?>