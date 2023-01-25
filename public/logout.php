<?php
require '../header.php';
session_unset();
echo '<p>Successfully logged out</p>';
echo '<a href="index.php">Go back to the home page</a>';
require '../footer.php';
?>