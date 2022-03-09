<?php
namespace App\Classes;
use App\SystemSetup;
ob_start();

class CreatePage extends PDF_MC_Table{ 
    // Page header
    public function Header(){
      $setup = SystemSetup::take(1)->get()->first();
        // Logo
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        // Title
         $this->SetFont('Times','B',12);
         $this->Cell(00,00,"",0,1,'C',false);
         $this->ln();
         
        // Line break
        $this->Ln(3);
    }
    public function studentInfoHeader(){
      // Logo
      //$this->Image(public_path('assets/images/logo-colored.png'),10,6,60);
      // Arial bold 15
      $this->SetFont('Arial','B',15);
      // Move to the right
      // Title
       $this->SetFont('Times','B',12);
       $this->Cell(00,00,"",0,1,'C',false);
       $this->ln();
       
      // Line break
      $this->Ln(3);
  }
    public function RotatedText($x, $y, $angle){
         //Text rotated around its origin
          $this->Rotate($angle,$x,$y);
          $this->Text($x,$y,"LEAD IT AFRICA");
          $this->Rotate(0);
     }
    public function Footer(){
      // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Times','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
}
ob_end_flush();
?>