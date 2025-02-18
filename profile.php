<?php require './partials/header.php';?>
<?php
require 'config.php';
session_start();
if(isset($_SESSION['user'])){

?>
<!-- home page -->

<section class="hero">
  <div class="hero-body">
    <p>Welcome <?php echo $_SESSION['user']['username'];?></p>
    <p class="title">
      my profile 
    </p>
    <p class="subtitle">
      Welcome To our Website ...
    </p>
   
    <a href="logout.php" class="button is-primary">Log Out</a>
  </div>
</section>

<!-- home page -->
<?php }else{
    header('location:login.php');
} ?>
<?php require './partials/footer.php';?>