<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author</th>
            <th scope="col">Comment</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">In Response To</th>
            <th scope="col">Date</th>
            <th scope="col">Approve</th>
            <th scope="col">Unapprove</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
<?php

        processCommentRequests();

        if (isset($_GET["id"])) {
            $comment_post_id = ($_GET["id"]);
        } else {
            die();
        }

        if ($result = getAllCommentsByPostId($comment_post_id)) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
?>
                <tr>
                    <!-- <th scope="row"><?php echo $row["comment_id"]; ?></th> -->
                    <th scope="row"><?php echo ++$i; ?></th>
                    <th scope="row"><?php echo $row["comment_author"]; ?></th>
                    <th scope="row"><?php echo $row["comment_content"]; ?></th>
                    <th scope="row"><?php echo $row["comment_email"]; ?></th>
                    <th scope="row"><?php echo $row["comment_status"]; ?></th>
                    <th scope="row">
<?php
                        if ($post_result = getPostById($comment_post_id)) {
                            while ($post_row = mysqli_fetch_assoc($post_result)) {
                                $comment_post_title = $post_row["post_title"];
                            }
                        }
?>
                        <a href="../post.php?id=<?php echo $comment_post_id; ?>"><?php echo $comment_post_title; ?></a>
                    </th>
                    <th scope="row"><?php echo $row["comment_date"]; ?></th>
                    <th scope="row">
                        <a href="?source=view_post_comments&id=<?php echo $comment_post_id; ?>&approve=<?php echo $row["comment_id"]; ?>">Approve</a>
                    </th>
                    <th scope="row">
                        <a href="?source=view_post_comments&id=<?php echo $comment_post_id; ?>&unapprove=<?php echo $row["comment_id"]; ?>">Unapprove</a>
                    </th>
                    <th scope="row">
                        <a href="?source=view_post_comments&id=<?php echo $comment_post_id; ?>&delete=<?php echo $row["comment_id"]; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                    </th>
                </tr>
<?php
            }
        }
?>
    </tbody>
</table>
