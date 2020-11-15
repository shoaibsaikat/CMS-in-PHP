<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
<?php
                    $active_class = "active";

                    $query = "SELECT * FROM categories";

                    if ($result = mysqli_query($connection, $query)) {
                        /* fetch associative array */
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li><a href='search.php?id={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                        }
                        /* free result set */
                        mysqli_free_result($result);
                    }
                    echo "<li><a href='registration.php'>Registration</a></li>";
 ?>
                 <li>
                    <a href="admin">Admin</a>
                 </li>
<?php
                if (isset($_SESSION["role"])) {
                    if (isset($_GET["id"])) {
?>
                        <li>
                           <a href="admin/posts.php?source=edit_posts&id=<?php echo $_GET["id"]; ?>">Edit Post</a>
                        </li>
<?php
                    }
                }
?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
