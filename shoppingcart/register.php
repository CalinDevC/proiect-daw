<?php

require_once 'db_connect.php';




if(isset($_SESSION['user_id'])){
    //user already logged in
    header("Location: index.php");
}

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    //handling registration form
    $username = htmlspecialchars(addslashes($_POST['username']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $password = password_hash(htmlspecialchars(addslashes($_POST['password'])), PASSWORD_DEFAULT);
    $role = 'user';
    $activation_code = generate_random_string();

    send_email($email, $activation_code);

    $sql = "INSERT INTO users (username, email, password, role, activation_code) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $password, $role, $activation_code]);
    header("Location: index.php");
}
?>


<!-- Registration Form. as i read on the course material,
 the htmlspecialchars() function converts special characters to HTML entities,
 avoiding JavaScript code exploits
 <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>

 -->

<form method="post" action="index.php?page=register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

<!--    <label for="role">Role:</label>-->
<!---->
<!--        <input type="radio" name="role" value="admin">Admin-->
<!--        <input type="radio" name="role" value="user">User-->
<!---->
<!--    </select>-->

    <input type="submit" value="Register">
</form>
