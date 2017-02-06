<?php

if(isset($_GET['edit-user'])){

    $url_user_id= $_GET['edit-user'];

    $query = "SELECT * FROM users WHERE user_id = $url_user_id";
    $select_users_by_id = mysqli_query($dbconnect,$query);

    confirm($select_users_by_id);


    while($row = mysqli_fetch_assoc($select_users_by_id)) {
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_role = $row['user_role'];
        $username= $row['username'];
        $user_email = $row['user_email'];
        $user_password= $row['user_password'];

    }

    //Update query post
    if(isset($_POST['edit_user'])) {
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];

        //$post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];

        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($dbconnect,$query);

        confirm($select_randSalt_query);

        $row = mysqli_fetch_array( $select_randSalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password,$salt);


//        //Don't let empty image in posts
//        if(empty($post_image)){
//            $query = "SELECT * FROM posts WHERE post_id = $url_user_id";
//            $select_image = mysqli_query($dbconnect,$query);
//
//            while($row = mysqli_fetch_assoc($select_image)) {
//
//                $post_image = $row['post_image'];
//
//            }
//        }
//
//        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "UPDATE users 
              SET user_first_name = '{$user_first_name}',
                  user_last_name = '{$user_last_name}',
                  user_role = '{$user_role}',
                  username = '{$username}',
                  user_email  = '{$user_email}',
                  user_password   = '{$hashed_password}'
                  WHERE user_id = {$url_user_id}
               
               ";
        $edit_user = mysqli_query($dbconnect, $query);

        confirm($edit_user);

        echo "<p class='bg-success'>User updated. <a href='users.php'>View Users</a></p>";


    }
}





?>
<!--Edit user-->
<form  method="post" enctype="multipart/form-data"><!--enctype multipart encodes the form differently if we have to upload files etc-->

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
        <input id="username" type="text" class="form-control" name="username" value="<?php echo $username?>">
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit user">
    </div>


</form><!--End edit user-->
