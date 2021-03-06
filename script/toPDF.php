<?php
  require_once "/home/ann2/ferrierl/public_html/Projet-PHP/lib/File.php";

  $model_path_array = array('components/fpdf/fpdf.php');
  require_once File::build_Path($model_path_array); 
  $livraison = $_POST['livraison'];
  $facturation = $_POST['facturation'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,10,'Facture',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// for($i=1;$i<=4;$i++)
//     $pdf->Cell(0,10,'Impression de la ligne numéro '.$i,0,1);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'Adresse de livraison :',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,$livraison,0,1);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'Adresse de facturation :',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,$facturation,0,1);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'Nom :',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,$nom,0,1);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'Prenom :',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,$prenom,0,1);
$pdf->Output();
?>