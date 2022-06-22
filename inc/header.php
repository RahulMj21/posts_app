<?php include "config/connect_db.php";
session_start();
if ($_SESSION["user_id"]) {
  $id = $_SESSION["user_id"];
  $sql = "SELECT name,email,created_at FROM user WHERE id LIKE '$id'";
  $response = mysqli_query($conn, $sql);
  $result = mysqli_fetch_row($response);
  print_r(mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Posts</title>
</head>

<body>
  <header class="header">
    <div class="container">
      <h3 class="logo">
        <a href="/posts_app/">Posts</a>
      </h3>
      <nav class="nav">
        <?php if ($result[0]) : ?>
          <p class="nav-link"><?php echo $result[0]; ?></p>
          <a class="nav-link auth" href="/posts_app/createpost.php">Create</a>
          <a class="nav-link auth" href="/posts_app/logout.php">Logout</a>
        <?php else : ?>
          <a class="nav-link auth" href="/posts_app/login.php">Login</a>
          <a class="nav-link auth" href="/posts_app/register.php">Register</a>
        <?php endif ?>
      </nav>
    </div>
  </header>