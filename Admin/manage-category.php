<?php

	include('Partials/menu.php');

?>

<div class="main-contant">
	<div class="wrapper">
		<h1>
			Manage Category
		</h1>

		<br><br>


			<?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

				if(isset($_SESSION['remove']))
				{
					echo $_SESSION['remove'];
					unset($_SESSION['remove']);
				}

				if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				if(isset($_SESSION['no-category-found']))
				{
					echo $_SESSION['no-category-found'];
					unset($_SESSION['no-category-found']);
				}

				if(isset($_SESSION['update']))
				{
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}

				if(isset($_SESSION['upload']))
				{
					echo $_SESSION['upload'];			
					unset($_SESSION['upload']);
				}

				
				if(isset($_SESSION['failed-remove']))
				{
					echo $_SESSION['failed-remove'];
					unset($_SESSION['failed-remove']);
				}

            ?>

			<br><br>

			<!--Button to add category -->

			<a href="<?php  echo SITEURL; ?>Admin/add-category.php" class="btn-primary">Add Category</a>

			<br><br>
			
			<table class="tbl-full">
				<tr>
					<th>S.no</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					// Query to get all categories form the database
					$sql = "SELECT * FROM tbl_category";

					//execute the query
					$res = mysqli_query($conn, $sql);
					
					// count rows
					$count = mysqli_num_rows($res);

					// create serial number variable and assign value as 1
					$sn=1;

					// check weather we hava data in database or not
					if($count>0)
					{
						// we have data in database
						// get the data and display
						while($row=mysqli_fetch_assoc($res))
						{
							$id = $row['id'];
							$title = $row['title'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];

							?>
								<tr>
									<td><?php echo $sn++;  ?></td>
									<td><?php echo $title;  ?></td>
									
									<td>
										<?php

											// check whether the image name is available or not
											if($image_name!="")
											{
												// display the image
												?>

													<img src="<?php  echo SITEURL; ?>images/Category/<?php echo $image_name; ?>" width="100px">

												<?php
											}
											else
											{
												// Display the error message
												echo "<div class='error'>Image Not Added</div>";
											}

										?>
									</td>

									<td><?php echo $featured;  ?></td>
									<td><?php echo $active;  ?></td>
									<td>
										<a href="<?php  echo SITEURL; ?>Admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
										<a href="<?php  echo SITEURL; ?>Admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;  ?>" class="btn-danger">Delete Category</a>
									</td>
								</tr>

							<?php

						}
					}
					else
					{
						// we don not have data in database
						// we will dsplay the data inside the table
						?>

						<tr>
							<td colspan="6">
								<div class="error">No Category Added</div>
							</td>
						</tr>

						<?php
					}


				?>

			

				
			
			</table>

	</div>
</div>

<?php

	include('Partials/footer.php');

?>