<html>
<?php 
session_start();
include("functions/functions.php");
?>
<head>
<title> EasyShop.COM</title>
<link rel="stylesheet" href="styles/style.css" media="all"/>

</head>

<body> 
<!--main wrapper starts-->
<div class="main_wrapper" bgcolor="pink">
<!--header starts-->
	<div class="header_wrapper">
		<a href="index.php"><img src="images/1.png" id="logo"/></a>
		<?php get_banner();?> id="banner"/>
	</div>
	<!--header ends-->
	<!--menubar starts-->
	<div class="menubar">
	<ul id="menu">
	<li><a href="index.php">HOME</a></li>
	<li><a href="all_product.php">ALL PRODUCTS</a></li>
	<li><a href="my_account.php">MY ACCOUNT</a></li>
	<li><a href="customer_register.php">SIGN UP</a></li>
	<li><a href="cart.php">SHOPPING CART</a></li>
	<li><a href="contactus.php">CONTACT US</a></li>
	<li><a href="admin_area/admin.php">Admin</a></li>
	</ul>
	<div id="form">
	<form action="results.php" method="get" enctype="multipart/form-data">
	<input type="text" name="user_query" placeholder="search the product" required />
	<input type="submit" name="search" value="search"/>
	</form>
	</div>
	</div>
	<!--menubar ends-->
</div>
<!--main wrapper ends-->
	<!--main contents starts-->
	<div class="content_wrapper">
	<!--cart starts-->
	<?php  cart();  ?>
	<div id="cart">
	<span style="float:right; padding:5px; font-family:arial; font-size:16.5; line-height:40px;"> 
<?php wel(); ?> <b style="color:yellow;"> Shopping Cart- </b> Total Items:<?php total_items(); ?> Total Price:<?php total_price(); ?> <a href="cart.php" style="color:yellow; text-decoration:none;">Go To Cart</a> 
<?php
if(!isset($_SESSION['customer_email']))
{
echo "<a href='checkout.php' style='color:orange;'>login</a>";
}
else
{
	echo "<a href='logout.php' style='color:orange;'>logout</a>";
}
?>

</span>
	</div>
<!--cart ends-->
<!--sidebar starts-->
		<div id="sidebar">
		<div id="sidebar_title">
		CATEGORIES
		</div>
		<ul id="cats">
			<?php getcats();?>
		</ul></BR>
		<div id="sidebar_title">
		BRANDS
		</div>
		<ul id="cats">
		<?php getbrands();?>
		</ul>
		</div>
		<!--sidebar ends-->
		<!--content area starts-->
		<div id="content_area">
		<div id="product_box">
		<?php   get_pro();  ?>
		<?php   getcatpro();  ?>
		<?php   getbrandpro();  ?>
		
		</div>
		</div>
		
		<?php  $ip=getIp(); ?>
		<!--content area ends-->
	</div>
	<div id="footer">
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	<h2><center> Your Ip Address Is:-(<?php echo $ip=getIp(); ?>)</center></h2>
	</div>
</div>
</body>
</html>