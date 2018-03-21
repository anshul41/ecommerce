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
	<li><a href="customer/my_account.php">MY ACCOUNT</a></li>
	<li><a href="customer_register.php">SIGN UP</a></li>
	<li><a href="cart.php">SHOPPING CART</a></li>
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
	<!--cart starts-->
	<?php  cart();  ?>
	<div id="cart">
	<span style="float:right; padding:5px; font-family:arial; font-size:17; line-height:40px;"> 
<?php  wel();?> <b style="color:yellow;"> Shopping Cart- </b> Total Items:<?php total_items(); ?> Total Price:<?php total_price(); ?> <a href="cart.php" style="color:yellow; text-decoration:none;">Go To Cart</a> 


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
		if(!isset($_SESSION['customer_email']))
		{
			echo"<form action='change_password.php' method='post'>
		<table border='2' align='center' width='790' bgcolor='skyblue' align='center'>
			<tr>
				<h2><center>CHANGE PASSWORD OR <a href='checkout.php'>LOGIN AGAIN</a></center></h2>
			</tr>
			<tr>
				<td align='right'><b>Email:</b></td>
				<td><input type='text' name='c_email' placeholder='enter your email' size='60' required /></td>
			</tr>
			<tr>
				<td align='right'><b>New Password</b></td>
				<td><input type='password' name='new_password' placeholder='enter your password' size='60' required /></td>
			</tr>
			<tr>
				<td align='right'><b>Mobile No:</b></td>
				<td><input type='text' name='contact' placeholder='enter your mobile no' size='60' required /></td>
			</tr>
			<tr>
				<td></td><td><input type='submit' name='change' value='change password'/></td>
			</tr>
		</table>
	</form>";
		}
		?>
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
<?php
if(isset($_POST['change']))
	{
		$email=$_POST['c_email'];
		$new_pass=$_POST['new_password'];
		$contact=$_POST['contact'];
		$change_pass="update customers set customer_password='$new_pass' where customer_email='$email' AND customer_contact='$contact'";
		$run_query=mysqli_query($con,$change_pass);
		if($run_query)
		{
			echo "<script>alert('password is changed')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		}
	}
?>