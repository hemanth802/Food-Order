<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
    <div class="login">

        <h1 class="text-center">Login</h1>
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

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>

            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"> <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <p class="text-center">Created By - <a href="#">Hemanth Alla</a></p>
    </div>
    </body>
</html>

<?php

    //check whether submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1.Get the data from login
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        //$password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2.check whether the user with username and pass are exist are not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3.execute the query
        $res = mysqli_query($conn, $sql);

        //4.count rows to check whether the user exist are not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user aviable and login success
            $_SESSION['login']="<div class='success'>Login Successful.</div>";
            $_SESSION['user']=$username; //To check whether the user is login or not and logout will unset it
            //redirect to home page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not avaliable and login fail
            $_SESSION['login']="<div class='error text-center'>Username or Password did not match.</div>";
            //redirect to home page
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>