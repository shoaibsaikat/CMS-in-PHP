<?php include "includes/header.php"; ?>

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->

<?php
            $result = null;
            if (isset($_POST["submit"])) {
                // search by tag
                if ($_POST["search"]) {
                    $search = $_POST["search"];
                    $result = getPublishedPostsByTag($search);
                }
            } else if (isset($_GET["id"])) {
                // search by category id
                $id = $_GET["id"];
                $result = getPublishedPostsByCatagory($id);
            }

            if (isset($result)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        include "includes/post.php";
                    }
                } else {
                    echo "<h1>No Result</h1>";
                }
                mysqli_free_result($result);
            } else {
                die("QUERY FAILURE" . mysqli_error($connection));
            }
?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>
