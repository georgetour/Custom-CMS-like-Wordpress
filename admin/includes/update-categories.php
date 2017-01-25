<!--Update category -->
<form method="post">
    <div class="form-group">
        <label for="cat_title">Update category</label>

        <?php if(isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
            $select_categories_id = mysqli_query($dbconnect,$query);

            while($row = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $row['cat_id'];
                $cat_title =  $row['cat_title'];

            }
            ?>

            <input id="cat_title"  value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

        <?php }//End if ?>

        <?php

        //Update Query
        if(isset($_POST['update_category'])) {
            $url_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$url_cat_title}' ";
            $query .= "WHERE cat_id = {$cat_id} ";
            $update_query = mysqli_query($dbconnect, $query);

            if(!$update_query){
                die("QUERY FAILED".mysqli_error($dbconnect));
            }

            header("Location: categories.php");

        }

        ?>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update category">

    </div>
</form><!--End Update category -->