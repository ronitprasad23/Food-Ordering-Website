<?php

    include('../Config/connection.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login: Cake-Order-System</title>
 
    <link rel="stylesheet" type="text/css" href="../css/admin.css">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
</head>
<body class="background-2">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Login form start here -->

    <form action="" method="POST" class="form-2">
        <h1>Login Here</h1>

        <br><br>

        <?php

            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

        ?>
        
        <br><br>
        
        <label for="username">Username</label>
        <input type="text" placeholder="Email or Phone" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password">
        <br>
        <input type="submit" name="submit" value="Login" class="button">
        <div class="social">
          <div class="go"><i class="bi bi-google"></i> Google</div>
          <div class="fb"><i class="bi bi-facebook"></i>  Facebook</div>
        </div>
    </form>

    <!-- Login form end here-->

</body>
</html>


<?php
    
    // checked wheather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        // get the data from login form
         $username = $_POST['username'];
         $password = md5($_POST['password']);

        //  check wheather the user with the username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // count rows wheather the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user available and login success
            $_SESSION['login'] = "<div class='success text-center'>Login Successfully.</div>";
            $_SESSION['user'] = $username;  //To check wheather the user is logged in or not
            // redirect to home page/Dashboard
            header('location:'.SITEURL.'Admin/');
        }
        else
        {
            // user not available and login fall
            $_SESSION['login'] = "<div class='error text-center'>username or password does not match.</div>";
            // redirect to home page / Dashboard
            header('location:'.SITEURL.'Admin/login.php');
        }
    }


?>