<html>

<?php 
session_start();
if(!isset($_SESSION['customer_email']))
{
echo "<script>alert('please login first')</script>";
echo "<script>window.open('checkout.php','_self')</script>";
}
include("functions/functions.php");
include("includes/db.php");
?>
<head>
<title> EasyShop.COM</title>
<link rel="stylesheet" href="styles/style.css" media="all"/></head>

<body bgcolor="skyblue">
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


		<?php
		$user=$_SESSION['customer_email'];
		$get_img="select * from customers where customer_email='$user'";
		$run_img=mysqli_query($con,$get_img);
		$row_img=mysqli_fetch_array($run_img);
		$c_image=$row_img['customer_image'];
		$c_name=$row_img['customer_name'];
		$c_contact=$row_img['customer_contact'];
		?>
		<div id="sidebar">
		<div id="sidebar_title" style="passing:0;">
		<center><font size="4.5"><b>MY ACCOUNT </font></center>
		</div>
		<?php echo "<img src='customer_images/$c_image' height='190' width='186' style='padding:5; border:2px SOLID cyan'/>"; ?>
		</div>
		<!--sidebar ends-->
		<!--content area starts-->
		<div id="content_area">
		<div id="product_box" style="height:270;">
			<?php
			
			// to get simple my_account page
			if(!isset($_GET['my_orders']))
			{
				if(!isset($_GET['edit_account']))
				{
					if(!isset($_GET['change_pass']))
					{
						if(!isset($_GET['delete_account']))
						{
							echo "<center><h2> WELCOME! $c_name</BR> your mobile no. is: $c_contact</h2><br><br>
							<h1><font color='blue'> Click Below To Do Some Action </font></h1></center>
							";
			}}}}
			
			
			
			// to refresh if some one select my orders
			if(isset($_GET['my_orders']))
						{
							echo "<center><h2> WELCOME! $c_name</BR> your mobile no. is: $c_contact</h2><br><br>
							<h1><font color='blue'> YOU HAVE NO ORDERS</font></h1></center>
							";
						}
						
						
							// to refresh if some one select change password
						if(isset($_GET['change_pass']))
						{
							echo "<center><h2> WELCOME! $c_name</BR> your mobile no. is: $c_contact</h2>
							<form action='my_account.php' method='post'>
								<table border='2' align='center' width='600' bgcolor='skyblue' align='center'>
									<tr>
										<h2><center>CHANGE PASSWORD</center></h2>
									</tr>
									<tr>
										<td align='right'><b>Old Password:</b></td>
										<td><input type='text' name='old_password' placeholder='enter old password' size='60' required /></td>
									</tr>
									<tr>
										<td align='right'><b>New Password</b></td>
										<td><input type='password' name='new_password' placeholder='enter new password' size='60' required /></td>
									</tr>
									<tr>
										<td></td><td><input type='submit' name='change' value='change password'/></td>
									</tr>
								</table>
							</form>";
						}
						
						// method to change user password
						if(isset($_POST['change']))
							{
								$old_pass=$_POST['old_password'];
								$new_pass=$_POST['new_password'];
								$check_pass="select * from customers where customer_email='$user' AND customer_password='$old_pass'";
								$run_check=mysqli_query($con,$check_pass);
								$count=mysqli_num_rows($run_check);
								if($count==0)
								{
								echo "<script>alert('your entered password is not correct')</script>";
								echo "<script>window.open('my_account.php','_self')</script>";
								}
								$change_pass="update customers set customer_password='$new_pass' where customer_password='$old_pass'";
								$run_query=mysqli_query($con,$change_pass);
								if($run_query)
								{
									echo "<script>alert('password is changed')</script>";
									echo "<script>window.open('my_account.php','_self')</script>";
								}
							}
							
					// to refresh if some one select delete account
						if(isset($_GET['delete_account']))
						{
							echo "<center><h2> WELCOME! $c_name</BR> your mobile no. is: $c_contact</h2>
							<form action='my_account.php' method='post'>
								<table border='2' align='center' width='790' bgcolor='skyblue' align='center'>
									<tr>
										<h2><center>DELETE ACCOUNT</center></h2>
									</tr>
									<tr>
										<h2></br><center>Are You Sure Want To Delete Your Account</br>You Can Share Your Problem With Us <a href='contactus.php'>Here</a></center></h2>
									</tr>
									
									<tr><p></br></br></p>
										<td style='text-align:center;'><input type='submit' name='delete' value='YES'/>
										<button><a herf='my_account.php'>No I am Joking!</a></button></td>
									</tr>
								</table>
							</form>";
						}					
							
							
							// method to delete user account
						if(isset($_POST['delete']))
							{
								$delete_acc="delete from customers where customer_email='$user'";
								$run_query=mysqli_query($con,$delete_acc);
								if($run_query)
								{
									echo "<script>alert('your account is deleted')</script>";
									echo "<script>window.open('logout.php','_self')</script>";
								}
							}	
							
							//	// to refresh if some one select edit account
							
							if(isset($_GET['edit_account']))
							{
								include('edit_details.php');
								
							}
							
			?>
			
		</div>
		</div>
		
		<?php  $ip=getIp(); ?>
		<!--content area ends-->
	</div>
	<div id="footer" style="height:auto;">
	<ul id="cats"style="padding:10;">
			<center><li style="display:inline; margin:auto; padding:9;"><a href="my_account.php?my_orders"><font color="orange">My Orders</font></a></li>
			<li style="display:inline; margin:auto; padding:9;"><a href="my_account.php?edit_account"><font color="orange">Edit Account</font></a></li>
			<li style="display:inline; padding:9;"><a href="my_account.php?change_pass"><font color="orange">Change Password</font></a></li>
			<li style="display:inline; padding:9;"><a href="my_account.php?delete_account"><font color="orange">Delete Account</font></a></li>
			<li style="display:inline; padding:9;"><a href="logout.php"><font color="orange">Logout</font></a></li>
			</center>
		</ul>
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	<h2><center> Your Ip Address Is:-(<?php echo $ip=getIp(); ?>)</center></h2>
	</div>
</div>
</body>
</html>