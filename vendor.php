<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vendor</title>

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

<body id="home" onload="tableSearch.init();">

<div id="templatemo_main">
<div id="divp">
<h3 align="center">Violation By Seller</h3>
<table align="center">
<tr>
<td>
 
   <div align="right"><input  type="text" size="30" width="300" hight="40" maxlength="1000" value="" id="textBoxSearch" onkeyup="tableSearch.search(event);"  style="background-image:url(images/sr.png) no-repeat 4px 4px;
	
	border:2px solid #456879;
	border-radius:10px;
	height: 22px;
	width: 230px; "/> <a href="" onclick="tableSearch.runSearch();"><img src="images/sr.png" style="height:20; width:20;"></a>
     <a class="button_example"  href="export_vendor1.php"> <img src="images/dn.png" width="20" height="20" /> </a>
               
</div>
</td>

   </tr>
<tr>
<td>
	
     
    <div class="GrayBlack">
          
           
		<table align="center">
        <tbody id="data">
 		<tr> 
 			 <td>
 		 <strong>Seller</strong>
 		  </td>	
   
 		 <td >
  		<strong>Violation Count</strong>
 		  </td>
          <td >
  		<strong>Max Violation</strong>
 		  </td>
           <td >
  		<strong>Min Violation</strong>
 		  </td>
		</tr>	

					
 <?php
include('db.php');

$sql1="select website.name,
crawl_results.website_id,
max(crawl_results.violation_amount) as maxvio,
min(crawl_results.violation_amount) as minvio,
count(crawl_results.website_id) as wi_count
from website
inner join
crawl_results
on website.id = crawl_results.website_id
inner join crawl
on
crawl_results.crawl_id = crawl.id

where crawl_results.violation_amount>0.05 
and
crawl.id = 
(select max(crawl.id) from crawl)
group by website.name , crawl_results.website_id
order by count(crawl_results.website_id) desc
";
   
       
	    $result1=mysql_query($sql1);
        while($row = mysql_fetch_array($result1)) 
       { 
       echo "<tr>";
       echo "<td>";
 
       echo "<a href="."vviolation.php?website_id=".$row['website_id'].">".$row['name']."</td>"."<td>".$row['wi_count']."</td>"."<td>".$row['maxvio']."</td>"."<td>".$row['minvio']."</td>"	."</tr>";
       echo "</td>";
       echo "</tr>";  
       } 
         echo "</table>";
       
    // mysql_close($con); 
 ?>	
 
</div>

</td>

    </tr>
    </tbody>
   </table>    
  
     

 </div>  
 </div> 


</body>
</html>