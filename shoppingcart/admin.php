<?php


// Include the database connection file
try {
    // Connect to the database
    $pdo = new PDO("mysql:host=localhost;dbname=magazin_daw", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



// Code to add a new product to the database
if (!empty($_POST)) {
    // Prepare the insert statement
    $stmt = $pdo->prepare("INSERT INTO products (name, product_description, price, img) VALUES (:name, :product_description, :price, :img)");

// Bind the form data to the insert statement
    $stmt->bindParam(":name", $_POST['name']);
    $stmt->bindParam(":product_description", $_POST['product_description']);
    $stmt->bindParam(":price", $_POST['price']);
    $stmt->bindParam(":img", $_POST['img']);

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



<form action="admin.php" method="post">
    <div class="container">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" class="form-control">
        <label for="product_description">Product Description</label>
        <textarea name="product_description" id="product_description" class="form-control" style="height:200px"></textarea>
        <label for="price">Product Price</label>
        <input type="number" name="price" id="price" class="form-control">
        <label for="img">Product Image</label>
        <input type="file" name="img" id="img">
    </div>
    <input type="submit" name="add_product" value="Add Product" class="btn btn-primary">
</form>
