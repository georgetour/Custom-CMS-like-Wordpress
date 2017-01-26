<?php

//Confirming the query else die and show error
function confirm($query){
    global $dbconnect;
    if(!$query){
        die("Query failed".mysqli_error($dbconnect));
    }

}


//Insert new category in our DB
function insertCategories(){
    global $dbconnect;

    if(isset($_POST['submit'])){
        $cat_title= $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{

            $query = "INSERT INTO categories(cat_title)";//This is from the db so no $ or ""
            $query .= "VALUES ('$cat_title') ";

            $create_category_query = mysqli_query($dbconnect,$query);
            if(!$create_category_query){
                die("Query failed".mysqli_error($dbconnect));
            }

        }
    }

}


//Showing all categories in a table 
function showAllCategoriesTable(){
    global $dbconnect;
    
    //All categories from db
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($dbconnect,$query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title =  $row['cat_title'];

        echo "<tr>
                 <td>{$cat_id}</td>
                 <td>{$cat_title}</td>
                 <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                 <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
              </tr>";
    }
    
}

//Delete category 
function deleteCategory(){
    global $dbconnect;
    
    if(isset($_GET['delete'])) {
        $url_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories ";
        $query .= "WHERE cat_id = {$url_cat_id} ";
        $delete_query = mysqli_query($dbconnect, $query);

        //Refresh the page header() is used to send a raw HTTP header
        header("Location: categories.php");
    }
}







?>