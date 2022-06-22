<?php include "inc/header.php";
try {
  $sql = "SELECT p.title, p.description, p.created_at, u.name as 'creator'
      FROM post p
      JOIN user u ON p.creator_id = u.id";
  $response = mysqli_query($conn, $sql);
  $posts = mysqli_fetch_all($response, MYSQLI_ASSOC);
} catch (Exception $err) {
  echo "Error : " . $err->getMessage();
}
?>

<section class="home">
  <div class="container">
    <div class="posts">
      <?php if (empty($posts)) : ?>
        <h1 class="empty">No Posts to show</h1>
      <?php endif; ?>
      <?php foreach ($posts as $item) : ?>
        <div class="post">
          <h3 class="post-title"><?php echo $item["title"] ?></h3>
          <p class="post-description"><?php echo $item["description"]; ?></p>
          <div class="post-bottom">
            <p class="post-creator">By : <?php echo $item["creator"] ?></p>
            <p class="post-date">
              ON : <?php echo $item["created_at"]  ?>
            </p>
          </div>
        </div>
      <?php endforeach ?>

    </div>
  </div>
</section>
<?php include "inc/footer.php" ?>