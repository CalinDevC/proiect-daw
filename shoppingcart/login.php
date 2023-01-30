<?php

include 'db_connect.php';

if(isset($_SESSION['user_id'])){
    // Check the user's role
    if ($_SESSION['user_role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
}

if(isset($_POST['email'], $_POST['password'])){
    //handling login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND active = 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        // Check the user's role
        if ($_SESSION['user_role'] === 'admin') {
            header("Location: index.php?page=admin");
        } else {
            header("Location: index.php");
        }
    } else {
        // Login failed
        echo "Invalid username or password!";
    }
}

?>

<!-- Login Form. as i read on the course material,
 the htmlspecialchars() function converts special characters to HTML entities,
 avoiding JavaScript code exploits-->

<link href="css/forms.css" rel="stylesheet" type="text/css">

<div class="container">

<form method="post" action="index.php?page=login">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Login">
</form>

</div>