<?php
if(isset($_POST['create_post'])){

    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id= $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image= $_FILES['post_image']['name'];
    $post_image_temp= $_FILES['post_image']['tmp_name'];

    $post_tags= $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
//    $post_comment_count = 4;

    //Moving from the temp file to our images folder the image when submitted
    move_uploaded_file($post_image_temp,"../images/$post_image");

    //Where to add
    $query = "INSERT INTO posts(post_category_id, 
              post_title, 
              post_author,
              post_date, 
              post_image, 
              post_content, 
              post_tags,  
              post_status)" ;
    //values to add
    $query .= "VALUES('{$post_category_id}',
              '{$post_title}',
              '{$post_author}',
                now(),
              '{$post_image}',
              '{$post_content}',
              '{$post_tags}',
              '{$post_status}')";


    $create_post_query = mysqli_query($dbconnect,$query);

    //Confirming the query else die and show error from functions
    confirm($create_post_query);

    //Pulling the last created id
    $url_post_id= mysqli_insert_id($dbconnect);

    echo "<p class='bg-success'>Post Added. <a href='../post.php?p_id={$url_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";


}

?>
<!--Add post form-->
<form action="" method="post" enctype="multipart/form-data"><!--enctype multipart encodes the form differently if we have to upload files etc-->

    <div class="form-group">
        <label for="post_title">Post title</label>
        <input id="post_title" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category </label>
        <div>
            <select name="post_category" id="post_category">
                <?php

                //Show select values dynamically
                $query = "SELECT * FROM categories ";
                $select_categories = mysqli_query($dbconnect,$query);

                confirm($select_categories);

                //Be careful here since we want to take the id but showing cat_title
                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title =  $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";

                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input id="post_author" type="text" class="form-control" name="post_author">
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <div>
            <select name="post_status" id="post_status">
                <option value='draft'>Select Options</option>;
                <option value='published'>Published</option>;
                <option value='draft'>Draft</option>;
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input id="post_image" type="file" class="form-control" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="post_content" class="form-control" name="post_content" cols="20" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>


</form><!--End Add post-->