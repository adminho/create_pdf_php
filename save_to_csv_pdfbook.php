<?php

$date = isset($_GET['date']) ? $_GET['date'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$book = isset($_GET['book']) ? $_GET['book'] : '';
$order_no = isset($_GET['book']) ? $_GET['orderNo'] : '';

$csv = '';	
$path = '';
$filename = '';

if($book === 'python beginner book'){
	$csv = 'python_customer.csv';	
	$path = 'create_pdf_python.php';
	
} else if($book === 'AI book'){
	$csv = 'AI_customer.csv';	
	$path = 'nofile.php';
}

$ouput_file_dir = 'F:/Dropbox/sales/';
$filename = $ouput_file_dir.$csv;
$url = $path.'?csv='.$filename;

$data = [
	[$date, $email, $name, $order_no, $status],
];

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

// ตัวออย่าง URL http://localhost/save_to_csv.php?date=1/02/2564 11.12&email=test@gamil.com&name=ทดสอบ ชอบทดลอง&status=SENT
echo '<div style="justify-content: center; margin-top:3%; margin-left:10%; margin-right:10%; padding-top:10px; padding-left:10px; padding-right:10px; padding-bottom:10px; border-style:double; border-color:green;">';
echo "<strong>บันทึกข้อมุลลงไฟล์  $ouput_file_dir.$csv เรียบร้อยแล้วจ้า!</strong><br>";
echo "<br><a href = $url  target='_blank'><button>สร้างไฟล์ pdf</button></a>";
echo "&nbsp;&nbsp;<a href='http://localhost/order_ebook_python.php'><button>Back</button></a>";
echo '</div>';	
?> 