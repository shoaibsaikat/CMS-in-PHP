<form method="post">
    <div class="form-group">
        <label for="category">Add Category</label>
        <input type="text" class="form-control" id="category" name="category">
<?php
        // insert
        if (isset($_POST["submit_category"])) {
            if (!$_POST["category"]) {
                echo "<br><small>" . "Category can't be empty" . "</small><br>";
            } else {
                addCategory(mysqli_real_escape_string($connection, $_POST["category"]));
            }
        }
?>
    </div>
    <button type="submit" name="submit_category" class="btn btn-primary">Add category</button>
</form>
