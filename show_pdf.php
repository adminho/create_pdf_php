<?php
  
// The location of the PDF file
// on the server

// ตัวอย่าง URL http://localhost/show_pdf.php?filename=file:///D:/sales/salebook_python/bitongbakatest@gmail.com.pdf
$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
if( empty($filename )){
	echo 'ไม่มีไฟล์ '.$filename.'<br/>';
}
 
// Header content type
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));

$basefile = basename($filename);
header("Content-disposition: filename=".$basefile);
  
// Send the file to the browser.
readfile($filename);
?> 