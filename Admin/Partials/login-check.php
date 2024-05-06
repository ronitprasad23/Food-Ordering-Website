<?php

    // Authorization
    // check wheather the user had logged in or not
    if(!isset($_SESSION['user'])) //if user is not set
    {
        // user is not logged in
        // Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin pannel</div>";
        // redirect to login page
        header('location:'.SITEURL.'Admin/login.php');
    }


?>