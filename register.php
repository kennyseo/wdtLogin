<?php
$_SESSION['user_email'] = $_POST['user_email'];
$_SESSION['user_name'] = $_POST['user_name'];

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_pw = (password_hash($_POST['user_pw'], PASSWORD_BCRYPT));
$hash = md5( rand(0,1000) ) ;

$result = "SELECT * FROM user WHERE user_email='$user_email'" or die($mysqli->error());

// We know user user_email exists if the rows returned are more than 0
if ( $result > 0 ) {

    $_SESSION['message'] = 'User with this user_email already exists!';
    header("location: error.php");

}
else { // user_email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO user (user_name, user_email, user_pw, hash) "
            . "VALUES ('$user_name','$user_email','$user_pw', '$hash')";

    // Add user to the database
    if ( $sql ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

                 "Confirmation link has been sent to user_email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $user_email;
        $subject = 'Account Verification ( clevertechie.com )';
        $message_body = '
        Hello '.$user_name.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/login-system/verify.php?user_email='.$user_email.'&hash='.$hash;

        mail( $to, $subject, $message_body );

        header("location: profile.php");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
