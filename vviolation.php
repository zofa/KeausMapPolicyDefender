<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vendor Violation</title>

<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="js/jquery-1-4-2.min.js"></script> 
 
<script type="text/javascript" src="js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="js/showhide.js"></script> 
<script type="text/JavaScript" src="js/jquery.mousewheel.js"></script> 

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">
</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", 
	orientation: 'h',
	classname: 'ddsmoothmenu',

	contentsource: "markup"
})

</script> 



<?php

include('db.php');
$web_id = $_REQUEST['website_id'];
$result= mysql_query("select website.name as wname 
from website
inner join
crawl_results
on website.id = crawl_results.website_id
where website_id=$web_id");


  while($row = mysql_fetch_array($result)) 
 {      
      $str= $row['wname'];
 }



?>
<link href="css/TBLCSS.css" rel="stylesheet" type="text/css" />
<link href="css/div.css" rel="stylesheet" type="text/css" />


</head>

<body id="home" onLoad="tableSearch.init();">
	    
  <div id="templatemo_main">
  <div id="divp">
	 <h3 align="center"> Products Violated by <?php echo $str; ?> <h3> 
      <a href="vendor.php"><img align="left" src="images/back.png"/> </a>
      <div align="right"><input  type="text" size="30" width="300" hight="40" maxlength="1000" value="" id="textBoxSearch" onkeyup="tableSearch.search(event);"  style="background-image:url(images/sr.png) no-repeat 4px 4px;
	
	border:2px solid #456879;
	border-radius:10px;
	height: 22px;
	width: 230px; "/> <a href="" onclick="tableSearch.runSearch();"><img src="images/sr.png" style="height:20; width:20;"></a>

                    <?php echo "<a class="."button_example"." href="."export_vendor.php?website_id=".$web_id.">" ?> <img src="images/dn.png" width="20" height="20" /> </a> </div>
	 
             
     <div class="GrayBlack">
  
 <table  align="center" border="2" cellpadding="0" cellspacing="0">
<tbody id="data"> 
<tr  align="center" >
  
        
        <td bgcolor="#CCCCCC"><strong>SKU</strong></td>
       <td bgcolor="#CCCCCC"> <strong>Vendor Price</strong></td>
       <td bgcolor="#CCCCCC"> <strong>Map Price</strong></td>
       <td bgcolor="#CCCCCC"> <strong>Violation Amount</strong></td>
       <td bgcolor="#CCCCCC"> <strong>Link</strong></td>
      </tr>
   <?php
include('db.php');

       $result = mysql_query("select distinct crawl_results.website_id,
domain,
website.name as wname,
catalog_product_flat_1.entity_id,
catalog_product_flat_1.name,
catalog_product_flat_1.sku,
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
order by violation_amount desc"); ?>
<?php
if(!$result)
{
	echo "error";
}
else
{

        while($row = mysql_fetch_array($result)) 
       { 
       echo "<tr>";
       	  if($row['violation_amount']>10)
		  {
		 
       echo "<td>".$row['sku']."</td>"."<td>".$row['vendor_price']."</td>"."<td>".$row['map_price']."</td>"."<td  id=".'vioR'."  ".">".$row

['violation_amount']."</td>"."<td >"."<a target=".'_blank'." href =".$row['website_product_url']. ">" ." Product Link". "</a></td>";      
			
		  }
		   else if($row['violation_amount']>=5 && $row['violation_amount']<10)
		  {
		echo "<td>".$row['sku']."</td>"."<td>".$row['vendor_price']."</td>"."<td>".$row['map_price']."</td>"."<td id=".'vioO'."  ".">".$row

['violation_amount']."</td>"."<td>"."<a target=".'_blank'." href =".$row['website_product_url']. ">" ." Product Link". "</a></td>";      
		  }
		  
		   else if($row['violation_amount']<5)
		  {
		echo "<td>".$row['sku']."</td>"."<td>".$row['vendor_price']."</td>"."<td>".$row['map_price']."</td>"."<td id=".'vio'."  ".">".$row

['violation_amount']."</td>"."<td>"."<a target=".'_blank'." href =".$row['website_product_url']. ">" ." Product Link". "</a></td>";      
		  }
       echo "</tr>";  
       } 
}
	
 ?>	
 

</tbody>
  </table>
</div>

    
   
 </div>   

</div>

<div id="templatemo_footer_wrapper">
    <div id="templatemo_footer">
    	Copyright © Kuaus USA 2013
    </div> 
</div> 

</body>
</html>