<?php include "db.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
<?php session_start(); ?>

<?php
    if (isset($_POST["login"])) {
        $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
        $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);

        if ($result = getUserByUsername($u_name)) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION["id"] = $row["user_id"];
                $_SESSION["username"] = $row["user_username"];
                $_SESSION["firstname"] = $row["user_firstname"];
                $_SESSION["lastname"] = $row["user_lastname"];
                $_SESSION["role"] = $row["user_role"];

                if (password_verify($u_pass, $row["user_password"])) {
                    header("Location: ../admin/index.php");
                    die();
                }
            }
        }
        header("Location: ../index.php");
    }
?>
