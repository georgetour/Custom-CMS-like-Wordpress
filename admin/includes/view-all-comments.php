<div class="table-responsive">


    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>


        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($dbconnect,$query);

        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status= $row['comment_status'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>{$comment_id}</td>" ;
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";


            //Relating post id to comment_post_id so we can have post_title for each post
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";//It was taken with get from the url
            $select_post_id = mysqli_query($dbconnect,$query);
             while($row = mysqli_fetch_assoc($select_post_id)){
                 $post_id = $row['post_id'];
                 $post_title = $row['post_title'];

                 echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
             }
            echo "<td>{$comment_date}</td>";
            //Adding in our url parameters so we can get data according to them
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";

            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>" ;
            
            echo "</tr>";

        }

        //====Approve comment==========
        approveComment();

        //====Unapprove comment==========
        unapproveComment();

        //=======Delete comment from admin area================
        deleteComment();
         ?>

        </tbody>
    </table>

</div>