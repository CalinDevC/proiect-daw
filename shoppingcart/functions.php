<?php

// Template header
function template_header($title) {
    // Get the amount of items in the shopping cart
    //so the customer will know how many products they have in their shopping cart at all times
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

    if (!empty($_SESSION['user_id'])) {
        $user_links = "<a href='logout.php'>
        <i class='fas fa-sign-out-alt'></i> Logout
    </a>";
        if ($_SESSION['user_role'] === 'admin') {
            $user_links .= "<a href='index.php?page=admin'>
            <i class='fas fa-user-cog'></i> Admin Panel
        </a>";
        }
    } else {
        $user_links = "<a href='index.php?page=login'>
        <i class='fas fa-sign-in-alt'></i> Login
    </a>
    <a href='index.php?page=register'>
        <i class='fas fa-key'></i> Register
    </a>";
    }



    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
            
           {$user_links}
						<br>
                <h1>Magazin Online - Proiect DAW</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                    <a href="index.php?page=contact">Contact</a>
                   
                   
                </nav>
                
                
                <div class="link-icons">
                
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
						<span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}

// Template footer

function template_footer() {
    $year = date('Y');
    echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Pompini.ro</p>
            </div>
        </footer>
    </body>
</html>
EOT;
}

function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_email($to, $message)
{
    $headers = 'From: noreply@pompini.ro';
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    mail($to, "Activare Cont", $message, $headers);
}