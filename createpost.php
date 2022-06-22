<?php include "inc/header.php";
include "inc/check_auth.php";


$title = $description = "";
$titleErr = $descriptionErr = "";
if (isset($_POST["submit"])) {
  // validate fields
  if (empty($_POST["title"])) {
    $titleErr = "please provide an valid title";
  }
  if (empty($_POST["description"])) {
    $descriptionErr = "please provide description";
  }
  // sanitize inputs
  $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  // save in db
  if (empty($titleErr) && empty($descriptionErr)) {
    $creator_id = $_SESSION["user_id"];
    $sql = "INSERT INTO post(title,description,creator_id) VALUES('$title','$description','$creator_id')";
    try {
      if (mysqli_query($conn, $sql)) {
        header("Location:/posts_app/index.php");
      }
    } catch (Exception  $err) {
      echo "<p style='color:red'> Error : " . $err->getMessage() . "</p>";
    }
  }
}
?>



<section class="auth">
  <div class="container">
    <h2 class="auth-heading">Create Post</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="auth-form">
      <div class="input-group">
        <label for="title">Title</label>
        <input required type="text" placeholder="Enter title" id="title" name="title">
        <p class="input-error"><?php echo $titleErr; ?></p>
      </div>
      <div class="input-group">
        <label for="description">Description</label>
        <textarea cols="25" rows="5" required placeholder="Enter description" id="description" name="description"></textarea>
        <p class="input-error"><?php echo $descriptionErr; ?></p>
      </div>
      <input class="btn-primary" name="submit" type="submit" value="Submit">
    </form>
  </div>

</section>
<?php include "inc/footer.php" ?>