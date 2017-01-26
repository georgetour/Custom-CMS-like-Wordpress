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
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];


        //Don't let empty image in posts
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $url_post_id";
            $select_image = mysqli_query($dbconnect,$query);

            while($row = mysqli_fetch_assoc($select_image)) {

                $post_image = $row['post_image'];

            }
        }

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "UPDATE posts 
              SET post_title = '{$post_title}',
                  post_author = '{$post_author}',
                  post_date = now(),
                  post_status = '{$post_status}',
                  post_image  = '{$post_image}',
                  post_tags   = '{$post_tags}',
                  post_content = '{$post_content}'
                  WHERE post_id = {$url_post_id}
               
               ";
        $edit_post = mysqli_query($dbconnect, $query);

        confirm($edit_post);

        header("Location: posts.php");

    }
}

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





?>