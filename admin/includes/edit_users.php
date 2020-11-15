<?php

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        if ($result = getUserById($id)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $firstname = $row["user_firstname"];
                $lastname = $row["user_lastname"];
                $username = $row["user_username"];
                $role = $row["user_role"];
                $email = $row["user_email"];
                $image = $row["user_image"];
                $password = $row["user_password"];
            }
        }
    } else {
        header("Location: index.php");
    }

    if (isset($_POST["update_user"])) {
        $firstname = mysqli_real_escape_string($connection, $_POST["user_firstname"]);
        $lastname = mysqli_real_escape_string($connection, $_POST["user_lastname"]);
        $username = mysqli_real_escape_string($connection, $_POST["user_username"]);
        $role = mysqli_real_escape_string($connection, $_POST["user_role"]);
        $email = mysqli_real_escape_string($connection, $_POST["user_email"]);
        $password = mysqli_real_escape_string($connection, $_POST["user_password"]);

        /*
            if image file is empty then keep old value
        */
        if (!empty($_FILES["user_image"]["name"])) {
            echo $_FILES["user_image"]["name"];
            $image = $_FILES["user_image"]["name"];
            $image_tmp = $_FILES["user_image"]["tmp_name"];
        }

        if ($_POST["user_password"] != "") {
            $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
            updateUser($id, $firstname, $lastname, $username, $image, $role, $email, $password);
        } else {
            updateUserWithoutPassword($id, $firstname, $lastname, $username, $image, $role, $email);
        }

        /*
            update file only if valid image is selected
        */
        if (!empty($image_tmp)) {
            move_uploaded_file($image_tmp, "../images/$image");
        }

        echo "User updated: " . "<a href='users.php'>View Users</a>";
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $lastname ?>">
    </div>
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" id="user_username" name="user_username" value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $email ?>">
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <br>
        <img src="../images/<?php echo $image; ?>" alt="">
        <br>
        <br>
        <input type="file" id="user_image" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" id="user_role" name="user_role">
<?php
            echo "<option value='{$role}'>" . ucfirst($role) ."</option>";

            if ($role == "admin") {
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
?>
        </select>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" value="">
    </div>
    <button type="submit" name="update_user" class="btn btn-primary">Update user</button>
</form>
