<?php
    include('Partials/menu.php');
?>

<div class="main-contant">
    <div class="wrapper">
        <h1>
            Update Catagory
        </h1>

        <br><br>

        <?php

            // check wheather the id is set or not
            if(isset($_GET['id']))
            {
                // get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                // create a sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                // execute the query
                $res = mysqli_query($conn, $sql);
                //  count the rows wheather the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // redirect to manage category with the session message
                    $_SESSION['no-category-found'] = "<div class='error'>Catagroy Not Found</div>";
                    header('location:'.SITEURL.'Admin/manage-category.php');
                }
            }
            else
            {
                // redirect to manage catagory
                header('location:'.SITEURL.'Admin/manage-category.php');
            }

        ?>
        

    <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php  echo $title;  ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php

                        if($current_image !="")
                        {
                            // display the image
                            ?>
                                <img src="<?php  echo SITEURL; ?>images/Category/<?php echo $current_image; ?>" width="150px" height="200px">
                            <?php
                        }
                        else
                        {
                            // Display message
                            echo "<div class'error'>Image Not Added</div>";
                        }

                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "Checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "Checked";}?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>    
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "Checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "Checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Catagory" class="btn-secondary">
                </td>    
            </tr>
        </table>

    </form>

    <?php

        if(isset($_POST['submit']))
        {
            // get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // updating image if selected
            // check wheather the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                // get the image details
                $image_name = $_FILES['image']['name'];
                // check wheather the image is available or not
                if($image_name !="")
                {
                    // image available
                    // upload the new image

                     // Auto rename our image
                            // Get the extension of our image (jpg, png, gif, etc) e.g "special food1.jpg"
                            $ext = end(explode('.', $image_name));

                            // Rename the image
                            $image_name = "Cake_Category_".rand(000, 999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/Category/".$image_name;

                            // finally upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // check wheather the image is uploaded or not
                            // and if the image is not uploaded then we will stop the process and redirect with     error message
                            if($upload==false)
                            {
                                // Set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                // redirect to add category page
                                header('location:'.SITEURL.'Admin/manage-category.php');
                                // stop the process
                                die();
                            }

                    // remove the current image if available
                    if($current_image !="")
                    {
                        $remove_path = "../images/Category/".$current_image;

                        $remove = unlink($remove_path);

                        // check wheather the image is removed or not
                        // If failed to remove the display image then stop the process
                        if($remove==false)
                        {
                            // failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the image</div>";
                            header('location:'.SITEURL.'Admin/manage-category.php');
                            die(); //stop the process
                        }
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }
            // update the database
            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";
            // execute thequery
            $res2 = mysqli_query($conn, $sql2);
            // redirect to image category with  message
            // check whether executed or not
            if($res2==true)
            {
                // category updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header('location:'.SITEURL.'Admin/manage-category.php');
            }
            else
            {
                // Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed To Update Category</div>";
                header('location:'.SITEURL.'Admin/manage-category.php');
            }
        }

    ?>

    </div>
</div>




<?php
    include('Partials/footer.php');
?>