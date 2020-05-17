<?php  
session_start();
if (isset($_SESSION['id'])) {   
  $title = '';
  // errors
  $errors = ['text' => '', 'title' => ''];
    //  echo 'welcome id :' . $_SESSION['id'];
     include 'config/db_connect.php';
      $id = $_SESSION['id'];
    // wirte query 
    $sql = " SELECT id, title, text, create_at FROM post WHERE belong_to = $id ORDER BY `post`.`create_at` DESC";
    // get result
    $result = mysqli_query($connect, $sql);
    // fetch the resulting rows as an array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // free result from memory
    mysqli_free_result($result);
    // select the name
    $sql1 = " select last_name, first_name from user where id = $id";
    $result1 = mysqli_query($connect, $sql1);
    $name = mysqli_fetch_assoc($result1);
    // add post
    if (isset($_POST['add'])) {
              // check titile
              if (empty($_POST['title'])) {
                      $errors['title'] = 'title is required <br/>';
                  } else 
                    {
                      $title = $_POST['title'];
                      if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                          $errors['title'] = 'title must be letters and spaces only';
                      }
                    }
              // check text
                if (empty($_POST['text'])) {
                        $errors['text'] = 'text is required <br/>';
                    } 
          
                if (array_filter($errors)) {

                    } else {
                        include_once('class.post.php');
                        $text = mysqli_real_escape_string($connect, $_POST['text']);
                        $title = mysqli_real_escape_string($connect, $_POST['title']);
                        $belong_to = $_SESSION['id'];
                        $post1 = new post( $title, $text, $belong_to);
                        $post1 -> add();
                        header('location: postByUser.php');
                    }
             }
    // update post
    if (isset($_POST['update'])) {
      $title =$_POST['title'] ;
      $text = $_POST['text'];
      $id = $_POST['id'];
      $sql = "UPDATE post SET title= '$title', text='$text' WHERE id= '$id' ";
      $result = mysqli_query($connect, $sql);
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
        <h4><?php echo $errors['title']; ?> </h4>
        <input type="text" id="form1" name="title" class="form-control" width="200px">
    <div class="form-group">
        <label for="exampleFormControlTextarea2">Post Text</label>
        <h4><?php echo $errors['text']; ?> </h4>
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
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(<?php  echo rand (1,40) ?>).jpg" alt="Sample image">
                <a>
                <div class="mask rgba-white-slight"></div>
                </a>
            </div>
            </div>
            <!-- Grid column -->
            <!-- Grid column -->
            <div class="col-lg-7">
            <!-- Post title -->
            <h3 class="font-weight-bold mb-3"><strong><?php echo htmlspecialchars($title = $post['title']); ?></strong></h3>
            <!-- Excerpt -->
            <p><?php echo htmlspecialchars($text = $post['text']); ?>.</p>
            <!-- Post data -->
            <p>by <a><strong><?php echo $name['last_name'] . ' ' . $name['first_name'] ?></strong></a>, <?php $post['create_at'] = new DateTime();  echo $post['create_at']-> format('y-m-d') ; ?></p>
            <!-- get the id  -->
             <?php  $id = $post['id']; ?>
            <button type="button" onClick="test('<?php echo $text ?>','<?php echo $title ?>', '<?php echo $id ?>' )"  class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#modalLoginForm">Update</button>
            <a href="../delete.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-danger btn-rounded waves-effect">Deete</a>
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
        <form action="postByUser.php" method="post">
          <textarea class="form-control validate" placeholder="Text" id="text" name="text"  cols="20" rows="7"></textarea>
        </div>
        <div class="md-form mb-4">
        <label data-error="wrong" data-success="right" for="defaultForm-pass"></label>
          <input type="text" placeholder="title" id="title" name='title'  class="form-control validate">
          <input type="hidden" name="id" id="id">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="update" class="btn btn-default">Update</button>
        </form>
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