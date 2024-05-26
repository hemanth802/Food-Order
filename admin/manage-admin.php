<?php include('partials/menu.php'); ?>

        <!-- Menu Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //removing session message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br><br>

                <!-- button to add admin -->
                <a href="add-admin.php" class="btn-primary"> Add Admin</a>

                <br><br><br>
                <table class=tbl-full>
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>UserName</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the query
                        $res = mysqli_query($conn,$sql);

                        //Check whether the query is executed or not
                        if($res==TRUE)
                        {
                            //count Rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); //Function to get all the rows in DB

                            $sn=1; //CREATE A VARIABLE AND ASSIGN THE VALUE
                            //CHECK the num of rows
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //using while loop to get all the data in DB
                                    //Add while lopp will run as long as we have the data in DB

                                    //Get individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the values in our Table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                
                                    <?php
                                }
                            }
                            else
                            {
                                //We Do not have Data in Database
                            }
                        }
                    ?>

                    
                </table>

            </div>
        </div>
        <!-- Menu Content Ends -->
        
<?php include('partials/footer.php'); ?>