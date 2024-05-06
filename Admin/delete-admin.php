<?php

	// include the connection.php file here
	include("../Config/connection.php");

	include("Partials/menu.php");

	//1. Get the Id of the admin to be deleted
	$id = $_GET['id'];

	//2. Create SQL query to delete admin
	$sql = "DELETE FROM tbl_admin where id=$id";
	
	// Execute the query	
	$res = mysqli_query($conn, $sql);

	// Check wheather the query is executed or not
	if($res==true)
	{
		// query executed successfully and admin deleted
		// echo "Admin Deleted";
		// create a session variable to display message
		$_SESSION['delete'] = "<div class='success'>Admin Deleted successfully.</div>";
		// redirect to manage admin page
		header('location:'.SITEURL.'Admin/manage-admin.php');
	} 
	else
	{
		// failed to delete admin
		// echo "Failed to delete the admin";
		// create a session variable to display message
		$_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try Again Later.</div>";
		// redirect to manage admin page
		header('location:'.SITEURL.'Admin/manage-admin.php');
	}


	//3. Redirect to manage admin page and message (success/error)	


?>