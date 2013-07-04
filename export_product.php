<html>
<body>
 <?php
include('db.php');
$sku_name = $_REQUEST['sku_id'];
$dbTable="";
	$sql = "SELECT
catalog_product_flat_1.sku,website.name as wname,
website.domain,
crawl_results.vendor_price,
crawl_results.map_price,
crawl_results.violation_amount,
crawl_results.website_product_url
FROM
crawl_results
inner join catalog_product_flat_1
on
crawl_results.product_id= catalog_product_flat_1.entity_id
inner join website
on
crawl_results.website_id= website.id
where crawl_results.violation_amount>0.05 and
sku like '$sku_name'
order by violation_amount desc";

	$result = mysql_query($sql)	or die("Couldn't execute query:<br>".mysql_error().'<br>'.mysql_errno());

	header('Content-Type: application/vnd.ms-excel');	//define header info for browser
	header('Content-Disposition: attachment; filename='.$dbTable.'-'.date('Ymd'));
	header('Pragma: no-cache');
	header('Expires: 0');

	echo '<table><tr>';
	for ($i = 0; $i < mysql_num_fields($result); $i++)	 // show column names as names of MySQL fields
		echo '<th>'.mysql_field_name($result, $i).'</th>';
	print('</tr>');

	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // you can enable this if you have lot of data
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