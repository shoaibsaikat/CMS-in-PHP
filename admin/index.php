<?php include "includes/header.php" ?>

<?php
    $rows = getAllPosts();
    $posts_count = mysqli_num_rows($rows);

    $rows = getAllComments();
    $comments_count = mysqli_num_rows($rows);

    $rows = getAllUsers();
    $users_count = mysqli_num_rows($rows);

    $rows = getAllCategories();
    $categories_count = mysqli_num_rows($rows);

    $data_title = [
        "Published Posts",
        "Draft Posts",
        "Active Comments",
        "Inactive Comments",
        "Users",
        "Subscribers",
        "Caragories"
    ];

    $data_value = [
        mysqli_num_rows(getPublishedPosts()),
        mysqli_num_rows(getDraftPosts()),
        mysqli_num_rows(getApprovedComments()),
        mysqli_num_rows(getUnpprovedComments()),
        $users_count,
        mysqli_num_rows(getAllSubscribers()),
        $categories_count
    ];
?>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
<?php
                for ($i = 0; $i < count($data_title); $i++) {
                    echo "['{$data_title[$i]}', {$data_value[$i]}], ";
                }
?>
            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: '',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/greetings.php"; ?>
                </div>
            </div>
            <!-- /.row -->

            <!-- Dashboard -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $posts_count; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $comments_count; ?></div>
                                  <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $users_count; ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $categories_count; ?></div>
                                     <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Chart -->
            <div class="row">
                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
