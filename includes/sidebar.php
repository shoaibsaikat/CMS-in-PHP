<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form class="" action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login Well -->
<?php
    if (!isset($_SESSION["role"])) {
?>
        <div class="well">
            <h4>Login</h4>
            <form class="" action="includes/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="login">Login</button>
                    </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>

<?php }  ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
<?php
                    $query = "SELECT * FROM categories";

                    if ($result = mysqli_query($connection, $query)) {
                        while ($row = mysqli_fetch_assoc($result)) {
?>
                            <li>
                                <a href="search.php?id=<?php echo $row["cat_id"]; ?>"><?php echo $row["cat_title"]; ?></a>
                            </li>
<?php
                        }
                        mysqli_free_result($result);
                    }
?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <!-- <?php include "widget.php"; ?> -->

</div>
