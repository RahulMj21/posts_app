<?php include "inc/header.php";
include "inc/check_guest.php";

$email = $password = "";
$emailErr = $passwordErr = "";
if (isset($_POST["submit"])) {
  // validate fields
  if (empty($_POST["email"])) {
    $emailErr = "please provide an valid email";
  }
  if (empty($_POST["password"])) {
    $passwordErr = "please provide password";
  }
  // sanitize inputs
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  // save in db
  if (empty($emailErr) && empty($passwordErr)) {
    $hashed_password = password_hash($password, PASSWORD_ARGON2I);
    try {
      $sql = "SELECT id,email,password FROM user 
    WHERE email LIKE '$email'";
      $response = mysqli_query($conn, $sql);
      $result = mysqli_fetch_row($response);
    } catch (Exception  $err) {
      echo "<p class='toast error'> Error : wrong email or password" . $err->getMessage() . "</p>";
    }
    if (password_verify($password, $result[2])) {
      echo "<p class='toast'> Success : Logged in successfully</p>";
      $_SESSION["user_id"] = $result[0];
      header("Location:/posts_app/index.php");
    } else {
      echo "<p class='toast error'> Error : wrong email or password" . mysqli_error($conn) . "</p>";
    }
  }
}
?>


<section class="auth">
  <div class="container">
    <h2 class="auth-heading">Login</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="auth-form">
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
      <input class="btn-primary" name="submit" type="submit" value="Login">
    </form>
  </div>

</section>
<?php include "inc/footer.php" ?>