<?php 
       include 'config/db_connect.php';
      // wirte query 
      $sql = "SELECT title, text, create_at, user.last_name, user.first_name FROM post JOIN user where post.belong_to = user.id ORDER BY `post`.`create_at` DESC";
      // get result
      $result = mysqli_query($connect, $sql);
      // fetch the resulting rows as an array
      $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // select the name
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php';?>
<!-- index body -->
<!-- Section: Blog v.1 -->
<div class="container">
    <section class="my-5">
        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold text-center my-5">Recent posts</h2>
        <?php foreach ($posts as $post) {?>        
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-lg-5">
            <!-- Featured image -->
            <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                <img class="img-fluid" src="https://www.latasca.com/wp-content/uploads/2017/02/header-blog.png" alt="Sample image">
                <div class="mask rgba-white-slight"></div>
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
            <p>by <strong><?php echo htmlspecialchars($post['last_name']) . ' ' . htmlspecialchars($post['first_name']) ; ?></strong>, <?php $post['create_at'] = new DateTime();  echo $post['create_at']-> format('d-m-y') ; ?></p>
            <!-- Read more button -->
            <!-- <a class="btn btn-success btn-md">Read more</a> -->
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
        <hr class="my-5">
<?php } ?>

    </section>
</div>
<!-- Section: Blog v.1 -->
<?php include 'templates/footer.php';?>
</html>