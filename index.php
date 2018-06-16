<?php
  include ('assets/header.php');

  require 'assets/connect.php';
  session_start();
 ?>

 <?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
      require 'login.php';
    }
    elseif (isset($_POST['register'])) {
      require 'register.php';
    }
   }
 ?>

<body>

   <div class="form">
     <img src="img/uarkbookstore_White1.png" style="margin: 20px auto; max-width: 500px; width: 100%;">
     <ul class="tab-group">
       <li class="tab"><a href="#signup">Sign Up</a></li>
       <li class="tab active"><a href="#login">Log In</a></li>
     </ul>

     <div class="tab-content">
       <div id="login">
         <h1>Welcome Back!</h1>
         <form action="index.php" method="post" autocomplete="off">
           <div class="field-wrap">
             <label>
               Email Address<span class="req">*</span>
             </label>
             <input type="email" required autocomplete="off" name="user_email"/>
           </div>
           <div class="field-wrap">
             <label>
               Password<span class="req">*</span>
             </label>
             <input type="password" required autocomplete="off" name="user_pw"/>
           </div>
           <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
           <button class="button button-block" name="login" />Log In</button>
         </form>
       </div>
       <div id="signup">
         <h1>Sign Up for Free</h1>
         <form action="index.php" method="post" autocomplete="off">
           <div class="field-wrap">
             <label>
               User Name<span class="req">*</span>
             </label>
             <input type="text" autocomplete="off" name='user_name' required />
           </div>
           <div class="field-wrap">
             <label>
               Email Address<span class="req">*</span>
             </label>
             <input type="email"required autocomplete="off" name='user_email' />
           </div>
           <div class="field-wrap">
             <label>
               Set A Password<span class="req">*</span>
             </label>
             <input type="password"required autocomplete="off" name='user_pw'/>
           </div>
           <button type="submit" class="button button-block" name="register" />Register</button>
         </form>
       </div>
     </div><!-- tab-content -->
   </div> <!-- /form -->


   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   <script src="assets/js/index.js"></script>

<?php
  include ('assets/footer.php');
?>
