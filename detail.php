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
	<li><a href="#">HOME</a></li>
	<li><a href="#">ALL PRODUCTS</a></li>
	<li><a href="#">MY ACCOUNT</a></li>
	<li><a href="#">SIGN UP</a></li>
	<li><a href="#">SHOPPING CART</a></li>
	<li><a href="#">CONTACT US</a></li>
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
	<?php cart(); ?>
	<!--cart starts-->
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
		if(isset($_GET['pro_id']))
{
		$product_id=$_GET['pro_id'];


		$get="select * from products where product_id=$product_id";
		$run_pro=mysqli_query($con,$get);

		while($row_pro=mysqli_fetch_array($run_pro))
	{	
		$pro_title=$row_pro['product_title'];
		$pro_id=$row_pro['product_id'];
		$pro_desc=$row_pro['product_desc'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
		echo "
		<div id='single_product'>
		<h3>$pro_title</h3>
		<img src='admin_area/product_images/$pro_image' width='400px' height='300' border='2px'/>
		<p><b><center>$ $pro_price </center></b></p><B>
		PRODUCT TITLE:'$pro_title'</br>
		PRODUCT DESCRIPTION:$pro_desc</br>
		PRODUCT PRICE:   $pro_price</br></B>



		<a href='index.php'>GO BACK</a>
		<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add To Cart</button></a>
		</div>
				";
}
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