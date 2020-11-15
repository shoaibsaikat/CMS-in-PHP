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
                    // view post comments or all
                    if (isset($_GET["source"])) {
                        $source = $_GET["source"];
                        switch ($source) {
                            case "view_post_comments":
                                include "includes/view_post_comments.php";
                                break;
                            default:
                                processCommentRequests();
                                //header("Location: comments.php");
                                include "includes/view_comments.php";
                                break;
                        }
                    } else {
                        processCommentRequests();
                        //header("Location: comments.php");
                        include "includes/view_comments.php";
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
