<?php include 'includes/header.php' ?>

<!-- Navigation -->
    <?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php include 'includes/content.php'?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <?php include 'includes/sidebar.php'?>

            </div>

        </div>
        <!-- /.row -->

        <hr>
    <?php
    if(isset($_SESSION['username'])) {

        if (isset($_GET['p_id'])) {

            $url_post_id = $_GET['p_id'];

            echo "<h1 href='admin/posts.php?source=edit_post&p_id={$url_post_id}'>Edit Post</h1>";

        }
    }
    ?>

       <?php include "includes/footer.php"; ?>