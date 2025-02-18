<?php require './partials/header.php';?>
<?php
    require 'config.php';

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(!empty($_POST['fullname'])&& !empty($_POST['username'])
        &&!empty($_POST['email']) && !empty($_POST['password'])){

        $fullname= htmlspecialchars( $_POST['fullname']);
        $username=htmlspecialchars($_POST['username']);
        $email=$_POST['email'];
        $password=$_POST['password'];
        $created_at=date('Y.m.d H.i.s');
        // $password=password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Preparing the query
        $query = $bdd->prepare("INSERT INTO users (fullname, username, email, password, created_at) 
                                VALUES (?, ?, ?, ?, ?)");
        $query->execute([$fullname, $username, $email, $password, $created_at]);

        header('location:signup.php?msg=success');
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
    }else{
        
        header('location:signup.php?msg=danger');
        exit();
    }
}
?>

<!-- Sign UP -->

<div class="container" style="max-width: 600px;">
    <?php if(isset($_REQUEST['msg'])): ?>
    <div class="notification is-<?php echo $_REQUEST['msg']?>">
        <button class="delete"></button>
        <?php if($_REQUEST['msg']==="success") : ?>
            <p>Your registered successfully!</p>
        <?php elseif($_REQUEST['msg']==="danger"): ?>
            <p>All fields are required!</p>
        <?php endif ?>
    </div>
    <?php endif ?>
   <section class="section is-small">
      <h4 class="title">Sign Up</h4>
      <form method="POST">
         <div class="field">
            <label class="label">Full Name</label>
            <div class="control">
               <input class="input" type="text" name="fullname" placeholder="Your Full Name" required>
            </div>
         </div>
         <div class="field">
            <label class="label">User Name</label>
            <div class="control">
               <input class="input" type="text"  name="username" placeholder="Your User Name">
            </div>
         </div>
         <div class="field">
            <label class="label">Email</label>
            <div class="control">
               <input class="input" type="email"  name="email" placeholder="Your Email">
            </div>
         </div>
         <div class="field">
            <label class="label">Password</label>
            <div class="control">
               <input class="input" type="password" name="password" placeholder="password">
            </div>
         </div>
         <div class="control">
            <button class="button is-link" name="btnSend" >Sign Up</button>
         </div>
      </form>
   </section>


</div>
<!--  Sign up -->
<?php require './partials/footer.php'; ?>




