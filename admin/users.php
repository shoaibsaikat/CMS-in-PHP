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
                    if (isset($_GET["make_admin"])) {
                        // make admin
                        makeAdminUser($_GET["make_admin"]);
                        header("Location: users.php");
                    } else if (isset($_GET["make_subscriber"])) {
                        // make subscriber
                        makeSubscriberUser($_GET["make_subscriber"]);
                        header("Location: users.php");
                    } else if (isset($_GET["delete"])) {
                        /*
                            NOTE: need to check the session before every get, post request
                        */
                        // delete
                        if (isset($_SESSION["role"])) {
                            if ($_SESSION["role"] == "admin") {
                                deleteUser(mysqli_real_escape_string($connection, $_GET["delete"]));
                                header("Location: users.php");
                            }
                        }
                    } else if (isset($_GET["source"])) {
                        // add, update
                        switch ($_GET["source"]) {
                            case 'add_users':
                                include "includes/add_users.php";
                                break;
                            case 'edit_users':
                                include "includes/edit_users.php";
                                break;
                            default:
                                include "includes/view_users.php";
                                break;
                        }
                    } else {
                        include "includes/view_users.php";
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
