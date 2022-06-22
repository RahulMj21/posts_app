<?php
if ($_SESSION["user_id"]) {
  header("Location:/posts_app/index.php");
}
