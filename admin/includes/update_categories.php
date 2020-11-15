<?php

// update
if (isset($_POST["update_category"]) && isset($_GET["edit"])) {
    $category_id = $_GET["edit"];
    if (!$_POST["category"]) {
        echo "<br><small>" . "Category can't be empty" . "</small><br>";
    } else {
        updateCatatory($category_id, $_POST["category"]);
    }
}
if (isset($_GET["edit"]) && isset($_GET["title"])) {
?>
    <form method="post">
        <div class="form-group">
            <label for="category">Edit Category</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo $_GET["title"]; ?>">
        </div>
        <button type="submit" name="update_category" class="btn btn-primary">Update category</button>
    </form>
<?php
}
?>
