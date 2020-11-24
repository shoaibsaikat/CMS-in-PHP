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
        if ($result = getAllComments()) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
?>
                <tr>
                    <!-- <td scope="row"><?php echo $row["comment_id"]; ?></td> -->
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td scope="row"><?php echo $row["comment_author"]; ?></td>
                    <td scope="row"><?php echo $row["comment_content"]; ?></td>
                    <td scope="row"><?php echo $row["comment_email"]; ?></td>
                    <td scope="row"><?php echo $row["comment_status"]; ?></td>
                    <td scope="row">
<?php
                        $comment_post_title = "";
                        $comment_post_id = $row["comment_post_id"];
                        if ($post_result = getPostById($comment_post_id)) {
                            while ($post_row = mysqli_fetch_assoc($post_result)) {
                                $comment_post_title = $post_row["post_title"];
                            }
                        }
?>
                        <a href="../post.php?id=<?php echo $comment_post_id; ?>"><?php echo $comment_post_title; ?></a>
                    </td>
                    <td scope="row"><?php echo $row["comment_date"]; ?></td>
                    <td scope="row">
                        <a href="?approve=<?php echo $row["comment_id"]; ?>">Approve</a>
                    </td>
                    <td scope="row">
                        <a href="?unapprove=<?php echo $row["comment_id"]; ?>">Unapprove</a>
                    </td>
                    <td scope="row">
                        <a href="?delete=<?php echo $row["comment_id"]; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                    </td>
                </tr>
<?php
            }
        }
?>
    </tbody>
</table>
