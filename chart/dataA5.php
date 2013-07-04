
<?php
$con=mysql_connect("192.168.1.74","india","indiaICG2013","prices");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("prices", $con);

$result = mysql_query("select
count(*) as Violations amount,
DATE_FORMAT(crawl.date_executed, '%Y%
m%
d') as Date
from crawl_results res
inner join catalog_product_flat_1 prods on prods.entity_id = res.product_id
inner join website sites on sites.id = res.website_id
inner join crawl on crawl.id = res.crawl_id
where
violation_amount > 0.05
AND
prods.
sku = @sku
AND
put
dates in single quotes
crawl.
date_executed between @date_from AND @date_to
group by DATE_FORMAT(crawl.date_executed, '%Y%
m%
d')
order by 1 desc");

while($row = mysql_fetch_array($result)) {
  echo $row['Date'] . "\t" . $row['Violations amount']. "\n";
}

mysql_close($con);
?> 