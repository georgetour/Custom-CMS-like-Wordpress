<?php include 'includes/admin-header.php' ?>

<body>


    <div id="wrapper">
        
        <!-- Navigation -->
        <?php include 'includes/admin-navbar.php' ?>
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin 
                            <?php echo $_SESSION['user_first_name'];?>
                        </h1>
                    </div>
                </div>
                <!-- End page heading row -->

                <!--Widgets layout-->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php

                                        selectAll("posts");
                                        $count_posts = mysqli_num_rows($result_query);
                                        echo "<div class='huge'>$count_posts</div>";

                                        ?>

                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php

                                        selectAll("comments");
                                        $count_comments = mysqli_num_rows($result_query);
                                        echo "<div class='huge'>$count_comments</div>";
                                        ?>

                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php

                                        selectAll("users");
                                        $count_users = mysqli_num_rows($result_query);
                                        echo "<div class='huge'>$count_users</div>";
                                        ?>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php

                                        selectAll("categories");
                                        $count_categories = mysqli_num_rows($result_query);
                                        echo "<div class='huge'>$count_categories</div>";
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!--End Widgets layout row-->
                
                
                <?php

                $query = "SELECT * FROM posts WHERE post_status ='published'";
                $select_all_published_posts = mysqli_query($dbconnect,$query);
                $post_published_count = mysqli_num_rows($select_all_published_posts);

                $query = "SELECT * FROM posts WHERE post_status ='draft'";
                $select_all_draft_posts = mysqli_query($dbconnect,$query);
                $post_draft_count = mysqli_num_rows($select_all_draft_posts);

                $query = "SELECT * FROM comments WHERE comment_status ='unapproved'";
                $unapproved_comments = mysqli_query($dbconnect,$query);
                $unapproved_comments_count = mysqli_num_rows($unapproved_comments);


                $query = "SELECT * FROM users WHERE user_role ='subscriber'";
                $subscriber_users = mysqli_query($dbconnect,$query);
                $count_subscribers = mysqli_num_rows($subscriber_users);


                ?>


                <!--Charts row-->
                <div class="row">
                    <div id="columnchart_material" class="charts"></div>

                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php

                                $element_text = ['Published posts','Active posts','Draft','Comments','Unapproved','Users','Subscribers','Categories'];
                                $element_count = [$post_published_count,$count_posts,$post_draft_count,$count_comments,$unapproved_comments_count, $count_users,$count_subscribers , $count_categories];

                                $array_length = count($element_text);

                                for($i = 0; $i < $array_length; $i++ ){

                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                                }


                                ?>




                                //['posts', 1000] tHE LOOP above passes values dynamically at our chart
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: ''
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                    </script>
                </div><!--End Charts row-->
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include 'includes/admin-footer.php' ?>

</body>

</html>
