
    <?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php  include "includes/navbar.php"; ?>


    <?php

    $message = '';


    if(isset($_POST['register'])){

        $username = $_POST['username'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


        //Simple validation we can do more advanced stuff with flag variable
        if($user_password == $confirm_password && !empty($username) &&!empty($user_email) ){

            $username = mysqli_real_escape_string($dbconnect,$username);
            $user_email = mysqli_real_escape_string($dbconnect,$user_email);
            $user_password = mysqli_real_escape_string($dbconnect,$user_password);
            $confirm_password = $_POST['confirm_password'];

            $query = "SELECT randSalt FROM users";
            $select_randSalt_query = mysqli_query($dbconnect,$query);

            confirm( $select_randSalt_query);

            $row = mysqli_fetch_array( $select_randSalt_query);
            $salt = $row['randSalt'];
            $user_password = crypt($user_password,$salt);



            //Where to add
            $query = "INSERT INTO users(user_role,
              username,
              user_email,
              user_password) ";
            //values to add
            $query .= "VALUES ('subscriber',
              '{$username}',
              '{$user_email}',
              '{$user_password}')";


            $create_user_query = mysqli_query($dbconnect,$query);

            //Confirming the query else die and show error from functions
            confirm($create_user_query);



            $message ="Form submitted";



        }else {
            $message ="Form wasn't submitted !";
        }



    }


    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" pattern=".{6,}">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="sr-only">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" pattern=".{6,}">
                        </div>
                        <div class="text-center"><?php echo $message?></div>
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">

                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
