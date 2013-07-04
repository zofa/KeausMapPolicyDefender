<html>
<head>
<?php
include('db.php');
$sku_name = $_REQUEST['sku_id'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Violation</title>

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




<link href="css/TBLCSS.css" rel="stylesheet" type="text/css" />
<link href="css/div.css" rel="stylesheet" type="text/css" />


</head>

<body id="home" onLoad="tableSearch.init();">

<div  id="templatemo_main">
 <div id="divp">      
	 <h3 align="center"> Sellers Violated  <?php echo $sku_name; ?> </h3> 
    <a href="product.php"><img align="left" src="images/back.png"/> </a>
     <div align="right"><input  type="text" size="30" width="300" hight="40" maxlength="1000" value="" id="textBoxSearch" onkeyup="tableSearch.search(event);"  style="background-image:url(images/sr.png) no-repeat 4px 4px;
	
	border:2px solid #456879;
	border-radius:10px;
	height: 22px;
	width: 230px; "/> <a href="" onclick="tableSearch.runSearch();"><img src="images/sr.png" style="height:20; width:20;"></a>
               

                    <?php echo "<a class="."button_example"." href="."export_product.php?sku_id=".$sku_name.">" ?> <img src="images/dn.png" width="20" height="20" /> </a> </div>
  
  <div  class="GrayBlack">
 <table  align="center" border="2" cellpadding="0" cellspacing="0">
<tbody id="data"> 
<tr  align="center" >
  
        
        <td bgcolor="#CCCCCC"><b>Website</b></td>
        <td bgcolor="#CCCCCC"><b>Vendor Price</b></td>
        <td bgcolor="#CCCCCC"><b>Map</b></td>
        <td bgcolor="#CCCCCC"><b>Violation</b></td>
        <td bgcolor="#CCCCCC"><b>Link</b></td>
      </tr>
    <?php
$sql1="SELECT distinct 
catalog_product_flat_1.sku, website.name as wname,
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

$result1=mysql_query($sql1);

while($row=mysql_fetch_array($result1))
{
?>
    <?php
     echo "<tr>";
	   
	   if($row['violation_amount']>10)
		  {
    ?>
  
	
	
      <td ><?php echo $row['wname']; ?></td>
      <td ><?php echo $row['vendor_price']; ?></td>
      <td ><?php echo $row['map_price']; ?></td>
      <td id="vioR"><?php echo $row['violation_amount']; ?></td>
      <td ><?php echo "<a target=".'_blank'." href =".$row['website_product_url']. ">" ." Product Link". "</a>" ?></td>
	
	<?php
	
		  }
		  else if($row['violation_amount']>=5 && $row['violation_amount']<10)
    {
    
    ?>
    
  
      <td ><?php echo $row['wname']; ?></td>
      <td ><?php echo $row['vendor_price']; ?></td>
      <td ><?php echo $row['map_price']; ?></td>
      <td td id="vioO"><?php echo $row['violation_amount']; ?></td>
      <td ><?php echo "<a target=".'_blank'." href =".$row['website_product_url']. ">"." Product Link". "</a>" ?></td>
     <?php
	  }
	  
	  
	   else if($row['violation_amount']<5)
    {
    
    ?>
    
  
      <td ><?php echo $row['wname']; ?></td>
      <td ><?php echo $row['vendor_price']; ?></td>
      <td ><?php echo $row['map_price']; ?></td>
      <td td id="vio"><?php echo $row['violation_amount']; ?></td>
      <td ><?php echo "<a target=".'_blank'." href =".$row['website_product_url']. ">"." Product Link". "</a>" ?></td>
     <?php
	  }
	  
?>
    </tr>
    <?php
// close while loop 
}
?>
</tbody>
  </table>
</div>

    </div>
   
 </div>   

</body>
</html>