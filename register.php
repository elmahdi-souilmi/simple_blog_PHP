<?php
 // connect to datebase
include 'config/db_connect.php';
include 'class.user.php';
// array to stock the exepting error
$errors = ['email' => '', 'first_name' => '', 'last_name' => '', 'password' => ''];
// varaibles
$email = "";
$last_name = "";
$first_name = "";

if (isset($_POST['submit'])) {
    // validation form
    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email not VALID';
        }
    }
    // check first_name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'title is required <br/>';
    } else {
        $first_name = $_POST['first_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $errors['first_name'] = 'first name must be letters and spaces only';
        }
    }
     // check last_name
     if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'last name is required <br/>';
    } else {
        $last_name = $_POST['last_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            $errors['last_name'] = 'last name must be letters and spaces only';
        }
    }
    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'password is required <br/>';
    } else {
        $title = $_POST['password'];
        if (!preg_match('/^(?=.*\d).{8,20}$/', $title)) {
            $errors['password'] = 'Password must be between 8 and 20 digits long and include at least one numeric digi';
        }
    }
    // check if the email is already used
    $email = $_POST['email'];
     $sql = " SELECT * FROM user WHERE login = '$email' ";
     $result = mysqli_query($connect, $sql);
    //  echo mysqli_num_rows($result);
     if (mysqli_num_rows($result)==1){
        $errors['email'] = 'email is already used <br/>';
     }
    if (array_filter($errors)) {

    } else { 
        $first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password= mysqli_real_escape_string($connect, $_POST['password']);
        $user1 = new user($first_name, $last_name, $email, $password);
        $user1 -> register();
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php';?>
<!-- Default form login -->
<div class="container">
<form class="text-center border border-light p-5 z-depth-2 mx-auto formsm" action="register.php" method="POST">
    <h2 class="h1 mb-4">Sign up</h2>
    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" id="defaultRegisterFormFirstName" value="<?php echo $first_name ?>" name="first_name" class="form-control" placeholder="First name">
            <p class="error"> <?php echo $errors['first_name'] ?> </p>
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" name="last_name" value="<?php echo $last_name ?>" class="form-control" placeholder="Last name">
            <p class="error"> <?php echo $errors['last_name'] ?> </p>
        </div>
    </div>
    <!-- E-mail -->
    <input type="email" id="defaultRegisterFormEmail" name="email" value="<?php echo $email ?> " class="form-control mb-4" placeholder="E-mail">
    <p class="error"> <?php echo $errors['email'] ?> </p>
    <!-- Password -->
    <input type="password" id="defaultRegisterFormPassword" name="password" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <h5 class="error"> <?php echo $errors['password'] ?> </h5>
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