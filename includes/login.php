<?php

      include 'db_connect.php';
      include '../functions.php';

session_start();

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    //Preventing mysql injection
    $username = mysqli_real_escape_string($dbconnect, $username);
    $user_password = mysqli_real_escape_string($dbconnect, $user_password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($dbconnect, $query);

    confirm($select_user_query);

    while($row = mysqli_fetch_array($select_user_query)){

        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_first_name = $row['user_first_name'];
        $db_user_last_name = $row['user_last_name'];
        $db_user_role = $row['user_role'];

    $user_password = crypt($user_password,$db_user_password);
    }

    if($username === $db_username && $user_password === $db_user_password) {

       $_SESSION['username'] = $db_username;
       $_SESSION['user_first_name'] = $db_user_first_name;
       $_SESSION['user_last_name'] = $db_user_last_name;
       $_SESSION['user_role'] = $db_user_role;

       header("Location: ../admin");
        
    }else{
       header("Location: ../index.php");
    }



}



?>