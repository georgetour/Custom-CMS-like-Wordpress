<?php

    $query = "SELECT * FROM posts ";
    $all_posts_query = mysqli_query($dbconnect,$query);

    while($row = mysqli_fetch_assoc($all_posts_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,100);
        $post_status = $row['post_status'];


        if($post_status !== 'published'){

            echo "<h1>No posts</h1>";

        }else{





    //Loop finishes at the end


?>


<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="post.php?p_id=<?php echo "{$post_id}"?>"><?php echo $post_title;?></a>
</h2>
<p class="lead">
    by <a href="index.php"><?php echo $post_author;?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
<hr>
<img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
<hr>
<p><?php echo $post_content;?></p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo "{$post_id}"?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>




<?php } }//End while?>




