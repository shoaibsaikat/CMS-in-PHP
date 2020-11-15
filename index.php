<?php include "includes/header.php"; ?>

<?php
    define('POST_PER_PAGE', 2);

    $total_posts = 0;
    $total_pages = 1;
    $current_page = 1;

    if ($result = getPublishedPosts()) {
        $total_posts = mysqli_num_rows($result);
        $total_pages = ceil($total_posts / POST_PER_PAGE);
    }

    if (isset($_GET["page"])) {
        $current_page = $_GET["page"];
    }
?>

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->

<?php
            if ($result = getPublishedPostsByIndex(($current_page - 1) * POST_PER_PAGE, POST_PER_PAGE)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    include "includes/post.php";
                }
                mysqli_free_result($result);
            }

            if ($total_posts == 0) {
                echo "<h2>No Posts</h2>";
            }
?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <ul class="pagination pagination-sm">

<?php
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?php echo $i; ?><span class="sr-only">(current)</span></span>
                </li>
<?php
            } else {
?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
            }
        }
?>
    </ul>

<?php include "includes/footer.php"; ?>
