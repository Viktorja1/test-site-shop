<?php
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";

/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
function getAllPosts()
{
    global $conn;
    // Admin can view all posts
    // Author can only view their posts
    $sql = getUserRole();
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
        $post['author'] = getPostAuthorById($post['user_id']);
        array_push($final_posts, $post);
    }
    return $final_posts;
}

//get user role (admin or author)
function getUserRole () {
    if ($_SESSION['user']['role'] == "Admin") {
        $sql_admin = "SELECT * FROM posts";
        return $sql_admin;
    } elseif ($_SESSION['user']['role'] == "Author") {
        $user_id = $_SESSION['user']['id'];
        $sql_author = "SELECT * FROM posts WHERE user_id=$user_id";
        return $sql_author;
    }
}

// get the author/username of a post
function getPostAuthorById($user_id)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // return username
        return mysqli_fetch_assoc($result)['username'];
    } else {
        return null;
    }
}
?>