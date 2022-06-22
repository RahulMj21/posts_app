<?php include "inc/header.php";
include "inc/check_guest.php";

$name = $email = $password = "";
$nameErr = $emailErr = $passwordErr = "";

if (isset($_POST["submit"])) {
  // validate fields
  if (empty($_POST["name"])) {
    $nameErr = "please provide name";
  }
  if (empty($_POST["email"])) {
    $emailErr = "please provide an valid email";
  }
  if (empty($_POST["password"])) {
    $passwordErr = "please provide password";
  }
  // sanitize inputs
  $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  // save in db
  if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
    $hashed_password = password_hash($password, PASSWORD_ARGON2I);

    $sql = "INSERT INTO user(name,email,password) 
    VALUES('$name','$email','$hashed_password')";

    try {
      if (mysqli_query($conn, $sql)) {
        $user_id = mysqli_insert_id($conn);
        $_SESSION["user_id"] = mysqli_insert_id($conn);
        echo ($user_id);
        header("Location:/posts_app/index.php");
      }
    } catch (Exception  $err) {
      echo "<p style='color:red'>Register Error : " . $err->getMessage() . "</p>";
    }
  }
}

?>


<section class="auth">
  <div class="container">
    <h2 class="auth-heading">Register</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="auth-form">
      <div class="input-group">
        <label for="name">Name</label>
        <input required type="text" placeholder="Enter your name" id="name" name="name">
        <p class="input-error"><?php echo $nameErr; ?></p>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input required type="email" placeholder="Enter your email" id="email" name="email">
        <p class="input-error"><?php echo $emailErr; ?></p>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input required type="password" placeholder="Enter Password" id="password" name="password">
        <p class="input-error"><?php echo $passwordErr; ?></p>
      </div>
      <input class="btn-primary" name="submit" type="submit" value="Register">
    </form>
  </div>

</section>
<?php include "inc/footer.php" ?>