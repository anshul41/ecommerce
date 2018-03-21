		<?php
		include("includes/db.php");
		echo @$a=session_start();
		$user=$_SESSION['customer_email'];
		$get_img="select * from customers where customer_email='$user'";
		$run_img=mysqli_query($con,$get_img);
		$row_img=mysqli_fetch_array($run_img);
		$c_image=$row_img['customer_image'];
		$c_name=$row_img['customer_name'];
		$c_contact=$row_img['customer_contact'];
		$c_country=$row_img['customer_country'];
		$c_city=$row_img['customer_city'];
		$c_address=$row_img['customer_address'];
		$c_password=$row_img['customer_password'];
		$c_id=$row_img['customer_id'];
		?>
	
		<form action="" method="post" enctype="multipart/form-data">
			<table bgcolor="pink" width="790" style="margin:auto;">
				<tr>
					<td>Update Name:</td>
					<td><input type="text" name="customer_name" value="<?php echo $c_name; ?>" size="40" required /></td>
				</tr>
				<tr>
					<td>Update Mobile No:</td>
					<td><input type="text" name="customer_contact"value="<?php echo $c_contact; ?>" size="40" required /></td>
				</tr>

				<tr>
					<td>Update Email Id:</td>
					<td><input type="text" name="customer_email" size="40" value="<?php echo $user; ?>" required /></td>
				</tr>
				<tr>
					<td>select profile pic:</td>
					<td><input type="file" value=<?php echo $c_image; ?> name="customer_image"/> <img src="customer_images\<?php echo $c_image ?>" height="70" width="70"/>
				</tr>
								<tr>
					<td>Update Address:</td>
					<td><input type="text" name="customer_address" value="<?php echo $c_address; ?>"/></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td><select name="customer_country">
					<option><?php echo $c_country; ?></option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Update City:</td>
					<td><input type="text" name="customer_city" value="<?php echo $c_city; ?>" size="40" required /></td>
				</tr>
				
				<tr>
					<td></td>
					<td><input type="submit" name="update_c"value="Update"/></td>
				</tr>
			</table>
		</form>
		<?php 
		if(isset($_POST['update_c']))
		{
			
			$name=$_POST['customer_name'];
			$address=$_POST['customer_address'];
			$email=$_POST['customer_email'];
			$contact=$_POST['customer_contact'];
			$country=$_POST['customer_country'];
			$city=$_POST['customer_city'];
			$image=$_FILES['customer_image']['name'];
			
			$image_tmp=$_FILES['customer_image']['tmp_name'];
			move_uploaded_file($image_tmp,"customer_images/$image");
			
			
			echo $updation="update customers set customer_name='$name', customer_email='$email', customer_city='$city', customer_contact='$contact', customer_country='$country', customer_address='$address', customer_image='$image' where customer_id='$c_id'";
			
			$run_updation=mysqli_query($con,$updation);
			if($run_updation)
			{
				$_SESSION['customer_email']=$email;
				echo "<script>alert('Account Has Been Updated!')</script>";
				echo "<script>window.open('my_account.php','_self')</script>";
			}
			
		
		}
		?>