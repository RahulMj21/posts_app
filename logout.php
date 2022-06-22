<?php
session_start();
if ($_SESSION["user_id"]) {
  session_destroy();
  header("Location:/posts_app/login.php");
} else {
  $base = basename($_SERVER["HTTP_REFERER"]);
  $prev_url = "/posts_app/" . $base;
  header("Location:" . $prev_url);
}
