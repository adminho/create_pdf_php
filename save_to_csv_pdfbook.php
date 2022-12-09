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
echo '<div style="display:flex; justify-content: left; margin-top:5%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px;">';
echo '<p>';
echo 'Date: '.$date.'<br>';
echo 'Email: '.$email.'<br>';
echo 'Name: '.$name.'<br>';
echo 'Order No: '.$order_no.'<br>';
echo 'Status:' .$status.'<br>';
echo 'Book: '.$book.'<br>';
echo 'Customer data: '.$ouput_file_dir.$csv.'<br>';
echo '</p>';
echo '</div>';

echo '<div style="display:flex; justify-content: left; margin-top:2%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px;">';
echo "<a href = $url target='_blank' > กดสร้างไฟล์ pdf </a> <br>";	
echo "<br>&nbsp;&nbsp;&nbsp;&nbsp<a href = 'http://localhost/order_ebook_python.php' >back</a>";		
echo '</div>';	
?> 