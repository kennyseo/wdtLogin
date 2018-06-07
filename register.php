<?php
  $_SESSION['user_name']  = $_POST['user_name'];
  $_SESSION['user_email'] = $_POST['user_email'];

  $user_name = $mysqli->escape_string($_POST['$user_name']);
  $user_email = $mysqli->escape_string($_POST['user_email']);
  $user_pw    = $mysqli->escape_string(password_hash($_POST['user_pw'], PASSWORD_BCRYPT));
  $hash       = $mysqli->escape_string(md5(rand(0,1000)));

  $result = $mysqli->query("SELECT * FROM user WHERE user_email='$user_email'") or die ($mysqli->error());

  if ($result->num_rows > 0) {
    $_SESSION['message'] = 'User wiht this user name/email already exists.';
    header("location: error.php");
  } else {
    $sql = "INSERT INTO user (user_name, user_pw, user_email, hash) "
            . "VALUES ('$user_name', '$user_pw', '$user_email', '$hash')";

    if ($mysqli->query($sql)) {
      $_SESSION['active'] = 0;
      $_SESSION['logged_in'] = true;
      $_SESSION['message'] = "Confirmation link has been sent to $user_email, please verify it.";

      $to = $user_email;
      $subject = "WDT Account Registratoin";
      $message = 'Hello ' .$user_name. ',

      Thanks for signing up.

      Please click the link to activate your account:
      http://localhost:8888/wdtLogin/verify.php?email=' .$user_email. '&hash=' .$hash;

      mail($to, $subject, $message);
      header("location: profile.php");
    } else {
      $_SESSION['message'] = 'Registration failed.';
      header("location: error.php");
    }
  }
 ?>
