<div class="table-responsive">


<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>


    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($dbconnect,$query);

    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id= $row['post_category_id'];
        $post_status= $row['post_status'];
        $post_image= $row['post_image'];
        $post_tags= $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

        ?>

        <tr>
            <td><?php echo $post_id?></td>
            <td><?php echo $post_author?></td>
            <td><?php echo $post_title?></td>
            <td><?php echo $post_category_id?></td>
            <td><?php echo $post_status?></td>
            <td><img width="100px" src="../images/<?php echo $post_image?>"></td>
            <td><?php echo $post_tags?></td>
            <td><?php echo $post_comment_count?></td>
            <td><?php echo $post_date?></td>
        </tr>

    <?php }//End loop?>

    </tbody>
</table>

</div>