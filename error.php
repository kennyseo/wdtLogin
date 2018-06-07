<?php
  session_start();
  include('assets/header.php');
?>

<div class="form">
  <h1>Error</h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="button button-block"/>Home</button></a>
</div>

<?php
  include('assets/footer.php');
 ?>
