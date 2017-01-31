<?php include 'includes/admin-header.php' ?>

<?php if(isset($_SESSION['username'])){

    $session_username = $_SESSION['username'];

    $query = "SELECT * from users WHERE username = '{$session_username}'";

    $select_user_profile_query = mysqli_query($dbconnect,$query);


    while($row = mysqli_fetch_array($select_user_profile_query)){

        $user_id = $row['user_id'];
        $session_username = $row['username'];
        $user_password = $row['user_password'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_image= $row['user_image'];
        $user_role = $row['user_role'];
        $randSalt = $row['randSalt'];


    }
}

//===========Edit user===============
editProfile();


?>



<body>


<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin-navbar.php' ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile
                        <small>Author</small>
                    </h1>


                    <!--Edit user-->
                    <form action="" method="post" enctype="multipart/form-data"><!--enctype multipart encodes the form differently if we have to upload files etc-->

                        <div class="form-group">
                            <label for="user_first_name">First Name</label>
                            <input id="user_first_name" type="text" class="form-control" name="user_first_name" value="<?php echo $user_first_name?>">
                        </div>


                        <div class="form-group">
                            <label for="user_last_name">Last Name</label>
                            <input id="user_last_name" type="text" class="form-control" name="user_last_name" value="<?php echo $user_last_name?>">
                        </div>

                        <div class="form-group">
                            <label for="user_role">User Role </label>
                            <div>
                                <select name="user_role" id="user_role">
                                    <?php echo "<option>$user_role</option>" ?>
                                    <?php

                                    if($user_role == 'subscriber'){
                                        echo "<option value='admin'>admin</option>";
                                    }else{
                                        echo "<option value='subscriber'>subscriber</option>";
                                    }



                                    ?>
                                </select>
                            </div>
                        </div>


                        <!--    <div class="form-group">-->
                        <!--        <label for="post_image">Post Image</label>-->
                        <!--        <input id="post_image" type="file" class="form-control" name="post_image">-->
                        <!--    </div>-->

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="<?php echo $session_username?>">
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input id="user_email" type="email" class="form-control" name="user_email" value="<?php echo $user_email?>">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input id="user_password" type="password" class="form-control" name="user_password" value="<?php echo $user_password?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Edit Profile">
                        </div>


                    </form><!--End edit user-->

                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<?php include 'includes/admin-footer.php' ?>

</body>

</html>