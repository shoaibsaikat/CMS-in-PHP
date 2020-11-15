<!-- Blog Post -->
<?php $post_link = "post.php?id={$row["post_id"]}"; ?>
<h2>
    <a href="<?php echo $post_link; ?>"><?php echo $row["post_title"]; ?></a>
</h2>
<p class="lead">
    by <a href="user_post.php?user=<?php echo $row["post_author"]; ?>"><?php echo $row["post_author"]; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row["post_date"]; ?></p>
<hr>
<a href="<?php echo $post_link; ?>">
    <img class="img-responsive" src="<?php echo "images/" . $row["post_image"]; ?>" alt="">
</a>
<hr>
<p><?php echo substr($row["post_content"], 0, 200); ?></p>
<a class="btn btn-primary" href="<?php echo $post_link; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
<hr>
