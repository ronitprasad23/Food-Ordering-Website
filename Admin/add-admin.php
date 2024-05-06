<?php

	include('Partials/menu.php');

?>

<div class="main-contant">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br><br>


		<?php

				if(isset($_SESSION['add'])) //Check whether thesession is set or not 
				{
					echo $_SESSION['add'];	//Display session message
					unset($_SESSION['add']); //Remove session message
				}

			?>


		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
						<div class="input-group">
						<td>
						  <span class="input-group-text">Full Name:</span>
						</td>
						<td>
						  <input type="text" aria-label="First name" name="full_name" class="form-control" placeholder="Enter your name">
						</td> 
						</div>
				</tr>
				<tr>
					<td>Username:</td>
					<td>
						<input type="text" name="username" placeholder="Enter your username">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="password" placeholder="Enter your password">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php

	include('Partials/footer.php');

?>


<?php  
 
// Process the value from form and save it in database

// check wheather the submit button is clicked or not

if(isset($_POST['submit']))
{
	//Button clicked
	// echo "Button clicked";

	//1. Get the data from form

	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	$password = md5($_POST['password']); //password encription with MD5

	//2. SQL query to save the data into the database:-
	$sql = "INSERT INTO tbl_admin SET
		full_name='$full_name',
		username='$username',
		password='$password'
	";



	//3. Execute the query and saving the data into the database
	$res = mysqli_query($conn,$sql) or die(mysqli_error());

	//4. Check wheather the data is executed or not and display the appropraiate message
	if($res==TRUE)
	{
		//Data inserted
		// echo "Data inserted";
		// Create a session variable to display message
		$_SESSION['add'] = "Admin Added Successfully";
		// Redirect page to manage admin
		header('location'.SITEURL.'../Admin/manage-admin.php');
	} 
	else
	{
		// Data not insserted
		// echo "Failed To insert data";
			// Create a session variable to display message
		$_SESSION['add'] = "Failed to Add Admin";
		// Redirect page to manage admin
		header('location'.SITEURL.'Admin/add-admin.php');
	}

} 


?>