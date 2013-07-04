<html>
<body>

<?php
include('db.php');
$web_id = $_REQUEST['website_id'];
$dbTable="";
	$sql = 
"select prices.crawl_results.website_id,
domain,
website.name as wname,
catalog_product_flat_1.entity_id,
catalog_product_flat_1.name,
crawl_results.vendor_price,
crawl_results.map_price,
crawl_results.violation_amount,
website_id,
crawl_results.website_product_url
from website
inner join
prices.crawl_results
on prices.website.id = prices.crawl_results.website_id
inner join catalog_product_flat_1
on catalog_product_flat_1.entity_id=crawl_results.product_id
where crawl_results.violation_amount>0.05 
and website_id = $web_id
order by violation_amount desc";
	$result = mysql_query($sql)	or die("Couldn't execute query:<br>".mysql_error().'<br>'.mysql_errno());

	//header('Content-Type: application/vnd.ms-excel');	
	//header('Content-Disposition: attachment; filename='.$dbTable.'-'.date('Ymd'));
	header("Content-Type: application/pdf");
     header('Content-Disposition:attachment; filename="testing.pdf"'); //view in browser
	header('Pragma: no-cache');
	header('Expires: 0');

	echo '<table><tr>';
	for ($i = 0; $i < mysql_num_fields($result); $i++)	 
		echo '<th>'.mysql_field_name($result, $i).'</th>';
	print('</tr>');

	while($row = mysql_fetch_row($result))
	{
		
		$output = '<tr>';
		for($j=0; $j<mysql_num_fields($result); $j++)
		{
			if(!isset($row[$j]))
				$output .= '<td>&nbsp;</td>';
			else
				$output .= "<td>$row[$j]</td>";
		}
		print(trim($output))."</tr>\t\n";
	}
	echo('</table>');
?>

</body>
</html>