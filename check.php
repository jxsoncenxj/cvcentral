<?php
if (isset($_SESSION['id'])) {
    echo "You are logged in as " . $_SESSION['name'];
    header("Location: index.php");
} else {
    echo "You are not logged in";
    header("Location: login.php");
}
