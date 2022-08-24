<?php

    $servername = "localhost";
    $username = "root";
    $pwd = "Root@123";
    $dbname = "sunkoshi";

    //create a connection
    $conn = mysqli_connect($servername, $username, $pwd, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>