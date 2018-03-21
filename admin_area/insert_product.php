<?php @$a=session_start();
if(!isset($_SESSION['email']))
	{
		echo "<script>alert('login first')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
?>
<html>
<head> 
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<title>
Inserting Products </title>
<link rel="stylesheet" href="styles/style.css" media="all"/>
<?php
include("includes/db.php");
?>
</head>
<body>
<form action="insert_product.php" method="post" enctype="multipart/form-data">
<table border="2">
<tr><td></td><td><center><h1> product insertion</h1> </center></td><td></td></tr>
<tr><td align="right">
<b>Product Name:</b></td><td>
<input type="text" name="product_title" size="40" required /></td></tr>
<tr><td align="right">
<b>Product Brand:</b></td><td>
<select name="product_brand" required>
<option>select brands</option>
<?php
$get_brands="select * from brands";
$run_brands=mysqli_query($con,$get_brands);
while ($row_brands=mysqli_fetch_array($run_brands))
{
$brand_id=$row_brands['brand_id'];
$brand_title=$row_brands['brand_title'];
echo "<option value='$brand_id'>$brand_title</option>";
}
?>
</select>
</td></tr>
<tr><td align="right">
<b>Product Category:</b></td><td>
<select name="product_category" required>
<option>select product category</option>
<?php
$get_cats="select * from categories";
$run_cats=mysqli_query($con,$get_cats);
while ($row_cats=mysqli_fetch_array($run_cats))
{
$cat_id=$row_cats['cat_id'];
$cat_title=$row_cats['cat_title'];
echo "<option value='$cat_id'>$cat_title</option>";
}
?>
</select>
</td></tr>
<tr><td align="right">
<b>Product price:</b></td><td>
<input type="number" name="product_price" required /></td></tr>
<tr><td align="right">
<b>Product image:</b></td><td>
<input type="file" name="product_image"required /></td></tr>
<tr><td align="right">
<b>Product description:</b></td><td>
<textarea name="product_desc" cols="20" rows="10"></textarea></td></tr>
<tr><td align="right">
<b>Product keyword:</b></td><td>
<input type="text" name="product_keyword" size="40" required /></td></tr>
<tr><td align="right">
</td><td>
 <input type="submit" value="insert product" name="insert_post">  <input type="reset"></td></tr>
</table>
</form></div></div>
</body>
</html>
<?php
if(isset($_POST['insert_post']))
{
$product_title=$_POST['product_title'];
$product_brand=$_POST['product_brand'];
$product_keyword=$_POST['product_keyword'];
$product_category=$_POST['product_category'];
$product_price=$_POST['product_price'];
$product_desc=$_POST['product_desc'];

$product_image=$_FILES['product_image']['name'];
$product_image_tmp=$_FILES['product_image']['tmp_name'];
move_uploaded_file($product_image_tmp,"product_images/$product_image");



$insert_product="insert into products(product_title,product_brand,product_keyword,product_image,product_category,product_price,product_desc) values ('$product_title',$product_brand,'$product_keyword','$product_image',$product_category,$product_price,'$product_desc')";
$insert_pro=mysqli_query($con,$insert_product);
if($insert_pro)
{
	echo "<script>alert('poduct has been inserted')</script>";
    echo "<script>window.open('admin.php?insert','_self')</script>";

	}
}
?>