<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php
                //create the id of selecte admin
                $id=$_GET['id'];

                //create the sql query to get details
                $sql="SELECT * FROM tbl_admin WHERE id=$id";

                //execute query
                $res=mysqli_query($conn, $sql);

                //check query is execute or not
                if($res==true)
                {
                    //check data is available or not
                    $count = mysqli_num_rows($res);
                    //check whether we have admin data or not
                    if($count==1)
                    {
                        //get details
                        $row=mysqli_fetch_assoc($res);

                        $full_name=$row['full_name'];
                        $username=$row['username'];
                    }
                    else
                    {
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

<?php

    //check the submit button is click or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //get all the values from the form to update
                    $id = $_POST['id'];
                    $full_name = $_POST['full_name'];
                    $username = $_POST['username'];

                    //create sql query to update admin
                    $sql = "UPDATE tbl_admin SET
                    full_name = '$full_name',
                    username = '$username'
                    WHERE id = '$id'
                    ";

                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    
                    //check query executed suessfully or not
                    if($res==true)
                    {
                        //Query executed and Admin Updated
                        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                        //Redirect to Manage Admin Page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //Failed to Update admin
                        $_SESSION['update'] = "<div class='error'>Failed Admin.</div>";
                        //Redirect to Manage Admin Page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
    }
?>


<?php include('partials/footer.php'); ?>