<?php

require_once 'db_connect.php';




if(isset($_SESSION['user_id'])){
    //user already logged in
    header("Location: index.php");
}

if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role'])){
    //handling registration form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $password, $role]);
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

<!-- Registration Form -->

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <label for="role">Role:</label>
    <select id="role" name="role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>

    <input type="submit" value="Register">
</form>
<!-- Login Form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Login">
</form>
