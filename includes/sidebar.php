
<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
        </div>
    </form><!--form-group -->
</div>




<!-- Blog Categories Well -->
<div class="well">

    <?php

    //All categories from db
    $query = "SELECT * FROM categories";
    $categories_sidebar = mysqli_query($dbconnect,$query);

    ?>

    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php

                while($row = mysqli_fetch_assoc($categories_sidebar)){
                $cat_id = $row['cat_id'];
                $cat_title =  $row['cat_title'];

                echo "<li><a href='category.php?category={$cat_id}' >{$cat_title}</a></li>";

                }

                ?>
            </ul>
        </div>



    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include 'widget.php'?>
