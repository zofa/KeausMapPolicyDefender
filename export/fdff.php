<html>
<head>
<?php
require_once('hrv.php');
require_once('tcpdf.php');
$db =mysql_connect("192.168.1.74","india","indiaICG2013","prices");
$select=mysql_select_db("prices",$db);

$upit = "SELECT * FROM crawl";
$result = mysql_query($upit);

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Kraus');
$pdf->SetTitle('List');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../images/images.jpg';
        $this->Image($image_file, 15, 5, 30, '', 'jpg', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 10);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF('l', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Assuni');
$pdf->SetTitle('Lista djelatnika na terenu');
$pdf->SetSubject('Subject');
$pdf->SetKeywords('TCPDF, PDF, tablica, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 18);

// add a page
$pdf->AddPage();

$tbl_header = '<style>
table {
   border-collapse: collapse;
   border-spacing: 0;
   margin: 0 10px;
}
tr {
   padding: 3px 0;
}

th {
   background-color: #CCCCCC;
   border: 1px solid #F5820F;
   color: #333333;
   font-family: trebuchet MS;
   font-size: 40px;
   padding-bottom: 4px;
   padding-left: 6px;
   padding-top: 5px;
   text-align: left;
}
td {
   background-color: #EEEEEE;
   border: 1px solid #F5820F;
   font-size: 35px;
   color: #5511FF;
   padding: 3px 7px 2px;
}
</style>
<table id="gallerytab" width="950" cellspacing="0" cellpadding="7" border="0">
<tr>
   <!-- <tr><th><font face="Arial, Helvetica, sans-serif">RASPORED DJELATNIKA NA    TERENU</font></th></tr> -->
       <th><font face="Arial, Helvetica, sans-serif">id</font></th>
       <th><font face="Arial, Helvetica, sans-serif">date_executed</font></th>
    
     </tr>';
$tbl_footer = '</table>';
$tbl = '';

while ($row= mysql_fetch_assoc($result)) {
$tbl .= '
   <tr>
       <td>'.$row['id'].'</td>    
       <td>'.$row['date_executed'].'</td>
     
   </tr>
';
}
// output the HTML content
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
//$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('tablica_teren.pdf', 'I');
?>
</head>
</html>