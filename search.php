<?php include "includes/header.php"; ?>

    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
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
                $i = 0;
                while ($i < count($result)) {
                    $row = $result[$i];
                    include "includes/post.php";
                    $i++;
                }
            } else {
                echo "<h1>No Result</h1>";
            }
?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>
