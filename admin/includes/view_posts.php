<?php
    if (isset($_POST["bulk_apply"]) && $_POST["bulk_option"]) {
        $post_selection = $_POST["post_selection"];
        foreach ($post_selection as $id) {
            switch ($_POST["bulk_option"]) {
                case 'published':
                    publishPost($id);
                    break;
                case 'draft':
                    draftPost($id);
                    break;
                case 'delete':
                    deletePost($id);
                    break;
                default:
                    break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered">
        <div id="bulk_selection" class="col-xs-4">
            <select class="form-control" name="bulk_option">
                <option value="">Select one option</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input class="btn btn-success" type="submit" name="bulk_apply" value="Apply">
            <a class="btn btn-primary" href="?source=add_posts">Add New</a>
        </div>
        <br>
        <br>
        <thead>
            <tr>
                <th scope="col">
                    <input type="checkbox" id="selectAllPosts" name="" value="">
                </th>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col">Tags</th>
                <th scope="col">Comments</th>
                <th scope="col">Date</th>
                <th scope="col">Publish</th>
                <th scope="col">View</th>
                <th scope="col">Update</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
<?php
            if ($result = getAllPosts()) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
?>
                    <tr>
                        <td scope="row">
                            <input type="checkbox" class="selectPost" name="post_selection[]" value="<?php echo $row["post_id"]; ?>">
                        </td>
                        <!-- <td scope="row"><?php echo $row["post_id"]; ?></td> -->
                        <td scope="row"><?php echo ++$i; ?></th>
                        <td scope="row"><?php echo $row["post_author"]; ?></td>
                        <td scope="row"><?php echo $row["post_title"]; ?></td>
                        <td scope="row"><?php echo $row["cat_title"]; ?></td>
                        <td scope="row"><?php echo $row["post_status"]; ?></td>
                        <td scope="row">
                            <img src="../images/<?php echo $row["post_image"]; ?>" alt="<?php echo $row["post_image"]; ?>" width="100">
                        </td>
                        <td scope="row"><?php echo $row["post_tags"]; ?></td>
<?php
                        if ($post_comment_result = getCommentsByPost($row["post_id"])) {
                            $post_comment_count = mysqli_num_rows($post_comment_result);
                        }
?>
                        <td scope="row">
                            <a href="comments.php?source=view_post_comments&id=<?php echo $row["post_id"]; ?>">
                                <?php echo $post_comment_count; ?>
                            </a>
                        </td>
                        <td scope="row"><?php echo $row["post_date"]; ?></td>
                        <td scope="row">
                            <a href="posts.php?publish=<?php echo $row["post_id"]; ?>">Publish</a>
                        </td>
                        <td scope="row">
                            <a href="../post.php?id=<?php echo $row["post_id"]; ?>">Go</a>
                        </td>
                        <td scope="row">
                            <a href="posts.php?source=edit_posts&id=<?php echo $row["post_id"]; ?>">Edit</a>
                        </td>
                        <td scope="row">
                            <a href="posts.php?delete=<?php echo $row["post_id"]; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                        </td>
                    </tr>
<?php
                }
            }
?>
        </tbody>
    </table>

</form>
