<?php

//==============Confirming the query else die and show error===============
function confirm($query){
    global $dbconnect;
    if(!$query){
        die("Query failed ".mysqli_error($dbconnect));
    }

}


//==============Insert new category in our DB==============
function insertCategories(){
    global $dbconnect;

    if(isset($_POST['submit'])){
        $cat_title= $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{

            $query = "INSERT INTO categories(cat_title)";//This is from the db so no $ or ""
            $query .= "VALUES ('$cat_title') ";

            $create_category_query = mysqli_query($dbconnect,$query);
            if(!$create_category_query){
                die("Query failed".mysqli_error($dbconnect));
            }

        }
    }

}


//=============Showing all categories in a table ===================
function showAllCategoriesTable(){
    global $dbconnect;
    
    //All categories from db
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($dbconnect,$query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title =  $row['cat_title'];

        echo "<tr>
                 <td>{$cat_id}</td>
                 <td>{$cat_title}</td>
                 <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                 <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
              </tr>";
    }
    
}

//==============Delete category ======================
function deleteCategory(){
    global $dbconnect;
    
    if(isset($_GET['delete'])) {
        $url_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories ";
        $query .= "WHERE cat_id = {$url_cat_id} ";
        $delete_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: categories.php");
    }
}



//===========Edit post===============
function editPost(){
    global $dbconnect;
    global $url_post_id;

    //Update query post
    if(isset($_POST['edit_post'])) {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        //Don't let empty image in posts
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = {$url_post_id} ";
            $select_image = mysqli_query($dbconnect,$query);

            while($row = mysqli_fetch_assoc($select_image)) {

                $post_image = $row['post_image'];

            }
        }



        $query = "UPDATE posts SET post_title = '{$post_title}',";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), " ;
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_image  = '{$post_image}', ";
        $query .= "post_tags   = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}' ";
        $query .= "WHERE post_id = {$url_post_id} ";

        $edit_post = mysqli_query($dbconnect, $query);

        confirm($edit_post);

        //Refresh the page
        header("Location: posts.php?source=edit-post&p_id=$url_post_id");

    }
}

//===========Edit user===============
function editUser(){
    global $dbconnect;
    global $url_user_id;

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
                  user_password   = '{$user_password}'
                  WHERE user_id = {$url_user_id}
               
               ";
        $edit_user = mysqli_query($dbconnect, $query);

        confirm($edit_user);

        header("Location: users.php");
    }
}

//===========Edit profile===============
function editProfile(){
    global $dbconnect;
    global $session_username;

    //Update query post
    if(isset($_POST['edit_user'])) {
        $user_first_name = $_POST['user_first_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_role = $_POST['user_role'];
        $session_username = $_POST['username'];

        //$post_image = $_FILES['post_image']['name'];
        // $post_image_temp = $_FILES['post_image']['tmp_name'];

        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


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
                  username = '{$session_username}',
                  user_email  = '{$user_email}',
                  user_password   = '{$user_password}'
                  WHERE username = '{$session_username}'
               
               ";
        $edit_user = mysqli_query($dbconnect, $query);

        confirm($edit_user);

        header("Location: users.php");

    }
}





//TODO MAKE THEM ONE FUNCTION WITH ONE PARAMETER
//=============Delete post================
function deletePost(){
    global $dbconnect;

    if(isset($_GET['delete'])){
        $url_post_id = $_GET['delete'];
        $query = "DELETE FROM posts ";
        $query .= "WHERE post_id = {$url_post_id} ";
        $delete_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: posts.php");
    }


}


//=======Delete comment from admin area================
function deleteComment(){
    global $dbconnect;

    if(isset($_GET['delete'])){
        $url_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments ";
        $query .= "WHERE comment_id = {$url_comment_id} ";
        $delete_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: comments.php");
    }


}

//====Change user role  to Admin==========
function changeToAdmin(){
    global $dbconnect;

    if(isset($_GET['change_to_admin'])){
        $url_user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' ";
        $query .= "WHERE user_id = {$url_user_id} ";
        $user_admin_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: users.php");
    }

}

//====Change to user role Subscriber==========
function changeToSubscriber(){
    global $dbconnect;

    if(isset($_GET['change_to_subscriber'])){
        $url_user_id = $_GET['change_to_subscriber'];
        $query = "UPDATE users SET user_role = 'subscriber' ";
        $query .= "WHERE user_id = {$url_user_id}";
        $user_subscriber_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: users.php");
    }

}



//=======Delete USER from admin area================
function deleteUser(){
    global $dbconnect;

    if(isset($_GET['delete'])){
        $url_user_id = $_GET['delete'];
        $query = "DELETE FROM users ";
        $query .= "WHERE user_id = {$url_user_id} ";
        $delete_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: users.php");
    }


}



//====Unapprove comment==========
function unapproveComment(){
    global $dbconnect;

    if(isset($_GET['unapprove'])){
        $url_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved' ";
        $query .= "WHERE comment_id = {$url_comment_id}";
        $unapprove_comment_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: comments.php");
    }
    
}

//====Approve comment==========
function approveComment(){
    global $dbconnect;

    if(isset($_GET['approve'])){
        $url_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' ";
        $query .= "WHERE comment_id = {$url_comment_id}";
        $unapprove_comment_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: comments.php");
    }

}

//According to parameter we will have everything from that table and how many rows it has
function selectAll($whatTable){
    global $dbconnect;
    global $result_query;

    $query = "SELECT * FROM $whatTable";
    $result_query = mysqli_query($dbconnect,$query);

    
}






?>