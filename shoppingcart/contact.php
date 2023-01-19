<?php

if (!empty($_POST)) {
    $first_name = htmlspecialchars(addslashes($_POST['firstname']));
    $last_name = htmlspecialchars(addslashes($_POST['last_name']));
    $email = htmlspecialchars(addslashes($_POST['email']));
    $subject = htmlspecialchars(addslashes($_POST['subject']));

    $htmlMessage = '';
    foreach($_POST as $key => $value) {
        $htmlMessage .= "<p>$key: $value</p>";
    }

    send_email($email, $htmlMessage);
    // salveaza in baza de date!
    /** ai tabelul CONTACT! */

}

?>
<link href="css/contact.css" rel="stylesheet" type="text/css">

<div class="container">

    <form action="index.php?page=contact">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="first_name" placeholder="Your name...">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="last_name" placeholder="Your last name...">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your email...">

        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something..." style="height:200px"></textarea>

        <input type="submit" value="Submit">
    </form>
</div>
