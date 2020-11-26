<?php

/*
    Page
*/

function processCommentRequests() {

    if (isset($_GET["approve"])) {
        // approved
        // echo "in approve<br>";
        approveComment($_GET["approve"]);
    } else if (isset($_GET["unapprove"])) {
        // unapprove
        // echo "in unapprove<br>";
        unapproveComment($_GET["unapprove"]);
    } else if (isset($_GET["delete"])) {
        // delete
        // echo "in delete<br>";
        deleteComment($_GET["delete"]);
    }
}


/* ------------------------------------------------------------------------------- DB -------------------------------------------------------------------------------  */
/*
    Category
*/
// create
function addCategory($title) {
    global $connection;
    $query = "INSERT INTO categories (cat_title) VALUES ('{$title}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

// read
function getAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories ORDER BY cat_title";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getCategory($id) {
    global $connection;
    $query = "SELECT * FROM categories WHERE cat_id = $id";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

// update
function updateCatatory($id, $title) {
    global $connection;
    $query = "UPDATE categories SET cat_title = '{$title}' WHERE cat_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

// delete
function deleteCategory($id) {
    global $connection;
    $query = "DELETE from categories WHERE cat_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("DELETE ERROR " . mysqli_error($connection));
    }
}

/*
    Post
*/
// create
function addPost($title, $cat_id, $author, $status, $image, $date, $tags, $content) {
    global $connection;
    if (!isset($status) || strlen($status) == 0) {
        $status = "draft";
    }
    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ('{$cat_id}', '{$title}', '{$author}', '{$date}', '{$image}', '{$content}', '{$tags}', '{$status}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

// read
function getAllPosts() {
    global $connection;
    $query = "SELECT    posts.post_id,
                        posts.post_category_id,
                        posts.post_title,
                        posts.post_author,
                        posts.post_date,
                        posts.post_image,
                        posts.post_content,
                        posts.post_tags,
                        posts.post_status,
                        categories.cat_title
                        FROM posts
                        LEFT JOIN categories ON categories.cat_id = posts.post_category_id
                        ORDER BY post_status DESC";
    // $query .= "FROM posts LEFT JOIN catagories ON catagories.cat_id = posts.post_category_id ORDER BY post_status DESC";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getPublishedPosts() {
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'published'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getPublishedPostsByIndex($start, $num) {
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT {$start}, {$num}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getPublishedPostsByCatagory($cat_id) {
    global $connection;
    $status = 'published';

    $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_tags,
                                            post_status, post_content, post_image, post_date, post_category_id
                                            FROM posts
                                            WHERE post_category_id = ? AND post_status = ?");

    mysqli_stmt_bind_param($stmt, 'is', $cat_id, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_tags,
    $post_status, $post_content, $post_image, $post_date, $post_category_id);

    $i = 0;
    while (mysqli_stmt_fetch($stmt)) {
        $result[$i]['post_id'] = $post_id;
        $result[$i]['post_title'] = $post_title;
        $result[$i]['post_author'] = $post_author;
        $result[$i]['post_tags'] = $post_tags;
        $result[$i]['post_status'] = $post_status;
        $result[$i]['post_content'] = $post_content;
        $result[$i]['post_image'] = $post_image;
        $result[$i]['post_date'] = $post_date;
        $result[$i]['post_category_id'] = $post_category_id;

        $i++;
    }

    if (isset($result))
        return $result;
    return null;
}

function getPublishedPostsByTag($tag) {
    global $connection;
    $status = 'published';

    $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_tags,
                                            post_status, post_content, post_image, post_date, post_category_id
                                            FROM posts
                                            WHERE post_tags LIKE ? AND post_status = 'published'");

    $param = "%{$tag}%";
    mysqli_stmt_bind_param($stmt, 's', $param);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_tags,
    $post_status, $post_content, $post_image, $post_date, $post_category_id);

    $i = 0;
    while (mysqli_stmt_fetch($stmt)) {
        $result[$i]['post_id'] = $post_id;
        $result[$i]['post_title'] = $post_title;
        $result[$i]['post_author'] = $post_author;
        $result[$i]['post_tags'] = $post_tags;
        $result[$i]['post_status'] = $post_status;
        $result[$i]['post_content'] = $post_content;
        $result[$i]['post_image'] = $post_image;
        $result[$i]['post_date'] = $post_date;
        $result[$i]['post_category_id'] = $post_category_id;

        $i++;
    }

    if (isset($result))
        return $result;
    return null;
}

function getDraftPosts() {
    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getPostById($id) {
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$id}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getPostByUserName($name) {
    global $connection;
    $query = "SELECT * FROM posts WHERE post_author = '{$name}'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

// update
function updatePost($id, $title, $cat_id, $status, $image, $date, $tags, $content) {
    global $connection;
    if (!isset($status) || strlen($status) == 0) {
        $status = "draft";
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$title}', ";
    $query .= "post_category_id = '{$cat_id}', ";
    // $query .= "post_author = '{$author}', ";
    $query .= "post_status = '{$status}', ";
    $query .= "post_image = '{$image}', ";
    $query .= "post_date = '{$date}', ";
    $query .= "post_tags = '{$tags}', ";
    $query .= "post_content = '{$content}' ";
    $query .= "WHERE post_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function publishPost($id) {
    global $connection;
    $query = "UPDATE posts SET ";
    $query .= "post_status = 'published' ";
    $query .= "WHERE post_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function draftPost($id) {
    global $connection;
    $query = "UPDATE posts SET ";
    $query .= "post_status = 'draft' ";
    $query .= "WHERE post_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function incrementPostViewCount($id) {
    global $connection;
    $query = "UPDATE posts SET ";
    $query .= "post_status = 'draft' ";
    $query .= "WHERE post_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

// delete
function deletePost($id) {
    global $connection;
    $query = "DELETE from posts WHERE post_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("DELETE ERROR " . mysqli_error($connection));
    }
}

/*
    Comment
*/
// create
function addComment($post_id, $author, $email, $content) {
    global $connection;
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
    $query .= "VALUES ($post_id, '{$author}', '{$email}', '{$content}', 'unapproved', now())";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

// read
function getAllComments() {
    global $connection;
    $query = "SELECT * FROM comments";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getAllCommentsByPostId($id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id = $id";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getApprovedComments() {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUnpprovedComments() {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getApprovedCommentsByPost($id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_status = 'approved' AND comment_post_id = $id";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getCommentsByPost($id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id = $id";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

// update
function approveComment($id) {
    global $connection;
    $query = "UPDATE comments SET ";
    $query .= "comment_status = 'approved' ";
    $query .= "WHERE comment_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function unapproveComment($id) {
    global $connection;
    $query = "UPDATE comments SET ";
    $query .= "comment_status = 'unapproved' ";
    $query .= "WHERE comment_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

// delete
function deleteComment($id) {
    global $connection;
    $query = "DELETE from comments WHERE comment_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("DELETE ERROR " . mysqli_error($connection));
    }
}

/*
    User
*/

// create
function registerUser($username, $email, $password) {
    global $connection;
    $query = "INSERT INTO users (user_username, user_email, user_password, user_role) ";
    $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

function addUser($firstname, $lastname, $username, $image, $role, $email, $password) {
    global $connection;
    $query = "INSERT INTO users (user_firstname, user_lastname, user_username, user_image, user_role, user_email, user_password) ";
    $query .= "VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$image}', '{$role}', '{$email}', '{$password}')";
    if (!mysqli_query($connection, $query)) {
        die("INSERT ERROR " . mysqli_error($connection));
    }
}

// read
function getAllUsers() {
    global $connection;
    $query = "SELECT * FROM users";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getAllSubscribers() {
    global $connection;
    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUserById($id) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = {$id}";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function getUserByUsername($name) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_username = '{$name}'";
    if ($result = mysqli_query($connection, $query))
        return $result;
    return null;
}

function isDuplicateUsername($name) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_username = '{$name}'";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) == 0)
            return false;
        return true;
    }
    return false;
}

// update
function makeAdminUser($id) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_role = 'admin' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function makeSubscriberUser($id) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_role = 'subscriber' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function updateUserWithoutPassword($id, $firstname, $lastname, $username, $image, $role, $email) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_lastname = '{$lastname}', ";
    $query .= "user_username = '{$username}', ";
    $query .= "user_image = '{$image}', ";
    $query .= "user_role = '{$role}', ";
    $query .= "user_email = '{$email}' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

function updateUser($id, $firstname, $lastname, $username, $image, $role, $email, $password) {
    global $connection;
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$firstname}', ";
    $query .= "user_lastname = '{$lastname}', ";
    $query .= "user_username = '{$username}', ";
    $query .= "user_image = '{$image}', ";
    $query .= "user_role = '{$role}', ";
    $query .= "user_email = '{$email}', ";
    $query .= "user_password = '{$password}' ";
    $query .= "WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("UPDATE ERROR " . mysqli_error($connection));
    }
}

// delete
function deleteUser($id) {
    global $connection;
    $query = "DELETE from users WHERE user_id = {$id}";
    if (!mysqli_query($connection, $query)) {
        die("DELETE ERROR " . mysqli_error($connection));
    }
}

?>
