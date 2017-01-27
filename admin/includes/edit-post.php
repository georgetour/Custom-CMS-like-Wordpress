<?php

if(isset($_GET['p_id'])){

  $url_post_id = $_GET['p_id'];

$query = "SELECT * FROM posts WHERE post_id = $url_post_id";
$select_posts_by_id = mysqli_query($dbconnect,$query);

    confirm($select_posts_by_id);

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content =$row['post_content'];
    }
}

//Edits and updateS the post from functions
editPost();
?>



<!--Edit post form-->
<form action="" method="post" enctype="multipart/form-data"><!--enctype multipart encodes the form differently if we have to upload files etc-->

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
        <input id="post_status" type="text" class="form-control" name="post_status" value="<?php echo $post_status;?>">
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
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>


</form><!--End edit post-->