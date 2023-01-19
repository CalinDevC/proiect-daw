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

    $server_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

    $message = <<<EOF
<p>Acceseaza codul de mai jos pentru a activa contul:</p>
<p>
    <a href="{$server_url}/activate.php?code={$code}">{$code}</a>
</p>
EOF;
    send_email($email, $message);

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
