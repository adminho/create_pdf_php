<?php

$dateOrder = isset($_GET['dateOrder']) ? $_GET['dateOrder'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$address1 = isset($_GET['address1']) ? $_GET['address1'] : '';
$address2 = isset($_GET['address2']) ? $_GET['address2'] : '';
$tel = isset($_GET['tel']) ? $_GET['tel'] : '';
$book = isset($_GET['book']) ? $_GET['book'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$reduce = isset($_GET['reduce']) ? $_GET['reduce'] : '';
$shipping = isset($_GET['shipping']) ? $_GET['shipping'] : '';
$net = isset($_GET['net']) ? $_GET['net'] : '';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : '';
$order_no = isset($_GET['book']) ? $_GET['orderNo'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$chanel = isset($_GET['chanel']) ? $_GET['chanel'] : '';

$csv = '';	
if($book === 'python beginner book'){
	$csv = 'python_customer.csv';	
} else if($book === 'หนังสือ AI ไม่ยาก ปี 1'){
	$csv = 'AI_easy_book_1_customer.csv';	
}

$data = [
	[$dateOrder, $date, $name, $address1, $address2, $tel, $book, $price, $reduce, $shipping, $quantity, $net,  $order_no, $status, $chanel],
];


$ouput_file_dir = 'F:/Dropbox/sales/';
$filename = $ouput_file_dir.$csv;

// open csv file for writing
$f = fopen($filename, 'a');

if ($f === false) {
	die('Error opening the file ' . $filename);
}

// write each row at a time to a file
foreach ($data as $row) {
	fputcsv($f, $row);
}

// close the file
fclose($f);

// ตัวออย่าง URL http://localhost/save_to_csv_receipt.php?date=1/02/2564 11.12&email=test@gamil.com&name=ทดสอบ ชอบทดลอง&status=SENT
echo '<div style="display:flex; justify-content: left; margin-top:5%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px;">';
echo '<p>';
echo 'Date: '.$date.'<br>';
echo 'Name: '.$name.'<br>';
echo 'adress1: '.$address1.'<br>';
echo 'adress2: '.$address2.'<br>';
echo 'Tel: '.$tel.'<br>';
echo 'Book: '.$book.'<br>';
echo 'Price: '.$price.'<br>';
echo 'Reduce: '.$reduce.'<br>';
echo 'Shipping: '.$shipping.'<br>';
echo 'Total net price: '.$net.'<br>';
echo 'Quantity: '.$quantity.'<br>';
echo 'Order No: '.$order_no.'<br>';
echo 'Status:' .$status.'<br>';
echo 'Customer csv: '.$ouput_file_dir.$csv.'<br>';
echo '</p>';
echo '</div>';

echo '<div style="display:flex; justify-content: left; margin-top:2%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px;">';
echo "<a href = 'create_pdf_receipt.php?csv=$filename' target='_blank' > กดสร้างไฟล์ pdf </a> <br>";		
echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href = 'http://localhost/form_receipt.php' >back</a>";		
echo '</div>';

?> 