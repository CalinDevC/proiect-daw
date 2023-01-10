<?php
session_start();
// Include functions and connect to the database using PDO MySQL
include 'functions.php';
require_once 'db_connect.php';

// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
// I used a ternary operator to instantiate the logic for this
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

// Include and show the requested page
include $page . '.php';
