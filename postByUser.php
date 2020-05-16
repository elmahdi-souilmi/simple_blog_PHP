<?php  
session_start();
if (isset($_SESSION['id'])) {   
    //  echo 'welcome id :' . $_SESSION['id'];
     include 'config/db_connect.php';
      $id = $_SESSION['id'];
    // wirte query 
    $sql = " SELECT title, text, create_at FROM post WHERE belong_to = $id";
    // get result
    $result = mysqli_query($connect, $sql);
    // fetch the resulting rows as an array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free result from memory
    mysqli_free_result($result);
    // select the name
    $sql1 = " select last_name from user where id = $id";
    $result1 = mysqli_query($connect, $sql1);
    $name = mysqli_fetch_assoc($result1);
    // add post
    if (isset($_POST['add'])) {
      include_once('class.post.php');
      $text = mysqli_real_escape_string($connect, $_POST['text']);
      $title = mysqli_real_escape_string($connect, $_POST['title']);
      $belong_to = $_SESSION['id'];
      $post1 = new post( $title, $text, $belong_to);
      $post1 -> add();
      header('location: postByUser.php');
    }
    // close connection
    mysqli_close($connect);
    ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php';?>
<!-- index body -->
<!-- Section: Blog v.1 -->
<div class="container">
    <section class="my-5">
     <h2 class="h1-responsive font-weight-bold text-center my-5"> Add new post  </h2>
    <!-- add form -->
    <center>
    <form action="postByUser.php" method="post">
    <!-- Default input -->
        <label for="form1">Title</label>
        <input type="text" id="form1" name="title" class="form-control" width="200px">
    <div class="form-group">
        <label for="exampleFormControlTextarea2">Post Text</label>
        <textarea class="form-control rounded-0"  name="text" id="exampleFormControlTextarea2" rows="3"></textarea>
    </div>
    <button class="btn btn-info my-4 btn-block" name="add" type="submit">Post</button>
    </center>
         </form>
        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold text-center my-5">Post by <?php echo $name['last_name'] ?> </h2>
        <?php foreach ($posts as $post) {?>        
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-lg-5">
            <!-- Featured image -->
            <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg" alt="Sample image">
                <a>
                <div class="mask rgba-white-slight"></div>
                </a>
            </div>
            </div>
            <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-lg-7">
            <!-- Post title -->
            <h3 class="font-weight-bold mb-3"><strong><?php echo htmlspecialchars($post['title']); ?></strong></h3>
            <!-- Excerpt -->
            <p><?php echo htmlspecialchars($post['text']); ?>.</p>
            <!-- Post data -->
            <p>by <a><strong><?php echo $name['last_name'] ?></strong></a>, <?php $post['create_at'] = new DateTime();  echo $post['create_at']-> format('y-m-d') ; ?></p>
            <!-- Read more button -->
            <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#modalLoginForm">Update</button>
            <button type="button" class="btn btn-outline-danger btn-rounded waves-effect">Delete</button>
            <!-- <a class="btn btn-success btn-md">Read more</a> -->
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
        <hr class="my-5">
<?php } ?>
    </section>
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <textarea class="form-control validate" placeholder="Text" name="" id="defaultForm" cols="20" rows="7"></textarea>
        </div>
        <div class="md-form mb-4">
        <label data-error="wrong" data-success="right" for="defaultForm-pass"></label>
          <input type="text" placeholder="title" id="defaultForm" class="form-control validate">

        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default">Login</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- Section: Blog v.1 -->
<?php include 'templates/footer.php';?>
</html>
<?php } else { ?>
<h1> you are not welcome here </h2>
<?php }?>