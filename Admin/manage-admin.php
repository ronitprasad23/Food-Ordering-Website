<?php

	include('Partials/menu.php');

?>

	<!---Main content section starts--->	

	<div class="main-contant">
		<div class="wrapper">
			<h1>
				Manage Admin
			</h1>

			<br>

			<?php

				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];	//Display session message
					unset($_SESSION['add']); //Remove session message
				}

				if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				if(isset($_SESSION['update']))
				{
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}

				if(isset($_SESSION['user-not-found']))
				{
					echo $_SESSION['user-not-found'];
					unset($_SESSION['user-not-found']);
				}

				if(isset($_SESSION['pwd-not match']))
				{
					echo $_SESSION['pwd-not match'];
					unset($_SESSION['pwd-not match']);
				}

				if(isset($_SESSION['change-pwd']))
				{
					echo $_SESSION['change-pwd'];
					unset($_SESSION['change-pwd']);
				}


			?>

			<br><br><br>

			<!--Button to add Admin -->

			<a href="add-admin.php" class="btn-primary">Add Admin</a>

			<br><br>
			
			<table class="tbl-full">
				<tr>
					<th>S.no</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>


				<?php

					// Query to get all the admins
					$sql = "SELECT * FROM tbl_admin";
					// Execute the query
					$res = mysqli_query($conn, $sql);

					// Check whether the sql query is executed or not
					if($res==TRUE)
					{
						// count rows whether we have the data in database or not
						$rows = mysqli_num_rows($res); // function to get all the rows in the database

						$sn=1; // create a variable and assign the values


						// check the number of rows
						if($rows>0)
						{
							// we have data in database
							while ($rows=mysqli_fetch_assoc($res)) 
							{
								// using while loop to get all the data from the database
								// And while loop will run as long we have the data in the database

								// Get indiviual data
								$id=$rows['id'];
								$full_name=$rows['full_name'];
								$username=$rows['username'];

								// Display the values in our table

								?>

									<tr>
										<td><?php echo $sn++; ?></td>
										<td><?php echo $full_name; ?></td>
										<td><?php echo $username; ?></td>
										<td>
											<a href="<?php echo SITEURL; ?>Admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
											<a href="<?php echo SITEURL; ?>Admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
											<a href="<?php echo SITEURL; ?>Admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
										</td>
									</tr>	

								<?php
							}
						}
						else
						{
							// we do not have data in the database
						}
					}

				?>			

			</table>

			<div class="clearfix">
				
			</div>

		</div>
	</div>

	<!---Main content section ends--->

<?php

	include('Partials/footer.php');

?>

</body>
</html>