<?php
//if ($_POST['createpdf'])
	//{	
	include('db.php');
	$sku_name = $_REQUEST['sku_id'];
	$table = mysql_fetch_object(mysql_query("SELECT * from crawl limit 0,50"));
 
	date_default_timezone_set('Europe/Oslo');
	$html = ("<html>");
	$html .= ("<head>");
	$html .= ("<style>");
 
        //Here comes some CSS
	$html .= ("
	* {
		font-family: helvetica;
		padding: 0;
		margin: 0;
	}");
 
	$html .= ("</style>");
	$html .= ("</head>");
	$html .= ("<body>");
	$date_today = date('d-m-Y H:i');
 
 
	$html .= ("<h2>Generated PDF</h2>\n");
	$html .= ("<p>$date_today</p>\n");
	$html .= ("</div>");
 
	$html .= ("<p>$table->COMMENT</p>\n");
 
	$html .= ("</body>");
	$html .= ("</html>");
 
	function render($html,$filename)
	{
		require_once("dompdf/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "landscape" ); 
		$dompdf->render();
		$dompdf->stream("$filename.pdf");
	}
 
	$filename = ("GeneratedPDF");
 
	render($html,$filename);

 
 
echo ("<h2>Generate PDF</h2>");
echo ("<form action=\"\" method=\"post\" name=\"form\">\n\n");
 
echo ("<p><input type=\"submit\" class=\"submit\" name=\"createpdf\" value=\"Generate PDF\" />\n");
 
echo ("</form>\n\n");
 
?>