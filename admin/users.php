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
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];

                        }else{
                            $source = '';
                        }
                        if($source== ""){
                            echo "All Users";
                        }else if($source=='add-user'){
                            echo "Add User";
                        }else if($source=='edit-user'){
                            echo "Edit User";
                        }

                        ?>
                        <small>Author</small>
                    </h1>
                    <?php



                    //According to GET source value we will get the page
                    switch ($source){
                        case 'add-user';
                            include 'includes/add-user.php';
                            break;
                        case 'edit-user';
                            include 'includes/edit-user.php';
                            break;

                        default:
                            include 'includes/view-all-users.php';
                            break;
                    }


                    ?>

                </div>
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<?php include 'includes/admin-footer.php' ?>

</body>

</html>