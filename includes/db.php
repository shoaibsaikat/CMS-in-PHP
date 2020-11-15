<?php
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "cms");

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$connection) {
        echo "Error: Unable to connect to MySQL." . "<br>";
        echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
        echo "Debugging error: " . mysqli_connect_error() . "<br>";
        exit;
    }
    // echo "Success: A proper connection to MySQL was made! The cms database is great." . "<br>";
    // echo "Host information: " . mysqli_get_host_info($connection) . "<br>";
 ?>
