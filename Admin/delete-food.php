<?php
    // include connection page
    include('../Config/connection.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) // either use '&&' or 'Add'
    {
        // process to delete
        // echo "Process to delete";

        //1. Get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name']; 

        //2. Remove the image if available
        // check whether the image is available or not delete if the image is available
        if($image_name != "")
        {
            // it has image and need to remove from folder
            // get the image path
            $path = "../images/Cake/".$image_name;

            // remove image file from folder
            $remove = unlink($path);

            // check whether the image is removed or not
            if($remove==false)
            {
                // failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed To Remove the image</div>";
                // redirect to manage food
                header('location:'.SITEURL.'Admin/manage-food.php');
                // stop the process of deleting food
                die();
            }
        }   

        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the query is executed or not and set the session message respectively.
        //4 Redirect to manage food page with session message.
        if($res==true)
        {
            // food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }
        else
        {
            // failed to delete the page
            $_SESSION['delete'] = "<div class='error'>Failed to delete the image.</div>";
            header('location:'.SITEURL.'Admin/manage-food.php');
        }

    }
    else
    {
        // redirect to manage food page
        $_SESSION['unorthorized'] = "<div class='error'>Unorthorized Access.</div>";
        header('location:'.SITEURL.'Admin/manage-food.php');
    }
?>