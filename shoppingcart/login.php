<?php

require_once 'db_connect.php';

if(isset($_SESSION['user_id'])){
    //user already logged in
    header("Location: index.php");
}

if(isset($_POST['email'], $_POST['password'])){
    //handling login form
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: index.php");
    } else {
        // Login failed
    }
}
?>

<!-- Login Form. as i read on the course material,
 the htmlspecialchars() function converts special characters to HTML entities,
 avoiding JavaScript code exploits-->

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Login">
</form>

