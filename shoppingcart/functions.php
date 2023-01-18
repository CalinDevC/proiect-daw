<?php
/*function pdo_connect_mysql() {
    //  MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'magazin_daw';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit($exception->getMessage());
    }
}*/

// Template header
function template_header($title) {
    // Get the amount of items in the shopping cart
    //so the customer will know how many products they have in their shopping cart at all times
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
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
            <a href="index.php?page=login">
						<i class="fas fa-sign-in-alt"> Login</i>
				<a href="index.php?page=register">
						<i class="fas fa-key"> Register</i> 
						<br>
                <h1>Magazin Online - Proiect DAW</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
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

function send_email($to, $activation_code)
{
    $message = <<<EOF
<p>Acceseaza codul de mai jos pentru a activa contul:</p>
<p>
    <a href="{$_SERVER['self']}/index.php?page=activate&activation_code={$activation_code}">{$activation_code}</a>
</p>
EOF;
    $headers = 'From: noreply@company.com';

    mail($to, "Activare Cont", $message, $headers);

}