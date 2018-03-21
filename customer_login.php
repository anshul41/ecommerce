
<?php 
echo @$a=session_start();
include("admin_area/includes/db.php");
function getIp2() {

    $ip = $_SERVER['REMOTE_ADDR'];

 

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }
	return $ip;

}

?>
<div>

	<form action="customer_login.php" method="post">
		<table border="2" align="center" width="790" bgcolor="skyblue" align="center">
			<tr>
				<h2><center>Login Or <a href="customer_register.php">Register</a> To Buy</center></h2>
			</tr>
			<tr>
				<td align="right"><b>Email:</b></td>
				<td><input type="text" name="email" placeholder="enter your email" size="60" required /></td>
			</tr>
			<tr>
				<td align="right"><b>Password</b></td>
				<td><input type="password" name="password" placeholder="enter your password" size="60" required /></td>
			</tr>
			<tr>
				<td></td><td><a href="change_password.php?forgot">Forgot Password</a></td>
			</tr>
			<tr>
				<td></td><td><input type="submit" name="login" value="login"/></td>
			</tr>
		</table>
	</form>
	<h2 style="padding:15;"><a href="customer_register.php"><center>New? Register Here</center></a></h2>
</div>

<?php
if(isset($_POST['login']))
{
$c_email=$_POST['email'];
$c_password=$_POST['password'];
$login_query="select * from customers where customer_email='$c_email' AND customer_password='$c_password'";
$run=mysqli_query($con,$login_query);
$run_check=mysqli_num_rows($run);
			$Ip=getIp2();
			$check_cart="select * from cart where ip_add='$Ip'";
			$check_customer=mysqli_query($con,$check_cart);
			$check=mysqli_num_rows($check_customer);
			if($run_check==0)
				{
					echo "<script>alert('email and password incorrect')</script>";
					echo "<script>window.open('checkout.php','_self')</script>";
					exit();
				}
				
			 if($run_check>0 AND $check==0)
			{
				$_SESSION['customer_email']=$c_email;
				echo "<script>window.open('my_account.php','_self')</script>";
			}
			else 
			{	$_SESSION['customer_email']=$c_email;
				echo "<script>window.open('checkout.php','_self')</script>";
			
			}
		}
?>




