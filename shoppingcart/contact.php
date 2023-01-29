<?php

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=localhost;dbname=magazin_daw", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($_POST)) {
        // Prepare the insert statement
        $stmt = $pdo->prepare("INSERT INTO contact (first_name, last_name, email, subject) VALUES (:first_name, :last_name, :email, :subject)");

        // Bind the form data to the insert statement
        $stmt->bindParam(":first_name", $_POST['first_name']);
        $stmt->bindParam(":last_name", $_POST['last_name']);
        $stmt->bindParam(":email", $_POST['email']);
        $stmt->bindParam(":subject", $_POST['subject']);

        // Execute the insert statement
        $stmt->execute();

        // Redirect to the success page
        header("Location: success.php");
        exit();
    }
} catch (PDOException $e) {
    // Output the error message
    echo $e->getMessage();
}

?>
<link href="css/forms.css" rel="stylesheet" type="text/css">

<div class="container">

<form action="" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" placeholder="Write something..." style="height:200px"></textarea>

    <input type="submit" value="Submit">
</form>
</div>
