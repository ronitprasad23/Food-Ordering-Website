<?php

	include('Partials/menu.php');

?>

<div class="main-contant">
	<div class="wrapper">
		<h1>
			Manage Food
		</h1>


			<br><br>

			<?php
				 if(isset($_SESSION['add']))
				 {
					 echo $_SESSION['add'];
					 unset($_SESSION['add']);
				 }

				 if(isset($_SESSION['delete']))
				 {
					 echo $_SESSION['delete'];
					 unset($_SESSION['delete']);
				 }

				 if(isset($_SESSION['upload']))
				 {
					 echo $_SESSION['upload'];
					 unset($_SESSION['upload']);
				 }

				 
				 if(isset($_SESSION['unorthorized']))
				 {
					 echo $_SESSION['unorthorized'];
					 unset($_SESSION['unorthorized']);
				 }

				 if(isset($_SESSION['update']))
				 {
					 echo $_SESSION['update'];
					 unset($_SESSION['update']);
				 }
			?>

			<br><br>
			<!--Button to add food -->

			<a href="<?php echo SITEURL;?>Admin/add-food.php" class="btn-primary">Add Food</a>

			<br><br>
			
			<table class="tbl-full">
				<tr>
					<th>S.no</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				 <?php

				 	// create a SQL query to get all the food
					$sql = "SELECT * FROM tbl_food";
					// execute the query
					$res = mysqli_query($conn, $sql);
					// count rows to check wheather we have all the food items or not
					$count = mysqli_num_rows($res);

					// create serial no variable and set the default value as 1
					$sn=1;

					if($count>0)
					{
						// we have food in database
						// get the food items from database and display it
						while($row=mysqli_fetch_assoc($res))
						{
							// get the values from indiviuals columns
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td><?php echo $price; ?></td>
									<td>
										<?php
											// check whether we have image or not
											if($image_name=="")
											{
												// we dont have image name display error message
												echo "<div class='error'>Image Not Added</div>";
											}
											else
											{
												// we have image display image
												?>
													<img src="<?php echo SITEURL; ?>images/Cake/<?php echo $image_name; ?>" width="100px">
												<?php
											}
										?>
									</td>
									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
										<a href="<?php echo SITEURL;?>Admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Cake</a>
										<a href="<?php echo SITEURL; ?>Admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Cake</a>
									</td>
								</tr>
							<?php
						}
					}
					else
					{
						// food not added in database
						echo "<tr><td colspan='7' class='error'>Food not added yet.</td></tr>";
					}

				 ?>

			

				
			
			</table>

	</div>
</div>

<?php

	include('Partials/footer.php');

?>