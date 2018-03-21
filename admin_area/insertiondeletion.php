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

<?php
include("includes/db.php");
include("functions/functions.php");
?>
</head>

<body style="background:orange; width:1000;margin:auto;">
<div class="main_wrapper">
<div id="header">
<img src="images/admin-banner.jpg" width="1000" height="130" />
</div>
<div id="content_wrapper">
<div id="left">
<?php 
if(isset($_GET['category']))
{
	echo "
			<div style='float:left;padding:50; padding-left:20; padding-top:70;'>
			<h1>Insert Category</h1></BR></BR></BR>
			<form action='' method='post'>
			<table border='2' style='width:300;'>
			<tr><td align='center'>
			<b>Category Name:</b></td><td>
			<input type='text' name='category_title' size='10' required /></td></tr>
			<tr><td align='right'>
			</td><td>
			 <input type='submit' value='insert category' name='insert_cat'> 
			</td></tr>
			</table>
			</form>
			</div>
			<div style='float:right; padding:50; padding-right:20; padding-top:70;'>
			<h1>Delete Category</h1></BR></BR></BR>
			<form action='' method='post'>
			<table border='2' align='center' style='width:300;'>
			<tr><td align='center'>
			<b>Category Name:</b></td><td>
			<select name='cat_id' required>
			<option>select product category</option>";
		$get_cats="select * from categories";
		$run_cats=mysqli_query($con,$get_cats);
		while ($row_cats=mysqli_fetch_array($run_cats))
		{
		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];
		echo "<option value='$cat_id'>$cat_title</option>";
		}
		echo "
			</select></td></tr>
			<tr><td align='right'>
			</td><td>
			 <input type='submit' value='Delete category' name='delete_cat'> 
			</td></tr>
			</table>
			</form>
			</div>";
}





if(isset($_GET['brand']))
{
	echo "
			<div style='float:left;padding:50; padding-left:20; padding-top:70;'>
			<h1>Insert Brand</h1></BR></BR></BR>
			<form action='' method='post'>
			<table border='2' style='width:300;'>
			<tr><td align='center'>
			<b>Brand Name:</b></td><td>
			<input type='text' name='brand_title' size='10' required /></td></tr>
			<tr><td align='right'>
			</td><td>
			 <input type='submit' value='insert Brand' name='insert_brand'> 
			</td></tr>
			</table>
			</form>
			</div>
			<div style='float:right; padding:50; padding-right:20; padding-top:70;'>
			<h1>Delete Brand</h1></BR></BR></BR>
			<form action='' method='post'>
			<table border='2' align='center' style='width:300;'>
			<tr><td align='center'>
			<b>Brand Name:</b></td><td>
			<select name='brand_id' required>
			<option>select product Brand</option>";
		$get_cats="select * from brands";
		$run_cats=mysqli_query($con,$get_cats);
		while ($row_cats=mysqli_fetch_array($run_cats))
		{
		$cat_id=$row_cats['brand_id'];
		$cat_title=$row_cats['brand_title'];
		echo "<option value='$cat_id'>$cat_title</option>";
		}
		echo "
			</select></td></tr>
			<tr><td align='right'>
			</td><td>
			 <input type='submit' value='Delete Brand' name='delete_brand'> 
			</td></tr>
			</table>
			</form>
			</div>";
}

?>

</div>
<div id="right">
<ul id="menu">
	<li><a href="admin.php?insert"><font color="white">INSERT PRODUCT</font></a></li>
	<li><a href="insertiondeletion.php?category"><font color="white">MODIFY CATEGORIES</font></a></li>
	<li><a href="insertiondeletion.php?brand"><font color="white">MODIFY BRANDS</font></a></li>
	<li><a href="admin.php?view_products"><font color="white">VIEW ALL PRODUCTS</font></a></li>
	<li><a href="cart.php"><font color="white">SHOPPING CART</font></a></li>
	<li><a href="contactus.php"><font color="white">CONTACT US</font></a></li>
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
<?php
if(isset($_POST['insert_cat']))
{
$new=$_POST['category_title'];
$query="insert into categories (cat_title) values ('$new')";
$insert=mysqli_query($con,$query);
if($insert)
{
	echo "<script>alert('new category has been inserted')</script>";
    echo "<script>window.open('insertiondeletion.php?category','_self')</script>";
}
}


if(isset($_POST['insert_brand']))
{
$new=$_POST['brand_title'];
echo $query="insert into brands (brand_title) values ('$new')";
$insert=mysqli_query($con,$query);
if($insert)
{
	echo "<script>alert('new brand has been inserted')</script>";
    echo "<script>window.open('insertiondeletion.php?brand','_self')</script>";
}
}


if(isset($_POST['delete_brand']))
{
$old=$_POST['brand_id'];
$query="delete from brands where brand_id='$old'";
$delete=mysqli_query($con,$query);
if($delete)
{
	echo "<script>alert('brand has been deleted')</script>";
    echo "<script>window.open('insertiondeletion.php?brand','_self')</script>";
}
}


if(isset($_POST['delete_cat']))
{
$old=$_POST['cat_id'];
$query="delete from categories where cat_id='$old'";
$delete=mysqli_query($con,$query);
if($delete)
{
	echo "<script>alert('category has been deleted')</script>";
    echo "<script>window.open('insertiondeletion.php?category','_self')</script>";
}
}
?>
