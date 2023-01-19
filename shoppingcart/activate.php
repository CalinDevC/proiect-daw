<?php
require_once 'db_connect.php';

$code = $_GET['code'] ?? null;
$code = htmlspecialchars(addslashes($code));

if (!empty($code)) {
    // facem verificarea in baza de date!
    $sql = "SELECT * FROM users WHERE code = :code";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':code' => $code]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $updateSql = "UPDATE users SET active = 1, code = null WHERE id = :id AND code = :code";
        $update = $conn->prepare($updateSql);
        $update->execute([':id' => $user['id'], ':code' => $code]);

        // Login success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}