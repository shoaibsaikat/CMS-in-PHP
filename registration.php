<?php include "includes/header.php"; ?>

<?php
    $msg = "";
    if (isset($_POST["submit"])) {
        if ($_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"] != "") {
            $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
            $u_email = mysqli_real_escape_string($connection, $_POST["email"]);
            $u_pass = mysqli_real_escape_string($connection, $_POST["password"]);

            $u_pass = password_hash($u_pass, PASSWORD_BCRYPT, ["cost" => 12]);

            registerUser($u_name, $u_email, $u_pass);
            header("Location: index.php");
        } else {
            $msg = "Fields can't be empty!";
        }
    }
?>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <!-- Error message -->
                    <div class="text-danger"><?php echo $msg; ?></div>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>
