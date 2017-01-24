<?php

//Safe way to connect  with db
$database['db_host']  = 'localhost';
$database['db_user']  = 'root';
$database['db_password']  = '';
$database['db_name']  = 'custom_cms';

//Make them upper case and constants so we can use them to connect
foreach($database as $key => $value){

    define(strtoupper($key),$value);

}


//Connect to DB
$dbconnect = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)OR die("Error Connecting to DB").mysqli_connect_error();



//if($dbconnect){
//   echo "Connected to DB";
//}





