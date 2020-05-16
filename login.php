<?php 
 // connect to datebase
 session_start(); 
 $error = '';
 include 'config/db_connect.php';
 if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    //make sql
    $sql = "SELECT * FROM user WHERE login = '$email' AND password = '$password' ";
    //get result
    $result = mysqli_query($connect, $sql);
    //fetch result in array format
    $user = mysqli_fetch_assoc($result);
    //echo print_r($result) ;
    //echo print_r($user) ;
    if (mysqli_num_rows($result)==1){
          $_SESSION['id']=$user['id'];
          header('location: postByUser.php');
    } else {
       $error = 'verefie l3ibaat ';
    }
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php';?>
<!-- Default form login -->
<div class="container">
<form class="text-center border border-light p-5 mx-auto"  action="login.php" method="POST">
    <p class="h4 mb-4">Sign in  <?php  ?></p>
    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">
    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" name="password" class="form-control mb-4" placeholder="Password">
    <div class="d-flex justify-content-around">
        <div>
           <h3> <?php  echo $error ?>  </h3>
        </div>
        
    </div>
    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" name="submit" type="submit">Sign in</button>
    <!-- Register -->
    <p>Not a member?
        <a href="">Register</a>
    </p>
</form>
</div>
<!-- Default form login -->
<?php include 'templates/footer.php';?>