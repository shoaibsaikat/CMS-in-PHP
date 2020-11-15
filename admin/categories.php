<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/greetings.php"; ?>
                    <div class="col-lg-6">
                        <?php include "includes/add_categories.php"; ?>
                        <br>
                        <?php include "includes/update_categories.php"; ?>
                    </div>
                    <div class="col-lg-6">
<?php
                        // delete
                        if (isset($_GET["delete"])) {
                            deleteCategory($_GET["delete"]);
                            header("Location: categories.php");
                        }
?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category title</th>
                                    <th scope="col">Remove</th>
                                    <th scope="col">Update</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                if ($result = getAllCategories()) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
?>
                                        <tr>
                                            <!-- <th scope="row"><?php echo $row["cat_id"]; ?></th> -->
                                            <th scope="row"><?php echo ++$i; ?></th>
                                            <td><?php echo $row["cat_title"]; ?></td>
                                            <td><a href="?delete=<?php echo $row["cat_id"]; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
                                            <td><a href="?edit=<?php echo $row["cat_id"]; ?>&title=<?php echo $row["cat_title"]; ?>">Edit</a></td>
                                        </tr>
<?php
                                    }
                                    mysqli_free_result($result);
                                }
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


<?php include "includes/footer.php" ?>
