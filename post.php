<?php include 'includes/header.php' ?>

    <!-- Navigation -->
<?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php include 'includes/post-content.php'?>


            <?php

            //===========Comments=========
            if(isset($_POST['create_comment'])) {

                $url_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];



                $query = "INSERT INTO comments(comment_post_id,
                            comment_author,
                            comment_email,
                            comment_content,
                            comment_status,
                            comment_date)
                            
                           VALUES(
                            '{$url_post_id}',
                            '{$comment_author}',
                            '{$comment_email}',
                            '{$comment_content}',
                            'unapproved',
                             now()
                       )";

                $create_comment_query = mysqli_query($dbconnect,$query);

                confirm($create_comment_query);


                //Incrementing the post_comment_count whenever we have a post
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $url_post_id ";

                $increment_comment_count = mysqli_query($dbconnect,$query);

                confirm($increment_comment_count);

            }

            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" role="form" method="post">
                    <div class="form-group">
                        <label for="comment_author">Your name</label>
                        <input id="comment_author" type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input id="comment_email" type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment_content">Comment</label>
                        <textarea id="comment_content" class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = '{$url_post_id}' ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($dbconnect,$query);

            confirm($select_comment_query);
            while($row = mysqli_fetch_array($select_comment_query)){

                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

            ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="/" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author ?>
                        <small><?php echo $comment_date?></small>
                    </h4>
                    <?php echo $comment_content?>
                </div>
            </div>
            <?php } ?>



        
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <?php include 'includes/sidebar.php'?>

        </div>

    </div>
    <!-- /.row -->

    <hr>


  




<?php include "includes/footer.php"; ?>