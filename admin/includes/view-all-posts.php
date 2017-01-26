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


            echo "<tr>";
            echo "<td>{$post_id}</td>" ;
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";


                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                $select_categories_id = mysqli_query($dbconnect,$query);

                while($row = mysqli_fetch_assoc($select_categories_id)){
                $cat_id = $row['cat_id'];
                $cat_title =  $row['cat_title'];



                }
                 echo "<td> {$cat_title} </td>";
            echo "<td>{$post_status}</td>";
            echo"<td><img width='100px' src='../images/$post_image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            //Adding in our url parameters so we can get data according to them
            echo "<td><a href='posts.php?source=edit-post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>" ;
            echo "</tr>";

     }

     deletePost(); ?>

    </tbody>
</table>

</div>