
<?php
$con=mysql_connect("192.168.1.74","india","indiaICG2013","prices");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("prices", $con);

$result = mysql_query("select
count(*) as Count,
sites.name as Seller
from crawl_results res
inner join catalog_product_flat_1 prods on prods.entity_id = res.product_id
inner join website sites on sites.id = res.website_id
where
violation_amount > 0.05
and
res.crawl_id = (Select max(id) from crawl)
group by sites.name
order by 1 desc
limit 0,10");

while($row = mysql_fetch_array($result)) {
  echo $row['Seller'] . "\t" . $row['Count']. "\n";
}

mysql_close($con);
?> 
