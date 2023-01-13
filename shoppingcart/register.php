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
?>


<!-- Registration Form. as i read on the course material,
 the htmlspecialchars() function converts special characters to HTML entities,
 avoiding JavaScript code exploits-->

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <label for="role">Role:</label>

        <input type="radio" name="role" value="admin">Admin
        <input type="radio" name="role" value="user">User

    </select>

    <input type="submit" value="Register">
</form>
