# Custom-CMS-like-Wordpress
Custom Responsive CMS 

- This is a project for a Custom CMS
- For front end we will use HTML5/CSS3, Javascript/Jquery, Bootstrap and for back end PHP/Mysql
- We will have administration, register and login for users, post, search, recent posts, excerpt, 
comments and many more features that you see in Wordpress/other CMS 


# Structure
Explanation for each file so we understand what every folder does:

<h3>admin - Everything for the admin area will be inserted here </h3>
<ul>
    <li>css -> Our css for the admin area</li>
    <li>font-awesome -> Extra icons from font-awesome</li>
    <li>fonts -> Some extra fonts</li>
    <li>
        <p>includes - folder that we have our template for each circumstance</p>
        <ul>
            <li>add-post.php -> insert post to db </li>
            <li>add-user.php -> insert user to db </li>
            <li>admin-footer.php -> the footer of admin area which has our scripts </li>
            <li>admin-header.php -> html head with styling and what we need to run at start like connection to db, functions etc...  </li>
            <li>admin-navbar.php -> top and side navigation </li>
            <li>edit-categories.php -> edit a category</li>
            <li>edit-post.php -> edit a post</li>
            <li>edit-user.php -> edit user</li>
            <li>view-all-comments.php -> table that shows all comments</li>
            <li>view-all-posts.php -> table that shows all posts</li>
            <li>view-all-users.php -> table that shows all users</li>

        </ul>
    </li>
    <li>js -> jquery, bootstrap.js, all files for the wysiwyg editor </li>
    <li>categories.php -> the categories page </li>
    <li>comments.php -> the categories page </li>
    <li>index.php -> our dashboard with the google charts and details for how many posts, comments, users, categories </li>
    <li>posts.php -> using switch and according what we GET from URL shows posts/edit post </li>
    <li>profile.php -> you can edit directly the profile of the user who is connected thanks to SESSIONS </li>
    <li>users.php -> using switch and according what we GET from URL shows users/edit-user  </li>

</ul>
- css - Nothing strange our css
- database tables - You can find the tables that will be used so you just create a new database, import them and connect to your DB
- fonts - Extra fonts
- images - We will insert our images 
- includes - Files like connection to DB, navbar, footer etc so we don't repeat ourselves and just call them where we want
- js - Javascript for the site
- static layout template - Here you can find the responsive static layout
- category.php - Viewing posts for currect category only
- functions.php - Clean, maintainable code with functions that's called when needed anywhere
- index.php - Main page that shows all posts and we can have our navigation
- posts.php - Showing current post from excerpt from main page
- search.php - Search page when we submit a search at main page
