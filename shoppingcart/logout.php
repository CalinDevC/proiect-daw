<?php

session_start();


unset($_SESSION['user_id']);
unset($_SESSION['user_role']);
unset($_SESSION['username']);
session_unset();

header("Location: index.php");
