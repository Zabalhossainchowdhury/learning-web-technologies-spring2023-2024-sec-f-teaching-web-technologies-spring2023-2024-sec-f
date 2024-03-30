<?php
// Define variables and initialize with empty values
$firstName = $lastName = $dob = $gender = $phone = $email = $password = $confirmPassword = "";
$firstNameErr = $lastNameErr = $dobErr = $genderErr = $phoneErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First Name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    // Validate Last Name
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last Name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    // Validate Date of Birth
    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    // Validate Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate Phone
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // Check if phone number is valid
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Invalid phone number";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // Check if password meets criteria
        if (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        }
    }

    // Validate Confirm Password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Please confirm password";
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);
        // Check if passwords match
        if ($password != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If all validations pass, proceed with registration or other actions
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Provider Registration</title>
</head>
<body>

<h2>Email Provider Registration</h2>
<form action="validation.php" method="post">
    <label for="firstName">First Name:</label><br>
    <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>"><br>
    <span class="error"><?php echo $firstNameErr; ?></span><br>

    <label for="lastName">Last Name:</label><br>
    <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>"><br>
    <span class="error"><?php echo $lastNameErr; ?></span><br>

    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>"><br>
    <span class="error"><?php echo $dobErr; ?></span><br>

    <label>Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>>
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>>
    <label for="female">Female</label>
    <input type="radio" id="other" name="gender" value="other" <?php if (isset($gender) && $gender == "other") echo "checked"; ?>>
    <label for="other">Other</label><br>
    <span class="error"><?php echo $genderErr; ?></span><br>

    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"><br>
    <span class="error"><?php echo $phoneErr; ?></span><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
    <span class="error"><?php echo $emailErr; ?></span><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <span class="error"><?php echo $passwordErr; ?></span><br>

    <label for="confirmPassword">Confirm Password:</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword"><br>
    <span class="error"><?php echo $confirmPasswordErr; ?></span><br>

    <input type="submit" value="Register">
</form>

</body>
</html>
