<?php

$dateOrder = isset($_GET['dateOrder']) ? $_GET['dateOrder'] : '';
$date = isset($_GET['dateSend']) ? $_GET['dateSend'] : '';
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
echo '<div style="justify-content: center; margin-top:3%; margin-left:10%; margin-right:10%; padding-top:10px; padding-left:10px; padding-right:10px; padding-bottom:10px; border-style:double; border-color:green;">';
echo "<strong>บันทึกข้อมุลลงไฟล์  $ouput_file_dir.$csv เรียบร้อยแล้วจ้า!</strong><br>";
echo "<br><a href= create_pdf_receipt.php?csv=$filename target='_blank'><button>สร้างไฟล์ pdf</button></a>";		
echo "&nbsp;&nbsp;<a href='form_receipt.php'><button>Back</button></a>";
echo '</div>';

?> 