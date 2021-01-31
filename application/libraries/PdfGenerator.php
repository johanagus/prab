<?php
 use Dompdf\Dompdf;
 
class PdfGenerator
{
  public function generate($html,$filename)
  {
   
    $dompdf = new Dompdf();
    $dompdf->loadHtml('<h1>Hello WAWAN </h1>');
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>1));
  }
}

