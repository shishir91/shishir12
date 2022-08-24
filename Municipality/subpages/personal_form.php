<?php
$hasError = false;
$fnameError =  $lnameError = $emailError = $wardError = $toleError = $genderError = $phoneError = $profError = $dobError = "";
$firstname = $midname = $lastname = $email = $ward = $tole = $gender = $phone = $prof = $dob = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $firstname = trim($_POST['firstname']);
    $midname = trim($_POST['midname']);
    $lastname = trim($_POST['lastname']);
    $email = $_POST['email'];
    $ward = $_POST['ward'];
    $tole = $_POST['tole'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $phone = $_POST['phone'];
    $prof = $_POST['prof'];
    $dob = $_POST['dob'];

    if ($firstname == "") {
        $fnameError = "Firstname is required.";
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $firstname)) {
            $fnameError = "Invalid Name";
            $hasError = true;
        }
    }
    if (empty($lastname)) {
        $lnameError = "Lastname is required.";
        $hasError = true;
    } else {
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern, $lastname)) {
            $lnameError = "Invalid Name";
            $hasError = true;
        }
    }
    if ($email == "") {
        $emailError = "Email is required.";
        $hasError = true;
    } else {
        $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid) {
            $emailError = "Invalid email address.";
            $hasError = true;
        }
    }
    if ($ward == "") {
        $wardError = "Ward No. is required.";
        $hasError = true;
    }
    if ($tole == "") {
        $toleError = "Tole is required.";
        $hasError = true;
    }
    if ($gender == "") {
        $genderError = "Gender is required.";
        $hasError = true;
    }
    if ($phone == "") {
        $phoneError = "Phone Number is required.";
        $hasError = true;
    }
    if ($prof == "") {
        $profError = "Profession is required.";
        $hasError = true;
    }
    if ($dob == "") {
        $dobError = "Date of Birth is required.";
        $hasError = true;
    }

    if (!$hasError) {

        // require "connection.php";

        $sql = "INSERT INTO personal
            (firstname, midname, lastname, gender, dob, ward, tole phone, email, prof)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            //bind variables
            $stmt->bind_param("ssssssssss", $p_fname, $p_mname, $p_lname, $p_gen, $p_dob, $p_ward, $p_tole, $p_phone, $p_email, $p_prof);
            
            //set parameters
            $p_fname = $firstname;
            $p_mname = $midname;
            $p_lname = $lastname;
            $p_gen = $gender;
            $p_dob = $dob;
            $p_ward = $ward;
            $p_tole = $tole;
            $p_phone = $phone;
            $p_email = $email;
            $p_prof = $prof;

            if ($stmt->execute()) {
                ?>
                <script>
                    alert ("Record inserted successfully.");
                </script>
                <?php
                // header("location: user-list.php");
                exit();    
            }

            $stmt->close();
        }
        $conn->close();
    }
}

?>

<div class="container">
    <h3>Personal Registration Form</h3>
    <div class="row">
        <div class="col-lg-6 col-md-9 col-sm-12">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="first_name">First Name*</label>
                    <input type="text" name="firstname" id="fname" class="form-control" value="<?= $firstname ?>">
                    <span class="text-danger"><?php echo $fnameError ?></span>
                </div>
                <div class="form-group">
                    <label for="first_name">Middle Name</label>
                    <input type="text" name="midname" id="mname" class="form-control" value="<?= $midname ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name*</label>
                    <input type="text" name="lastname" class="form-control" id="lname" value="<?= $lastname ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>
                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <br>
                    <label>
                        <input type="radio" name="gender" value="male" <?= $gender == 'male' ? 'checked' : ''; ?>> Male
                    </label>
                    <label>
                        <input type="radio" name="gender" value="female" <?= $gender == 'female' ? 'checked' : ''; ?>> Female
                    </label>
                    <label>
                        <input type="radio" name="gender" value="others" <?= $gender == 'others' ? 'checked' : ''; ?>> Others
                    </label>
                    <br>
                    <span class="text-danger"><?php echo $genderError ?></span>
                </div>
                <div class="form-group col-lg-4">
                    <label for="dob">Date of Birth*</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="<?= $dob ?>">
                    <span class="text-danger"><?php echo $dobError ?></span>
                </div>
                <hr>
                <b><u>Address*</u></b>
                <div class="form-group">
                    <label for="last_name">Ward No.*</label>
                    <input type="number" name="ward" class="form-control" id="ward" value="<?= $ward ?>">
                    <span class="text-danger"><?= $wardError ?></span>
                </div>
                <div class="form-group">
                    <label for="last_name">Tole*</label>
                    <input type="text" name="tole" class="form-control" id="tole" value="<?= $tole ?>">
                    <span class="text-danger"><?= $toleError ?></span>
                </div>
                <hr>
                <div class="form-group">
                    <label for="phone">Phone Number*</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="<?= $phone ?>">
                    <span class="text-danger"><?php echo $phoneError ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $email ?>">
                    <span class="text-danger"><?php echo $emailError ?></span>
                </div>
                <div class="form-group">
                    <label for="prof">Profession*</label>
                    <input type="text" name="prof" class="form-control" id="prof" value="<?= $prof ?>">
                    <span class="text-danger"><?php echo $profError ?></span>
                </div>
                <div class="form-group pt-2">
                    <input type="submit" name="" id="" class="btn btn-primary" value="Register">
                </div>
            </form>
        </div>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$hasError) { ?>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h4>Your Data</h4>
                <hr>
                <?php
                $lb = "<br>";
                echo "Firstname: $firstname $lb";
                echo "Lastname: $lastname $lb";
                echo "Email: $email $lb";
                echo "Gender: $gender $lb";
                echo "Country: $country";
                ?>
            </div>
        <?php } ?>
    </div>
</div>