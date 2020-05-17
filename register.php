<?php
 // connect to datebase
include 'config/db_connect.php';
include 'class.user.php';
if (isset($_POST['submit'])) {



    
    $first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password= mysqli_real_escape_string($connect, $_POST['password']);
     $user1 = new user($first_name, $last_name, $email, $password);
     $user1 -> register();
     header('location: postByUser.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php';?>
<!-- Default form login -->
<div class="container">
<form class="text-center border border-light p-5 mx-auto" action="register.php" method="POST">
    <p class="h4 mb-4">Sign up</p>
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" name="first_name" class="form-control" placeholder="First name">
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" name="last_name" class="form-control" placeholder="Last name">
        </div>
    </div>
    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">
    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" name="password" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>
    <!-- Sign up button -->
    <button class="btn btn-info my-4 btn-block" name="submit" type="submit">Sign in</button>
    <hr>
    <!-- Terms of service -->
    <p>By clicking
        <em>Sign up</em> you agree to our terms of service
</form>
<!-- Default form register -->
</div>
<!-- Default form login -->
<?php include 'templates/footer.php';?>