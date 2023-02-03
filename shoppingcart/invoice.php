<?php
// Connect to database
//include "db_connect.php";
// Import TCPDF library
require_once 'tcpdf/tcpdf.php';


$order_id = $_GET['order_id'];
// Get cart data from database

$query = 'SELECT * FROM orders 
    JOIN order_items ON order_items.order_id = orders.id
    JOIN products ON products.id = order_items.product_id
        WHERE orders.id = ?';
$statement = $conn->prepare($query);
$statement->execute([$order_id]);
$cart_items = $statement->fetchAll();


// Create PDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set PDF properties
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice, PDF');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Output the cart data in a table
$html = '<table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                
            </tr>';



foreach ($cart_items as $item) {

        $html .= '<tr>
                <td>' . $item['name'] . '</td>
                <td>' . $item['quantity'] . '</td>
                <td>' . $item['price'] . '</td>
                <td>' . ($item['price'] * $item['quantity']). '</td>
            </tr>';



}

$html .= '</table>';
// Clean any content of the output buffer
ob_end_clean();


// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF
$pdf->Output('invoice.pdf', 'I');
