<?php include "includes/header.php"; ?>

<?php
    $user = "";
    if (isset($_GET["user"])) {
        $user = $_GET["user"];
    }
?>

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                All posts by
                <small><?php echo $user; ?></small>
            </h1>
<?php
            // search by username
            if ($result = getPostByUserName($user)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    include "includes/post.php";
                }
                mysqli_free_result($result);
            }
?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>
