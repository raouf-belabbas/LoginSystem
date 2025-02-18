<?php require './partials/header.php';?>
<?php
require 'config.php'; 
session_start();

if(isset($_SESSION['user'])){
    header('location:profile.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = trim($_POST['email']);
        $password=$_POST['password'];
        $SelectionData = $bdd->prepare("SELECT * FROM users WHERE email=? AND password =?");
        

        $SelectionData->execute([$email,$password]);
        $UserRow = $SelectionData->fetch(PDO::FETCH_ASSOC);
        
        if ($UserRow) {
            
            $_SESSION['user']['id']=$UserRow['id_user'];
            $_SESSION['user']['fullname']=$UserRow['fullname'];
            $_SESSION['user']['username']=$UserRow['username'];
            header('location:profile.php');
            exit();
        } else {
            
            header('location:login.php?msg=danger');
            exit();
        }
    }

}

?>
<!-- login  -->

<div class="container" style="max-width: 600px;">
<?php if(isset($_REQUEST['msg'])): ?>
    <div class="notification is-<?php echo $_REQUEST['msg']?>">
        <button class="delete"></button>
        <?php if($_REQUEST['msg']==="success") : ?>
            <p>Your registered successfully!</p>
        <?php elseif($_REQUEST['msg']==="danger"): ?>
            <p>No user found with this email or password.!</p>
        <?php endif ?>
    </div>
    <?php endif ?>
   <section class="section is-small">
      <h4 class="title">Login</h4>
      <form method="post">
         <div class="field">
            <label class="label">Email</label>
            <div class="control">
               <input class="input" type="email" name="email" placeholder="Your Email">
            </div>
         </div>
         <div class="field">
            <label class="label">Password</label>
            <div class="control">
               <input class="input" type="password" name="password" placeholder="password">
            </div>
         </div>
         <div class="control">
            <button class="button is-link" name="btnLogin">Login</button>
         </div>
      </form>
   </section>


</div>

<!-- login -->
<?php require './partials/footer.php'; ?>



