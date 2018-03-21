<?php
$con=mysqli_connect("localhost","root","","ecommerce");
// getting user ip adddress
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

 

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }
	return $ip;

}




// printing email in cart bar
 function wel(){
if(isset($_SESSION['customer_email']))
	{
		echo $welcome="Welcome ".$_SESSION['customer_email'];
	}
else
	{
		echo $welcome="Welcome Guest";
	}
 }



//add cart
function cart()
{	global $con;
	if(isset($_GET['add_cart']))
	{
		$pro_id=$_GET['add_cart'];
		$ip=getIp();
		$check="select * from cart where p_id='$pro_id' AND ip_add='$ip'";
		$run_check=mysqli_query($con,$check);
		if(mysqli_num_rows($run_check)>0)

			{
			echo"";	
			}
		else
			{
				$run="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
				$run_pro=mysqli_query($con,$run);
				echo"<script>window.open('index.php','_self')</script>";
			}
	}
}


// getting total added items
function total_items()
{
	global $con;
	$ip=getIp();
	$query="select * from cart where ip_add='$ip'";
	$run_total=mysqli_query($con,$query);
	$get_total=mysqli_num_rows($run_total);
     echo $get_total;
}


//getting total price of items in cart
function total_price()
{$price=0;
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
		$price=$price+$final_price;
		}
		
	}
	echo $price;
}


// getting category
function getCats()
{
	global $con;
	$get_cats="select * from categories";
$run_cats=mysqli_query($con,$get_cats);
while ($row_cats=mysqli_fetch_array($run_cats))
{
$cat_id=$row_cats['cat_id'];
$cat_title=$row_cats['cat_title'];
echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
}
}


// getting brand
function getbrands()
{
	global $con;
	$get_brands="select * from brands";
$run_brands=mysqli_query($con,$get_brands);
while ($row_brands=mysqli_fetch_array($run_brands))
{
$brand_id=$row_brands['brand_id'];
$brand_title=$row_brands['brand_title'];
echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
}
}




// getting six random products for index page
function get_pro()
{	

global $con;
if(!isset($_GET['cat']))
{
	if(!isset($_GET['brand']))
	{
	$get="select * from products order by RAND() LIMIT 0,6";
$run_pro=mysqli_query($con,$get);

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
}
}
}



// getting products on basis of brand
function getbrandpro()
{	

global $con;

	if(isset($_GET['brand']))
	{
		$brand=$_GET['brand'];
	$get_brand="select * from products where product_brand=$brand";
$run_pro=mysqli_query($con,$get_brand);
$count_brand=mysqli_num_rows($run_pro);
    if($count_brand==0){
	echo "</br></br><h1><center> SOORY! No Products Of This Brand </center></h1></br></br>";
}
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
	<p><b><center>PRICE: $ $pro_price </center></b></p>
	<a href='detail.php?pro_id=$pro_id'>Details</a> 
	<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add To Cart</button></a>
	</div>
	";
}
}

}



// getting product on basis of category
function getcatpro()
{	

global $con;
if(isset($_GET['cat']))
{
	$cat=$_GET['cat'];
	$get_cat="select * from products where product_category=$cat";
$run_pro=mysqli_query($con,$get_cat);
$count_cat=mysqli_num_rows($run_pro);
if($count_cat==0){
	echo "</br></br><h1><center> SOORY! No Products In This Category </center></h1></br></br>";
}
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
	<p><b><center>PRICE: $ $pro_price </center></b></p>
	<a href='detail.php?pro_id=$pro_id'>Details</a> 
	<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add To Cart</button></a>
	</div>
	";
}
}
}


// getting random banner images

function get_banner()
{	

global $con;
	$get="select * from banner order by RAND() LIMIT 0,1";
	$run_pro=mysqli_query($con,$get);

	while($row_pro=mysqli_fetch_array($run_pro))
{
	
	$banner_image=$row_pro['image'];
	echo "<img src='images/$banner_image'";
}
}




?>