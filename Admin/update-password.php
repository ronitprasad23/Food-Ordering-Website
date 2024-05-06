<?php include ('Partials/menu.php');?>


<div class="main-contant">
	<div class="wrapper">
		<h1>
			Change password
		</h1>

		<br><br>

		<?php

		if(isset($_GET['id'])) 
		{
			$id=$_GET['id'];
		}

		?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Current Password</td>
					<td>
						<input type="password" name="current_password" placeholder="Old password">
					</td>
				</tr>
				<tr>
					<td>New password</td>
					<td>
						<input type="password" name="new_password" placeholder="New password">
					</td>
				</tr>
				<tr>
					<td>Conform password</td>
					<td>
						<input type="password" name="conform_password" placeholder="Conform password">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change password" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

	</div>
</div>



<?php

	// Check wheather the submit button is clicked or not
	if (isset($_POST['submit'])) 
	{
		// echo "clicked";


		// get the data from form
		$id=$_POST['id'];
		$current_password=md5($_POST['current_password']);
		$new_password=md5($_POST['new_password']);
		$conform_password=md5($_POST['conform_password']);

		// check wheather the user have the current id or current password exists or not
		$sql = "SELECT * FROM tbl_admin WHERE id=$id AND Password='$current_password'";

		// execute the query
		$res = mysqli_query($conn, $sql);

		if ($res==true) 
		{
			// check wheather the data is available or not
			$count=mysqli_num_rows($res);

			if ($count==1) 
			{
				// user exists and password can be changed
				// echo "User Found";

				// check wheather the new password and the conform password match or not
				if($new_password==$conform_password)
				{
					// update the password
					$sql2 = "UPDATE tbl_admin SET
						password='$new_password'
						WHERE id=$id
					";

					// execute the query
					$res2 = mysqli_query($conn, $sql2);

					// check wheather the query is executed or not
					if ($res2==true) 
					{
						// display success message
						// redirect to manage admin page with success message
						$_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
						// Redirect to manage admin page
						header('location:'.SITEURL.'Admin/manage-admin.php');
					}
					else
					{
						// display error message
						// redirect to manage admin page with error message
						$_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";
						// Redirect to manage admin page
						header('location:'.SITEURL.'Admin/manage-admin.php');
					}

				}
				else
				{
					// redirect to manage admin page with error message
					$_SESSION['pwd-not match'] = "<div class='error'>Password Doesn't Match</div>";
					// Redirect to manage admin page
					header('location:'.SITEURL.'Admin/manage-admin.php');	
				}
			}
			else
			{
				// user does not exists set message and redirect
				$_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
				// Redirect to manage admin page
				header('location:'.SITEURL.'Admin/manage-admin.php');	
			}
		}

		
	}
		// check wheather the new password and conform password match or not



	


?>


<?php include ('Partials/footer.php');?>