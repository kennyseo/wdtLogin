<?php
  require 'connect.php';
  session_start();

  if(isset($_GET['user_email']) && !empty($_GET['user_email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
  {
      $user_email = $mysqli->escape_string($_GET['user_email']);
      $hash = $mysqli->escape_string($_GET['hash']);

      // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
      $result = $mysqli->query("SELECT * FROM user WHERE user_email='$user_email' AND hash='$hash' AND active='0'");

      if ( $result->num_rows == 0 )
      {
          $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

          header("location: error.php");
      }
      else {
          $_SESSION['message'] = "Your account has been activated!";

          // Set the user status to active (active = 1)
          $mysqli->query("UPDATE users SET active='1' WHERE user_email='$user_email'") or die($mysqli->error);
          $_SESSION['active'] = 1;

          header("location: success.php");
      }
  }
  else {
      $_SESSION['message'] = "Invalid parameters provided for account verification!";
      header("location: error.php");
  }
?>
