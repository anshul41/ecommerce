<html>
<?php 
session_start();
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
	<?php  cart();  ?>
	<div id="cart">
	<span style="float:right; padding:5px; font-family:arial; font-size:17; line-height:40px;"> 
<?php Wel();?> <b style="color:yellow;"> Shopping Cart- </b> Total Items:<?php total_items(); ?> Total Price:<?php total_price(); ?> <a href="index.php" style="color:yellow; text-decoration:none;">Back To Shop</a> 


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
		<form action="" method="post" enctype="multipart/form-data">
		<table bgcolor="skyblue" width="790" align="center">
			<tr align="center">
				<th>REMOVE</th>
				<th>PRODUCT(S)</th>
				<th>QUANTITY</th>
				<th>TOTAL PRICE</th>
			</tr>
		<?php
		$price=0;
		global $con;
		$ip=getIp();
		$query="select * from cart where ip_add='$ip'";
		$run_price=mysqli_query($con,$query);
		while($p_price=mysqli_fetch_array($run_price))
		{
		$pro_id=$p_price['p_id'];
		$q="select * from products where product_id='$pro_id'";
		$get_price=mysqli_query($con,$q);
		while($row_price=mysqli_fetch_array($get_price))
		{
		$values=array($row_price['product_price']);
		$final_price=array_sum($values);
		$pro_title=$row_price['product_title'];
		$pro_image=$row_price['product_image'];
		$single_price=$row_price['product_price'];
		$pro_title=$row_price['product_title'];
		$price=$price+$final_price;
		?>
		
		<?php $qty=1;
				if(isset($_POST['update_cart']))
					{
					$qty=$_POST['qty'];
					$query_qty="update cart set qty='$qty' where p_id='$pro_id'";
					$update_qty=mysqli_query($con,$query_qty);
					
					$_SESSION['qty']=$qty;
					$price=$price*$qty;
				
				
				
					}
				?>
		     <tr align="center">
				<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
				<td><?php echo $pro_title;?></br>
				<img src="admin_area/product_images/<?php echo $pro_image;?>" width="60" height="60"/>
				</td> 
				<td><input type="text" size="5" name="qty" value="<?php echo $_SESSION['qty']; ?>"/></td>
				
				<td><b><?php echo "$ ".$single_price; ?></b></td>
			</tr>
		
		<?php   }
				} ?>
		<tr align="right">
			<td></td><td></td><td></td><td style="padding-right:20;"><b>SUB TOTAL:<?php echo "$ ".$price; ?></b></td>
		</tr>
		<tr align="center">
			<td></td>
			<td><input type="submit" name="update_cart" value="update cart"/></td>
			<td><input type="submit" name="continue" value="continue shopping"/></td>
			<td><button><a href="checkout.php" style="color:black">checkout</a></button></td>
		</tr>
		</table>
		</form>
		<?php
		function updatecart()
		{
			global $con;
			$ip=getIp();
			if(isset($_POST['update_cart']))
			{	
				foreach($_POST['remove'] as $remove_id)
				{
					$query="delete from cart where p_id='$remove_id' AND ip_add='$ip'";
					$run_delete=mysqli_query($con,$query);
					if($run_delete)
					{
						echo "<script>window.open('cart.php','_self')</script>";
					}
				}
			}
			if(isset($_POST['continue']))
			{	
			echo "<script>window.open('index.php','_self')</script>";
			}

			}
			echo @$up_cart=updatecart();
		?>
		</div>
		</div>
		
		<?php $ip=getIp(); ?>
		<!--content area ends-->
	</div>
	<div id="footer">
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	<h2><center> Your Ip Address Is:-(<?php echo $ip=getIp(); ?>)</center></h2>
	</div>
</div>
</body>
</html>