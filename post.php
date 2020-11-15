<?php include "includes/header.php"; ?>

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->
<?php
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if ($result = getPostById($id)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row["post_title"];
                        $cat_id = $row["post_category_id"];
                        $author = $row["post_author"];
                        $status = $row["post_status"];
                        $image = $row["post_image"];
                        $date = $row["post_date"];
                        $tags = $row["post_tags"];
                        $content = $row["post_content"];
?>

                        <!-- Title -->
                        <h1><?php echo $title; ?></h1>

                        <!-- Author -->
                        <p class="lead">
                            by <a href="user_post.php?user=<?php echo $author; ?>"><?php echo $author; ?></a>
                        </p>

                        <hr>

                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>

                        <hr>

                        <!-- Preview Image -->
                        <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">

                        <hr>

                        <!-- Post Content -->
                        <!-- <p class="lead"><?php echo $content; ?></p> -->
                        <p><?php echo $content; ?></p>
<?php
                    }
                }
            } else {
                $id = null;
            }
?>
            <hr>

            <!-- Blog Comments -->

<?php
            if (isset($id) && isset($_POST["create_comment"])) {
                //echo $_POST["author"];
                if ($_POST["author"] != "" && $_POST["email"] != "" && $_POST["comment"] != "") {
                    addComment($id, $_POST["author"], $_POST["email"], $_POST["comment"]);
                } else {
?>
                    <div class="text-danger">Fields can't be empty!</div>
<?php
                }
            }
?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author" name="author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
<?php
            if ($result = getApprovedCommentsByPost($id)) {
                while ($row = mysqli_fetch_assoc($result)) {
?>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $row["comment_author"]; ?>
                                <small><?php echo $row["comment_date"]; ?></small>
                            </h4>
                            <?php echo $row["comment_content"]; ?>
                        </div>
                    </div>
<?php
                }
            }
?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

<?php include "includes/footer.php"; ?>
