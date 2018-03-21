<?php session_start();
if(!isset($_SESSION['email']))
	{
		echo "<script>alert('login first')</script>";
		echo "<script>window.open('login.php','_self')</script>";
	}
?>


<?php


if(isset($_GET['delete_cust']))
{
$c_id=$_GET['delete_cust'];
$query="delete from customers where customer_id='$c_id'";
$delete=mysqli_query($con,$query);
if($delete)
{
	echo "<script>alert('customer has been deleted')</script>";
    echo "<script>window.open('view_customer.php','_self')</script>";
}
}


?>