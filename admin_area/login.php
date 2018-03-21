<?php session_start(); 
include("functions/functions.php");
include("includes/db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
      <link rel="stylesheet" href="styles/login_style.css"> 
</head>

<body>
  <form method="post" action="">
  <h4> Login Admin </h4>
  <input class="email" type="text" placeholder="Enter Username" name="email"/>
  <input class="pass" type="password" placeholder="Enter Password" name="pass"/>
  <li><a href="#">Forgot your password?</a></li>
  <input class="button" type="submit" value="Log in" name="login"/>
</form>
</body>
</html>


<?php
if(isset($_POST['login']))
{
	$email=mysql_real_escape_string($_POST['email']);
	$password=mysql_real_escape_string($_POST['pass']);
	$query="select * from admin where user_email='$email' AND user_password='$password'";
	$run_query=mysqli_query($con,$query);
	if($run_query)
	{
			$check=mysqli_num_rows($run_query);
			if($check==1)
			{
				$data=mysqli_fetch_array($run_query);
				$_SESSION['email']=$data['user_email'];
				echo "<script>window.open('admin.php','_self')</script>";
			}
			else
			{
				echo "<script>alert('login details not matched')</script>";
			}
	}
}
?>












