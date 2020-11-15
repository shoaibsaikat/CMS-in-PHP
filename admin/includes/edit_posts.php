<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if ($result = getPostById($id)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row["post_title"];
                    $cat_id = $row["post_category_id"];
                    $author = $row["post_author"];
                    $status = $row["post_status"];
                    $image = $row["post_image"];
                    $date = $row["post_date"];
                    $tags = $row["post_tags"];
                    $content = $row["post_content"];
                }
            } else {
                header("Location: index.php");
            }
        }
    } else {
        header("Location: index.php");
    }

    if (isset($_POST["update_post"])) {
        $title = mysqli_real_escape_string($connection, $_POST["post_title"]);
        $cat_id = $_POST["post_category"];
        // $author = mysqli_real_escape_string($connection, $_POST["post_author"]);
        $status = mysqli_real_escape_string($connection, $_POST["post_status"]);

        /*
            if image file is empty then keep old value
        */
        if (!empty($_FILES["post_image"]["name"])) {
            echo $_FILES["post_image"]["name"];
            $image = $_FILES["post_image"]["name"];
            $image_tmp = $_FILES["post_image"]["tmp_name"];
        }

        $date = date("d-m-y");

        $tags = mysqli_real_escape_string($connection, $_POST["post_tags"]);
        $content = mysqli_real_escape_string($connection, $_POST["post_content"]);

        updatePost($id, $title, $cat_id, $status, $image, $date, $tags, $content);

        /*
            update file only if valid image is selected
        */
        if (!empty($image_tmp)) {
            move_uploaded_file($image_tmp, "../images/$image");
        }

        echo "<div class='bg-success'>Post updated. <a href='../post.php?id={$id}'>View post</a> or <a href='posts.php'>Edit more posts</a>.</div>";
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $title; ?>">
    </div>
    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <select class="form-control" id="post_cat" name="post_category">
<?php
            if ($result = getAllCategories()) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $catagory_id_list[$i] = $row["cat_id"];
                    $catagory_title_list[$i] = $row["cat_title"];
                    $i++;
                }

                // first option is the current one
                for ($i = 0; $i < count($catagory_id_list); $i++) {
                    if ($cat_id == $catagory_id_list[$i]) {
?>
                        <option value="<?php echo $catagory_id_list[$i]; ?>"><?php echo $catagory_title_list[$i]; ?></option>
<?php
                    }
                }

                // other options
                for ($i = 0; $i < count($catagory_id_list); $i++) {
                    if ($cat_id != $catagory_id_list[$i]) {
?>
                        <option value="<?php echo $catagory_id_list[$i]; ?>"><?php echo $catagory_title_list[$i]; ?></option>
<?php
                    }
                }
            }
?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author" value="<?php echo $author; ?>">
    </div> -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" id="post_status" name="post_status" >
<?php
            echo "<option value='{$status}'>" . ucfirst($status) ."</option>";

            if ($status == "draft") {
                echo "<option value='published'>Published</option>";
            } else {
                echo "<option value='draft'>Draft</option>";
            }
?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <div>
            <img src="../images/<?php echo $image; ?>" alt="" width="100">
        </div>
        <input type="file" id="post_image" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="test" class="form-control" id="post_tags" name="post_tags" value="<?php echo $tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="10" cols="30"><?php echo str_replace('\r\n', '<br>', $content); ?></textarea>
    </div>
    <button type="submit" name="update_post" class="btn btn-primary">Update post</button>
</form>
