<?php
    if (isset($_POST["submit_user"])) {
        $firstname = mysqli_real_escape_string($connection, $_POST["user_firstname"]);
        $lastname = mysqli_real_escape_string($connection, $_POST["user_lastname"]);
        $username = mysqli_real_escape_string($connection, $_POST["user_username"]);
        $role = mysqli_real_escape_string($connection, $_POST["user_role"]);
        $email = mysqli_real_escape_string($connection, $_POST["user_email"]);
        $password = mysqli_real_escape_string($connection, $_POST["user_password"]);
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        $image = $_FILES["user_image"]["name"];
        $image_tmp = $_FILES["user_image"]["tmp_name"];

        if (!isDuplicateUsername($username)) {
            addUser($firstname, $lastname, $username, $image, $role, $email, $password);
            move_uploaded_file($image_tmp, "../images/$image");
            echo "User created: " . "<a href='users.php'>View Users</a>";
        } else {
            echo "<div class='text-danger'>Duplicate username!</div>";
        }
    }
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" id="user_firstname" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" id="user_lastname" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" id="user_username" name="user_username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" id="user_email" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" id="user_image" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select class="form-control" id="user_role" name="user_role">
            <option value="subscriber">Select a role</option>
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password">
    </div>
    <button type="submit" name="submit_user" class="btn btn-primary">Add user</button>
</form>
