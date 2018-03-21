<html>
<head><title>Detals</title>
<link rel="stylesheet" href="styles/style.css" media="all"/></head>
</head>
<body style='background:pink;'>
<h1><center>PRODUCT DETAILS</center></h1>
<?php
 $pro_id=$_GET['pro_id'];
 $con=mysqli_connect("localhost","root","","ecommerce");
$get_details="select * from products where product_id=$pro_id";
$run_details=mysqli_query($con,$get_details);
$put_details=mysqli_fetch_array($run_details);
echo "<div style='width:1000px height:1000px; background:blue;'>
<div style='float:center; width:400px;;'>
<table>
<tr><td>er</td></tr>
</table>
</div>
<div style='float:right; width:400px'>
<img src='admin_area/product_images/jellyfish.jpg' style='border:2px solid black; width:200px; height:200px;'/>
</div>
</div>
";
  
?>
</body>
</html>