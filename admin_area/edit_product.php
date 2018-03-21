<?php
session_start();
if(!isset($_SESSION['email']))
	{
		echo "<script>alert('login first')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}



		include("includes/db.php");
		$p_id=$_GET['edit'];
		$get_img="select * from products where product_id='$p_id'";
		$run_img=mysqli_query($con,$get_img);
		$row_img=mysqli_fetch_array($run_img);
		$p_title=$row_img['product_title'];
		$p_brand=$row_img['product_brand'];
		$p_price=$row_img['product_price'];
		$p_category=$row_img['product_category'];
		$p_image=$row_img['product_image'];
		$p_desc=$row_img['product_desc'];
		$p_keyword=$row_img['product_keyword'];
		$pro_id=$row_img['product_id'];
		
		
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
<form action="" method="post" enctype="multipart/form-data">
<table border="2">
<tr><td></td><td><center><h1>EDIT PRODUCT</h1> </center></td><td></td></tr>
<tr><td align="right">
<b>Product Name:</b></td><td>
<input type="text" name="product_title" value="<?php echo $p_title; ?>" size="40"  /></td></tr>
<tr><td align="right">
<b>Product Brand:</b></td><td>
<select name="product_brand" >

<?php
$get_brands="select * from brands where brand_id='$p_brand'";
$run_brands=mysqli_query($con,$get_brands);
while ($row_brands=mysqli_fetch_array($run_brands))
{
$brand_id=$row_brands['brand_id'];
$brand_title=$row_brands['brand_title'];
}
echo "<option value='$brand_id'>$brand_title</option>";
?>
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
<select name="product_category" >
<?php
$get_cats="select * from categories where cat_id='$p_category'";
$run_cats=mysqli_query($con,$get_cats);
while ($row_cats=mysqli_fetch_array($run_cats))
{
$cat_id=$row_cats['cat_id'];
$cat_title=$row_cats['cat_title'];
}
echo "<option value='$cat_id'>$cat_title</option>"; ?>
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
<input type="number" name="product_price" value="<?php echo $p_price; ?>" /></td></tr>
<tr><td align="right">
<b>Product image:</b></td><td>
<input type="file" name="product_image" value=<?php echo $p_image; ?>/></td><td><img src="product_images/<?php echo $p_image; ?>" width="70" height="70"/></td></tr>
<tr><td align="right">
<b>Product description:</b></td><td>
<textarea name="product_desc" cols="20"rows="10"><?php echo $p_title; ?></textarea></td></tr>
<tr><td align="right">
<b>Product keyword:</b></td><td>
<input type="text" name="product_keyword" value="<?php echo $p_keyword; ?>" size="40"  /></td></tr>
<tr><td align="right">
</td><td>
 <input type="submit" value="Update product" name="update_post">  <input type="reset"></td></tr>
</table>
</form></div></div>
</body>
</html>
<?php
if(isset($_POST['update_post']))
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



$update_product="update products set product_title='$product_title', product_brand='$product_brand', product_keyword='$product_keyword', product_image='$product_image', product_category='$product_category', product_price='$product_price', product_desc='$product_desc' where product_id='$pro_id'";
$update_pro=mysqli_query($con,$update_product);
if($update_pro)
{
	echo "<script>alert('poduct has been updated')</script>";
    echo "<script>window.open('admin.php?view_product','_self')</script>";

	}
}
?>

