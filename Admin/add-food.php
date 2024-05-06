<?php  include('Partials/menu.php');  ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter your title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="40" rows="5" placeholder="Description of the cake"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Categorie:</td>
                    <td>
                    <select name="category">

                    <?php
                        // create a php code to display categories from database
                        //1. create a sql to get all the active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        // executing query
                        $res = mysqli_query($conn, $sql);

                        // count rows to check wheather we have categories or not
                        $count = mysqli_num_rows($res);

                    // if count is greater than zero we have  categories else we doubt have categories
                        if($count>0)
                        {
                            // we have categories
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // get the details of the categories
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            // we dont have categories
                            ?>
                                <option value="0">No Category Found</option>
                            <?php
                        }
                    ?>

                    </select>
                </td>
                </tr>
                <tr>
                    <td>Faetured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            // check whether the image is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the food in database
                // echo "Clicked";
                //1 Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether the radio button for featured and active are clicked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //setting the default value
                }

                //2 upload the image if selected
                // check whether the image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is selected or not and upload the image only if selected 
                    if($image_name!="")
                    {
                        // Image is selected
                        //A Rename the image
                        // Get the extension of the selected image(jpg,png,gif,etc.)
                        $ext = end(explode('.', $image_name));

                        // create new name for the image
                        $image_name = "Cake-name-".rand(0000,9999).".".$ext;

                        //B upload the image
                        // get the src and destination path
                        
                        // source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // destination path of the image to be uploaded 
                        $dst = "../images/Cake/".$image_name;

                        // finally upload the cake image
                        $upload = move_uploaded_file($src, $dst);

                        // check whether the image is uploaded or not
                        if($upload==false)
                        {
                            // failed to upload the image
                            // Redirect to add food page with and error message
                            $_SESSION['upload'] = "<div class='error>Failed to upload image</div>'";
                            header('location:'.SITEURL.'Admin/add-food.php');
                            // stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = ""; // setting the default value as blank
                }

                //3 Insert into database

                // create a sql query to save or add cakes
                // for numerical we don't need to pass value inside quotes but for the string it is compulsory to pass value under quotes
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);
                // check whether the data is inserted or not
                 //4 Redirect with message to manage food page
                if($res2 == true)
                {
                    // data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Cake Added Successfully.</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }
                else
                {
                    // failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add cake</div>";
                    header('location:'.SITEURL.'Admin/manage-food.php');
                }

               
            } 
        ?>

    </div>
</div>



<?php include('Partials/footer.php'); ?>