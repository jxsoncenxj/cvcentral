<?php
$server = "localhost";
$username = "jasoncenaj";
$password = "CdDdxNsYpvNpHn3";
$database = "u_210154456_db";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
