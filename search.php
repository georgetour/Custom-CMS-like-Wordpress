<?php include 'includes/header.php' ?>

    <!-- Navigation -->
<?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_POST['submit'])){

                $search = $_POST['search'] ;

                //Selecting from all posts the post tags where value our $search
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";//The % is used to find missing letters(wildcards)


                $search_query = mysqli_query($dbconnect,$query);

                if(!$search_query){
                    //Show errors if we have problem
                    die("Query failed").mysqli_error($dbconnect);
                }

                $count = mysqli_num_rows($search_query);

                if ($count == 0){

                    echo "No result";
                }else{

                    echo "We have result";

                }


            }

            while($row = mysqli_fetch_assoc($search_query)){

            $post_title =  $row['post_title'];
            $post_author = $row['post_author'];
            $post_date =   $row['post_date'];
            $post_image =  $row['post_image'];
            $post_content =  $row['post_content'];

            ?>


            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title;?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
            <hr>
            <p><?php echo $post_content;?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php } //End while loop ?>
        </div><!--Left column-->





        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <?php include 'includes/sidebar.php'?>

        </div>

    </div><!--End row-->


    <hr>

<?php include "includes/footer.php"; ?>