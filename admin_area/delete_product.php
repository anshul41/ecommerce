<?php session_start();
if(!isset($_SESSION['email']))
	{
		echo "<script>alert('login first')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
?>
<table WIDTH="700" ALIGN="CENTER">
	<tr>
		<CENTER><B>VIEW ALL PRODUCTS</CENTER></B>
	</tr>
	<tr ALIGN="CENTER">
		<th>S.N</th>
		<th>TITLE</th>
		<th>IMAGE</th>
		<th>PRICE</th>
		<th>EDIT</th>
		<th>DELETE</th>
	</tr>
	<?php 
	
	include("includes/db.php");
	$sno=1;
	$p_id=$_GET['delete'];
	$get="select * from products where product_id='$p_id'";
	$run=mysqli_query($con,$get);
	while($row_pro=mysqli_fetch_array($run))
	{	$title=$row_pro['product_title'];
		$pro_id=$row_pro['product_id'];
		$image=$row_pro['product_image'];
		$price=$row_pro['product_price'];
		echo "<tr align='center'><td>$sno</td><td>$title</td><td><img src='product_images/$image' height='70' width='70'/></td><td>$price</td><td><button><a href='delete_product.php?confirm=$p_id'>DELETE</a></button></td><td><button><a href='admin.php?view_product'>GO BACK</a></button></td></tr>";
		$sno=$sno+1;
	}

		if(isset($_GET['confirm']))
			{   $p_id=$_GET['confirm'];
				$delete="delete from products where product_id='$p_id'";
				$run_delete=mysqli_query($con,$delete);
				if($run_delete)
				{
					echo "<script>alert('product has been deleted')</script>";
					echo "<script>window.open('admin.php?view_product','_self')</script>";
				}

			}


	?>
</table>




