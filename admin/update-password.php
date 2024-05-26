<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>    

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //user exist and password can be change
                //echo "User Found";
                if($new_password==$confirm_password)
                {
                    //echo "Password Match";
                    $sql2="UPDATE tbl_admin SET
                    password = 'Snew_password'
                    WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed or not
                    if($res2==true)
                    {
                        //Display success message
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully</div>";

                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Display Error Message
                        $_SESSION['pwd-not-match']="<div class='error'>Password Not Match</div>";

                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match']="<div class='error'>Password Not Match</div>";

                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user doesn't exist set messange and redirect
                $_SESSION['user-not-found']="<div class='error'>Not Fonud</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }

?>

<?php include('partials/footer.php'); ?>