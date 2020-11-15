<?php
    if (isset($_POST["submit_post"])) {
        $title = mysqli_real_escape_string($connection, $_POST["post_title"]);
        $cat_id = mysqli_real_escape_string($connection, $_POST["post_category"]);
        // $author = mysqli_real_escape_string($connection, $_POST["post_author"]);
        $status = mysqli_real_escape_string($connection, $_POST["post_status"]);
        $author = $_SESSION["username"];

        $image = $_FILES["post_image"]["name"];
        $image_tmp = $_FILES["post_image"]["tmp_name"];

        $date = date("d-m-y");

        $tags = mysqli_real_escape_string($connection, $_POST["post_tags"]);
        $content = mysqli_real_escape_string($connection, $_POST["post_content"]);
        addPost($title, $cat_id, $author, $status, $image, $date, $tags, $content);
        move_uploaded_file($image_tmp, "../images/$image");

        $post_id = mysqli_insert_id($connection);

        //echo "Post created: " . "<a href='posts.php'>View Posts</a>";
        echo "<div class='bg-success'>Post created: <a href='../post.php?id={$post_id}'>View post</a> or <a href='posts.php'>Edit more posts</a>.</div>";
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <select class="form-control" id="post_cat" name="post_category">
<?php
            if ($result = getAllCategories()) {
                while ($row = mysqli_fetch_assoc($result)) {
?>
                    <option value="<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_title"]; ?></option>
<?php
                }
            }
?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author">
    </div> -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control"  id="post_status" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" id="post_image" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="test" class="form-control" id="post_tags" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="10" cols="30"></textarea>
    </div>
    <button type="submit" name="submit_post" class="btn btn-primary">Add post</button>
</form>
