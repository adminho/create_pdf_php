<?php

function createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $data, $show){
	
	$date = $data[0];
	$items = $data[1];
	$name = $data[2];	
	$address = $data[3];
	$taxId = $data[4];
	$amount = $data[5];
	$taxPercent = $data[6];
	$tax = $data[7];	
	$net = $data[8];
	$amount = $data[9];		
	$bahtChar = $data[10];
	$documentNo = $data[11];

	
	//https://htmlpdfapi.com/blog/free_html5_invoice_templates
	$html_invoice = '<div class="date">$date</div>
	<div class="documentNo">$documentNo</div>	
	<div class="items">$items</div>
	<div class="name">ผู้รับเงิน&nbsp;&nbsp;$name</div>
	<div class="address">ที่อยู่&nbsp;&nbsp;$address</div>	
	<div class="taxId">เลขประจำตัวผู้เสียภาษี&nbsp;&nbsp;$taxId</div>	
	<div class="amount">$amount</div>
	<div class="total">$amount</div>	
	<div class="taxPercent">$taxPercent</div>
	<div class="tax">$tax</div>	
	<div class="net">$net</div>
	<div class="bahtChar">$bahtChar</div>	
	';
	
	
	$vars = array(
	    '$date' => $date, 
		'$items' => $items, 
		'$name' => $name,
		'$address' => $address,      		
		'$taxId' => $taxId,
		'$amount' => $amount, 
		'$taxPercent' => $taxPercent,
		'$tax' => $tax,
		'$net' => $net,
		'$amount' => $amount,
		'$bahtChar' => $bahtChar,
		'$documentNo' => $documentNo,
	);

	$html_invoice = strtr($html_invoice, $vars);
	
	// Require composer autoload
	require_once __DIR__ . '/vendor/autoload.php';
	//-- Set Thai Fonts
	$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
	$fontDirs = $defaultConfig['fontDir'];

	$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
	$fontData = $defaultFontConfig['fontdata'];

	// Create an instance of the class:
	$mpdf = new \Mpdf\Mpdf([
		'fontDir' => array_merge($fontDirs, [ __DIR__ . '/fonts',]),
		'fontdata' => $fontData + [	'thsarabun' => ['R' => 'THSarabun.ttf',
													//'I' => 'THSarabunNew Italic.ttf',
													//'B' => 'THSarabunNew Bold.ttf',
													]
								],
		'default_font' => 'thsarabun',
		'format' => $size
		]);
	
	$pagecount = $mpdf->SetSourceFile(__DIR__ . '/ebooks/'.$template_pdf);
	// Import the last page of the source PDF file
	// copy all pages from the old unprotected pdf in the new one
	$stylesheet = file_get_contents('create_pdf_payment_voucher.css');
	$mpdf->WriteHTML($stylesheet,1);	
		
	for ($page = 1; $page <= $pagecount; $page++) {
		$tplidx = $mpdf->importPage($page);
		$mpdf->addPage();
		$mpdf->useTemplate($tplidx);
		if($page == 1){
		$mpdf->WriteHTML($html_invoice);	
		}
	}

	//--- Output file pdf ---//	
	if ($show){
		$mpdf->Output($outfile, \Mpdf\Output\Destination::INLINE);
	}else{
		$mpdf->Output($outfile);
	}
} // end function

//$size = 'B5';
$size = 'A4';
$pwd1 = '';
$pwd2 = '';
$local_dir = 'F:/Dropbox/sales/';
$ouput_file_dir = '';
$template_pdf = '';

$date  = isset($_GET['date']) ? $_GET['date'] : '';
$items  = isset($_GET['items']) ? $_GET['items'] : '';


$name = isset($_GET['name']) ? $_GET['name'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';
$taxId = isset($_GET['taxId']) ? $_GET['taxId'] : '';

$amount = isset($_GET['amount']) ? $_GET['amount'] : '';

$taxPercent  = isset($_GET['taxPercent']) ? $_GET['taxPercent'] : '';
$tax = isset($_GET['tax']) ? $_GET['tax'] : '';
$net = isset($_GET['net']) ? $_GET['net'] : '';

$bahtChar = isset($_GET['bahtChar']) ? $_GET['bahtChar'] : '';
$documentNo = isset($_GET['documentNo']) ? $_GET['documentNo'] : '';

$template_pdf = 'payment_voucher_template.pdf';
if(str_starts_with($items, 'ค่าเช่าสถานประกอบการ')) {
	$ouput_file_dir = $local_dir.'payment_voucher_office_rent/';	
} 
else if (str_starts_with($items, 'ค่าบริการทำบัญชี')){		
	$ouput_file_dir = $local_dir.'payment_voucher_accounting_fee/';	
}



$data = array($date, $items, $name, $address, $taxId, $amount,
	$taxPercent, $tax, $net, $amount, $bahtChar, $documentNo  );
	
if( $ouput_file_dir != '') {
	$date = new DateTime();
    $date_str = $date->format('Ymd');
	$outfile = $ouput_file_dir.'payment_voucher_'.$date_str.'.pdf';
	if (file_exists($outfile)) {	
		echo '<hr><br>ไฟล์ '. $outfile.'  มีอยู่แล้ว จึงต้องลบไฟล์เก่า <br><br>';			
		unlink($outfile);				
	} 	
	createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $data, FALSE );				
	echo "<a href = 'show_pdf.php?filename=$outfile' target='_blank'> $outfile </a> --> สร้างไฟล์สำเร็จ<br>";									
			
} else {
	echo '<hr><br>$ouput_file_dir เป็นค่าว่าง<br>';	
}
			
exit();

?>

