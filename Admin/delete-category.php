<?php
    // Include connection page
    include('../Config/connection.php');

    // check wheather the image_name and id value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and delete it
        // echo "Get value and Delete it";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file is available
        if($image_name !="")
        {
            // image is available so remove it
            $path = "../images/Category/".$image_name;
            // remove the image
            $remove = unlink($path);

            // if we failed to rmaove image then add an error message and stop the process
            if($remove==false)
            {
                // set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to add category image</div>";
                // redirect to manage category page
                header('location:'.SITEURL.'Admin/manage-category.php');
                // stop the process
                die();
            }
        }

        // delete data from database
        // sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check wheather the data is deleted from database or not
        if($res==true)
        {
            // set success message and redirect
            $_SESSION['delete'] = "</div class='success'>Category Deleted Successfully</div>";
            // redirect to manage category page
            header('location:'.SITEURL.'Admin/manage-category.php');
        }
        else
        {
            // set fail message and redirect
            $_SESSION['delete'] = "</div class='error'>Failed To Delete Category</div>";
            // redirect to manage category page
            header('location:'.SITEURL.'Admin/manage-category.php');
        }
    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'Admin/manage-category.php');
    }
?>