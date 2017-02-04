<div class="table-responsive">


    <table class="table table-bordered table-hover">

       

        <thead>
        <tr>
            <th>Id</th>
            <th>UserName</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>




        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($dbconnect,$query);

        while($row = mysqli_fetch_assoc($select_users)):
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_first_name = $row['user_first_name'];
            $user_last_name = $row['user_last_name'];
            $user_email = $row['user_email'];
            $user_image= $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];

            echo "<tr>";
            echo "<td>{$user_id}</td>" ;
            echo "<td>{$username}</td>";
            echo "<td>{$user_first_name}</td>";
            echo "<td>{$user_last_name}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";

//            //Relating post id to comment_post_id so we can have post_title for each post
//            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";//It was taken with get from the url
//            $select_post_id = mysqli_query($dbconnect,$query);
//             while($row = mysqli_fetch_assoc($select_post_id)){
//                 $post_id = $row['post_id'];
//                 $post_title = $row['post_title'];
//
//                 echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
//             }
            //echo "<td>{$comment_date}</td>";
            echo "<td><a href='users.php?source=edit-user&edit-user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";

            echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>" ;

            
            echo "</tr>";

        endwhile;

        //=======Delete user from admin area================
        deleteUser();

        //====Change user role  to Admin==========
        changeToAdmin();

        //====Change to user role Subscriber==========
        changeToSubscriber();


         ?>

        </tbody>
    </table>

</div>