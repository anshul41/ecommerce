<html>
<?php 
session_start();
include("functions/functions.php");
?>
<head>
<title> EasyShop.COM</title>
<link rel="stylesheet" href="styles/style.css" media="all"/>
<script>
function validation()
{
var result=true;
var e=document.getElementsByName("customer_email")[0].value;
var atindex=e.indexOf("@");
var dotindex=e.lastIndexOf(".");
if(atindex<1||dotindex>=e.length-2||dotindex-atindex<3)
{result=false;
alert("     enter valid email address \n    example@something.com");
}
return(result);
}
</script>
</head>

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
		<form action="customer_register.php" method="post" enctype="multipart/form-data" onsubmit="return validation();">
			<table bgcolor="skyblue" width="700" style="margin:auto;">
				<tr>
					<td>Enter Name:</td>
					<td><input type="text" name="customer_name" size="40" required /></td>
				</tr>
				<tr>
					<td>Enter Mobile No:</td>
					<td><input type="text" name="customer_contact" size="40" required /></td>
				</tr>

				<tr>
					<td>Enter Email Id:</td>
					<td><input type="text" name="customer_email" size="40" required /></td>
				</tr>
				<tr>
					<td>Enter Password:</td>
					<td><input type="password" name="customer_password" size="40" required /></td>
				</tr>
				<tr>
					<td>select profile pic:</td>
					<td><input type="file" name="customer_image" required /></td>
				</tr>
								<tr>
					<td>Enter Address:</td>
					<td><textarea name="customer_address" rows="5" cols="25"></textarea></td>
				</tr>
				<tr>
					<td>Select Country:</td>
					<td><select name="customer_country" required >
					<option>select your country</option>
					<option>united states</option>
					<option>england</option>
					<option>europe</option>
					<option>japan</option>
					<option>INDIA</option>
					<option>Nepal</option>
					<option>Bangladesh</option>
					<option>Austrailia</option>
					<option>China</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Enter City:</td>
					<td><input type="text" name="customer_city" size="40" required /></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" name="submit_register"value="register"/></td>
				</tr>
			</table>
		</form>
		<?php 
		if(isset($_POST['submit_register']))
		{
			$ip=getIp();
			$name=$_POST['customer_name'];
			$address=$_POST['customer_address'];
			$email=$_POST['customer_email'];
			$password=$_POST['customer_password'];
			$contact=$_POST['customer_contact'];
			$country=$_POST['customer_country'];
			$city=$_POST['customer_city'];
			$image=$_FILES['customer_image']['name'];
			
			$image_tmp=$_FILES['customer_image']['tmp_name'];
			move_uploaded_file($image_tmp,"customer_images/$image");
			
			$register="insert into customers (customer_ip,customer_name,customer_email,customer_password,customer_country,customer_city,customer_contact,customer_image,customer_address)value('$ip','$name','$email','$password','$country','$city','$contact','$image','$address')";
			$run_register=mysqli_query($con,$register);
			
			$check_cart="select * from cart where ip_add='$ip'";
			$run_check=mysqli_query($con,$check_cart);
			$check=mysqli_num_rows($run_check);
			if($check==0)
			{
				$_SESSION['customer_email']=$email;
				echo "<script>alert('Account Has Been Created!')</script>";
				echo "<script>window.open('my_account.php','_self')</script>";
			}
			else
			{	$_SESSION['customer_email']=$email;
				echo "<script>alert('Account Has Been Created!')</script>";
				echo "<script>window.open('checkout.php','_self')</script>";
			
			}
		
		}
		?>
	<div id="footer">
	<h2 style="text-align:center; padding-top:30px;"> &copy; 2017 EASYSHOP.COM</h2>
	<h2><center> Your Ip Address Is:-(<?php echo $ip=getIp(); ?>)</center></h2>
	</div>
</div>
</body>
</html>