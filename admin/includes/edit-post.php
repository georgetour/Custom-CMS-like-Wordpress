<?php

if(isset($_GET['p_id'])) {

    $url_post_id = $_GET['p_id'];

}

    $query = "SELECT * FROM posts WHERE post_id = {$url_post_id}";
    $select_posts_by_id = mysqli_query($dbconnect, $query);


    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];

    }
        confirm($select_posts_by_id);


//Edits and updateS the post

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
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = {$url_post_id} ";
        $select_image = mysqli_query($dbconnect, $query);

        while ($row = mysqli_fetch_assoc($select_image)) {

            $post_image = $row['post_image'];

        }
    }


    $query = "UPDATE posts SET post_title = '{$post_title}',";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image  = '{$post_image}', ";
    $query .= "post_tags   = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$url_post_id} ";
    $edit_post = mysqli_query($dbconnect, $query);


    confirm($edit_post);


    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$url_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";


}




?>



<!--Edit post form-->
<form  action="" method="post" enctype="multipart/form-data"><!--enctype multipart encodes the form differently if we have to upload files etc-->

    <div class="form-group">
        <label for="post_title">Post title</label>
        <input id="post_title" type="text" class="form-control" name="post_title" value="<?php echo $post_title;?>">
    </div>

    <div class="form-group">
        <label for="post-category">Category</label>
        <select name="post_category" id="post-category">
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

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input id="post_author" type="text" class="form-control" name="post_author" value="<?php echo $post_author;?>">
    </div>


    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select  name="post_status" id="post_status">
            <option value='<?php echo $post_status?>'><?php echo $post_status?></option>
            <?php

            if($post_status == 'published') {

                echo "<option value='draft'>Draft</option>";

            }else{
                echo "<option value='published'>Published</option>";
            }
            ?>


        </select>
    </div>

    <div class="form-group">
        <h4>Current Image</h4>
        <img width="100px" src="../images/<?php echo $post_image?>">
    </div>

    <div class="form-group">
        <label for="post_image">New Image</label>
        <input id="post_image" type="file" class="form-control" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input id="post_tags" type="text" class="form-control" name="post_tags" value="<?php echo $post_tags;?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="post_content" class="form-control" name="post_content" cols="20" rows="10"><?php echo $post_content;?></textarea>
    </div>

    <div class="form-group">
        <input  type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>


</form><!--End edit post-->
