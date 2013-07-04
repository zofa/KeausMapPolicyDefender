<?php
require('fpdf.php');
$d=date('d_m_Y');
 

 
class PDF extends FPDF
{
 
function Header()
{
    //Logo
$name="Testing PDF Creation";
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(20,40,"Data Generated For $name on ".date('d-m-Y'),0,0,'C');
//$this->SetFont('Arial','B',9);
$this->Cell(10,60,"Test Place 1",0,0,'C');
$this->Cell(-10,70,"Test Place 2",0,0,'C');
    //Line break
    $this->Ln(20);
}
 
//Page footer
function Footer()
{
   
}
 
//Load data
function LoadData($file)
{
//Read file lines
$lines=file($file);
$data=array();
foreach($lines as $line)
$data[]=explode(';',chop($line));
return $data;
}
 
//Simple table
function BasicTable($header,$data)
{ 
 
$this->SetFillColor(255,0,0);
$this->SetDrawColor(128,0,0);
$w=array(30,15,20,10,10,10,10,10,15,15,15,15,15);
 
//Header
for($i=0;$i<count($header);$i++)
$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
$this->Ln();
//Data
foreach ($data as $eachResult) 
{ //width
$this->Cell(30,6,$eachResult["bookstall_id"],1);
$this->Cell(15,6,$eachResult["name"],1);
$this->Cell(20,6,$eachResult["location"],1);
$this->Cell(10,6,$eachResult["address"],1);
$this->Cell(10,6,$eachResult["telephone"],1);
$this->Ln();
 
}
}
 
//Better table
}
 
$pdf=new PDF();
$header=array('Name','Date','Transaction Data','Failed Trasactions','Banks Transffered');
//Data loading
//*** Load MySQL Data ***//

include "db.php";
$sku_name = $_REQUEST['sku_id'];
$dbTable="";
	$sql = "select id from crawl LIMIT 0,20";




$result = mysql_query($sql);
if(!$result)
{
	echo "error";
}
else
{
	
$resultData = array();
for ($i=0;$i<mysql_num_rows(mysql_query($sql));$i++) {
$result1 = mysql_fetch_array(mysql_query($sql));
array_push($resultData,$result1);
}}
//************************//
 
 
function forme()
 
{
$d=date('d_m_Y');
echo "PDF generated successfully. To download document click on the link >> <a href=".$d.".pdf>DOWNLOAD</a>";
}
 
 
$pdf->SetFont('Arial','',6);
 
//*** Table 1 ***//
$pdf->AddPage();
$pdf->Image('images.jpg',80,8,33);
$pdf->Ln(35);
$pdf->BasicTable($header,$resultData);
forme();
$pdf->Output("$d.pdf","F");
 
?>