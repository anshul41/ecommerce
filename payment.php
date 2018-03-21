<?php
	
	include("includes/db.php");
	
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
		$name=$row_price['product_title'];
		$final_price=array_sum($values);
		$price=$price+$final_price;
		}
		
	}
	?>
<div>
<h1> <center> Pay Now With Paypal </center> </h1>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="anshulbuisness@gmail.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="<?php echo $name; ?>">
  <input type="hidden" name="amount" value="<?php echo $price; ?>">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <center><input type="image" name="submit" border="0"
  src="paypal.png"
  alt="Buy Now"> </center>
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
</div>