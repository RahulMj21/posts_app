<?php
const DB_HOST = "localhost";
const DB_USER = "rahul";
const DB_PASS = "rahul";
const DB_NAME = "posts_app";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die("connection failed" . $conn->connect_error);
}
