<head>
    <link rel="stylesheet" href="./css/login.css">
</head>

<?php

// $username = $password = $error = "";
// $hasError = false;
// $usernameError = $passwordError = "";

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $username = trim($_POST['username']);
//     $password = trim($_POST['password']);

//     if (!$hasError) {

//         $sql = "SELECT * FROM users WHERE username = ? AND PASSWORD = ?";
//         if ($stmt = $conn->prepare($sql)) {
//             $stmt->bind_param("ss", $p_username, $p_pass);

//             $p_username = $username;
//             $p_pass = $password;
//             $stmt->execute();

//             $result = $stmt->get_result();

//             if ($result->num_rows == 1) {
//                 $data = $result->fetch_assoc();
//                 $_SESSION['username'] = $data['username'];
//                 $_SESSION['isLoggedIn'] = true;
//                 header("location: dashindex.php");
//                 exit();
//             } else {
//                 $error = "Invalid email or password.";
//             }
//         }
//     }
// }

if (isset($_POST['login'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = sha1(mysqli_real_escape_string($conn, $_POST['password']));

    $query 		= mysqli_query($conn, "SELECT * FROM users WHERE  password='$pass' and username='$uname'");
    $row		= mysqli_fetch_array($query);
    $num_row 	= mysqli_num_rows($query);

    if ($num_row > 0) {
        $_SESSION['user_id'] = $row['user_id'];
        header('location:dashindex.php');
    } else {
        $error =  'Invalid Username or Password';
    }
}
?>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="#" method="POST">
                        <h3 class="text-center fw-bold">Login</h3>
                        <div class="form-group">
                            <label for="username" class="fw-bold">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group pt-2">
                            <label for="password" class="fw-bold">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="text-danger">
                            <?php if (!empty($error)) {
                                echo $error;
                            } ?>
                        </div>
                        <div class="form-group pt-3">
                            <input type="submit" name="login" class="btn btn-info btn-md" value="Login">
                        </div>
                        <div class="pt-2">
                            <a href="">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>