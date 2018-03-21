<?php session_start();
if(!isset($_SESSION['email']))
	{
		echo "<script>alert('login first')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
?>
<html>
<head>
<link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body style="background:orange; width:1000;margin:auto;">
<div class="main_wrapper">
<div id="header">
<img src="images/admin-banner.jpg" width="1000" height="130" />
</div>
<div id="content_wrapper">
<div id="left">
<?php 
	include("functions/functions.php");
	$user=$_SESSION['email'];
	
	if(isset($_SESSION['email']))
	{
		echo "<h1> Welcome Admin: '$user' </h1>";
	}
if(isset($_GET['insert']))
{
	include('insert_product.php');

}
if(isset($_GET['view_product']))
{
	include('view_products.php');

}
if(isset($_GET['edit']))
{
	include('edit_product.php');

}
if(isset($_GET['delete']))
{
	include('delete_product.php');

}

if(isset($_GET['view_customer']))
{
	include('view_customer.php');

}
if(isset($_GET['delete_cust']))
		{
			include('delete_customer.php');
		}

?>

</div>
<div id="right">
<ul id="menu">
	<li><a href="admin.php?insert"><font color="white">INSERT PRODUCT</font></a></li>
	<li><a href="insertiondeletion.php?category"><font color="white">MODIFY CATEGORIES</font></a></li>
	<li><a href="insertiondeletion.php?brand"><font color="white">MODIFY BRANDS</font></a></li>
	<li><a href="admin.php?view_product"><font color="white">VIEW ALL PRODUCTS</font></a></li>
	<li><a href="admin.php?view_customer"><font color="white">View Customers</font></a></li>
	<li><a href="#"><font color="white">Payments</font></a></li>
	<li><a href="#"><font color="white">Orders</font></a></li>
	<li><a href="../index.php"><font color="white">Easyshop.com</font></a></li>
	<li><a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=ecommerce&token=abd9a1adb027b65a9fb2632b8191c248"><font color="white">Database Section</font></a></li>
	<li><a href="logout.php"><font color="white">Admin Logout</font></a></li>
	</ul>
</div>
</div>
</div>
<div id="footer" style="width:1000px; height:85px; clear:both; background:grey; margin:auto; float:left;">
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	<h2><center> Your Ip Address Is:-(<?php echo $ip=getIp(); ?>)</center></h2>
	</div>
</body>
</html>