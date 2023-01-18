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
    $code = generate_random_string();

    send_email($email, $code);

    $sql = "INSERT INTO users (username, email, password, role, code) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $password, $role, $code]);
    header("Location: index.php");
}
?>




<form method="post" action="index.php?page=register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">


    <input type="submit" value="Register">
</form>
