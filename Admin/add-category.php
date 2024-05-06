<?php
    include('Partials/menu.php');
?>

    <div class="main-contant">
        <div class="warpper">
            <br><br>
            <h1>
                Add Category
            </h1>

            <br><br>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!-- Add category form starts here -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>    
                    <tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
            <!-- Add category form ends here -->

            <?php

                // check wheather the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // echo "clicked";

                    // get the value from category form
                    $title = $_POST['title'];

                    // for radio input we need to check whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        // get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        // set the default value
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }


                    // check whether the image is selected or not and set the value for image name accordingly
                    // print_r($_FILES['image']);

                    // die(); // break the code here

                    if(isset($_FILES['image']['name']))
                    {
                        // upload the image
                        // to upload image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

                        // upload the image if the image is selected
                        if($image_name !="")
                        {

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
                                header('location:'.SITEURL.'Admin/add-category.php');
                                // stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        // dont upload the image and set the image_name value as blank
                        $image_name="";
                    }


                    // create sql query to insert category data into database
                    $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    // execute the query and save in database
                    $res = mysqli_query($conn, $sql);

                    // check wheather the query is executed or not and wheather the data is added or not
                    if($res==true)
                    {
                        // query executed and category added
                        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                        // redirect to manage category page
                        header('location:'.SITEURL.'Admin/manage-category.php');
                    }
                    else
                    {
                        // Failed to add category
                        $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                        // redirect to add category page
                        header('location:'.SITEURL.'Admin/add-category.php');

                    }

                }

            ?>

        </div>

    </div>






<?php
    include('Partials/footer.php');
?>