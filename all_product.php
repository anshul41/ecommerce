<html>
<?php 
include("functions/functions.php");
?>
<head>
<title> EasyShop.COM</title>
<link rel="stylesheet" href="styles/style.css" media="all"/></head>

<body>
<!--main wrapper starts-->
<div class="main_wrapper" bgcolor="black">
<!--header starts-->
	<div class="header_wrapper">
		<a href="index.php"><img src="images/1.png" id="logo"/></a>
		<img src="images/3.jpg" id="banner"/>
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
	</ul>
	<div id="form">
	<form action="results.php" method="get" enctype="multipart/form-data">
	<input type="text" name="user_query" placeholder="search the product"/>
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
	<?php cart(); ?>
	<div id="cart">
	<span style="float:right; padding:5px; font-family:arial; font-size:20; line-height:40px;"> 
Welcome Guest! <b style="color:yellow;"> Shopping Cart- </b> Total Items:<?php total_items(); ?> Total Price:<?php total_price(); ?> <a href="cart.php" style="color:yellow; text-decoration:none;">Go To Cart</a> 


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
		<?php  
		
$get_allpro="select * from products";
$run_pro=mysqli_query($con,$get_allpro);
$count_brand=mysqli_num_rows($run_pro);
  
while($row_pro=mysqli_fetch_array($run_pro))
{
	$pro_title=$row_pro['product_title'];
	$pro_id=$row_pro['product_id'];
	$pro_brand=$row_pro['product_brand'];
	$pro_category=$row_pro['product_category'];
	$pro_price=$row_pro['product_price'];
	$pro_image=$row_pro['product_image'];
	echo "
	<div id='single_product'>
	<h3>$pro_title</h3>
	<img src='admin_area/product_images/$pro_image' width='180px' height='180' border='2px'/>
	<p><b><center>PRICE:$ $pro_price </center></b></p>
	<a href='detail.php?pro_id=$pro_id'>Details</a> 
	<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add To Cart</button></a>
	</div>
	";
}
?>
		
		</div>
		</div>
		<!--content area ends-->
	</div>
	<div id="footer">
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	</div>
</div>
</body>
</html>