<?php

    // include connection.php for the siteurl
    include('../Config/connection.php');

    // Distroy the session
    session_destroy(); //unset $_session['user']

    // Redirect to login page
    header('location:'.SITEURL.'Admin/login.php');





?>