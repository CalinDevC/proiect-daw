<?php
include 'db_connect.php';



    if (!empty($_POST)) {
        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO contact (first_name, last_name, email, subject) VALUES (:first_name, :last_name, :email, :subject)");

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
?>
<link href="css/forms.css" rel="stylesheet" type="text/css">

<div class="container">
    <h1>Contact Form</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" class="form-control" placeholder="Write something..." style="height:200px"></textarea>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
</div>

<div class="map-container">
    <style>
        h1 {text-align: center;}
        p {text-align: center;}
        div {text-align: center;}
    </style>
    <h1>Location - You can meet our sales team here:</h1>
    <div class="map-inner">
        <iframe width="70%" height="500" src="https://maps.google.com/maps?q=fmi%20bucuresti&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="5" scrolling="no" marginheight="5" marginwidth="5"></iframe>
    </div>
</div>
