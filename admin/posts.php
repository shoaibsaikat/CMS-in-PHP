<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/greetings.php"; ?>
<?php
                    // publish
                    if (isset($_GET["publish"])) {
                        publishPost($_GET["publish"]);
                        header("Location: posts.php");
                    }

                    // delete
                    if (isset($_GET["delete"])) {
                        deletePost($_GET["delete"]);
                        header("Location: posts.php");
                    }

                    // add, update
                    if (isset($_GET["source"])) {
                        $source = $_GET["source"];
                        switch ($source) {
                            case 'add_posts':
                                include "includes/add_posts.php";
                                break;
                            case 'edit_posts':
                                include "includes/edit_posts.php";
                                break;
                            default:
                                include "includes/wiew_posts.php";
                                break;
                        }
                    } else {
                        include "includes/view_posts.php";
                    }
?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


<?php include "includes/footer.php" ?>
