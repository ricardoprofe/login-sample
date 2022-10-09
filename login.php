<?php
session_start();

// define variables and set to empty values
$email = $pass = "";
$emailErr = $passErr = "";
$err = false; //variable to check if there have been errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['email'])) {
        $emailErr = "* Email is required";
        $err = true;
    } else {
        $email = trim(strip_tags($_POST['email']));
        $_SESSION['email'] = $email;
        //Check if the email is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "* Invalid email format";
            $err = true;
        }
    }

    if(empty($_POST['pass'])){
        $passErr = "* Password is required";
        $err = true;
    } else {
        $pass = trim(strip_tags($_POST['pass']));
        $_SESSION['pass'] = $pass;
        //Check if the password has at least 8 chars
        if (strlen($pass) < 8) {
            $passErr = "* The password must have at least 8 characters";
            $err = true;
        }
    }
} else {
    $err = true;
}

if (!$err) {
    header("Location:checkuser.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login sample</title>
    <meta name="author" content="Ricardo Sanchez">
    <meta name="description" content="a sample form to show validation techniques">
    <link rel="stylesheet" type="text/css" href="./main.css">
</head>
<body>
<h1>Login</h1>
<p>Please, enter your email and password</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label> E-mail: <br>
        <input type="text" name="email" value="<?= $email;?>">  <span class="error"> <?= $emailErr; ?> </span>
    </label>
    <label>Password: <br>
        <input type="password" name="pass" value="<?= $pass;?>"> <span class="error"> <?= $passErr; ?> </span>
    </label>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>