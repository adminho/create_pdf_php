<?php

function createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $data, $show){
	
	$day = $data[0];
	$month = $data[1];
	$year = $data[2];
	
	$bookNo  = $data[3];
	$documentNo = $data[4];
	$description = $data[5];
	
	$name = $data[6];
	$address = $data[7];
	$taxId = $data[8];
	
	$amount = $data[9];
	$stangAmount = $data[10];
	$tax = $data[11];
	$stangTax = $data[12];
	$bahtChar = $data[13];

	$full_date =  $day.'/'.$month.'/'.$year;
	
	//https://htmlpdfapi.com/blog/free_html5_invoice_templates
	$html_invoice = '
	<div class="bookNo">$bookNo</div>
	<div class="documentNo">$documentNo</div>
	<div class="taxNo1">0&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;0&nbsp;&nbsp;3&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;5&nbsp;&nbsp;0&nbsp;&nbsp;0&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;&nbsp;5</div>
	<!--<div class="taxNo2">3&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;0&nbsp;&nbsp;1&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;0&nbsp;&nbsp;0&nbsp;&nbsp;3&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;2</div>-->
	<div class="taxNo2">$taxId</div>
	<div class="name1">ห้างหุ้นส่วนจำกัด หกห้า เอ็ดดูเคชั่น </div>
	<div class="address1">เลขที่ 7 หมู่ที่ 4 ตำบลขามทะเลสอ อำเภอขามทะเลสอ จังหวัดนครราชสีมา 30280</div>
	<div class="name2">$name</div>
	<div class="address2">$address</div>	
	<div class="day">$day</div>
	<div class="month">$month</div>
	<div class="year">$year</div>
	<div class="full_date">$full_date</div>
	<div class="amount1">$amount</div>
	<div class="stang_amount1">.$stangAmount</div>
	<div class="tax1">$tax</div>
	<div class="stang_tax1">.$stangTax</div>
	<div class="amount2">$amount</div>
	<div class="stang_amount2">.$stangAmount</div>
	<div class="tax2">$tax</div>
	<div class="stang_tax2">.$stangTax</div>
	<div class="description">$description</div>
	<div class="total_bath_char">$bahtChar</div>
	';
	
	$vars = array(
	    '$day' => $day, 
		'$month' => $month,
		'$year' => $year,      
		'$full_date' => $full_date, 
		'$bookNo' => $bookNo,
		'$description' => $description,
		'$documentNo' => $documentNo,	
		'$description' => $description,	
		'$name' => $name,
		'$address' => $address,
		'$taxId' => $taxId,
		'$amount' => $amount,
		'$stangAmount' => $stangAmount,
		'$tax' => $tax,
		'$stangTax' => $stangTax,
		'$bahtChar' => $bahtChar,
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
	$stylesheet = file_get_contents('create_pdf_tax50.css');
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

$day = isset($_GET['day']) ? $_GET['day'] : '';
$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

$bookNo  = isset($_GET['bookNo']) ? $_GET['bookNo'] : '';
$document = isset($_GET['document']) ? $_GET['document'] : '';
$documentNo = isset($_GET['documentNo']) ? $_GET['documentNo'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';

$name = isset($_GET['name']) ? $_GET['name'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';
$taxId = '';

$amount = isset($_GET['amount']) ? $_GET['amount'] : '';
$stangAmount = isset($_GET['stangAmount']) ? $_GET['stangAmount'] : '';
$tax = isset($_GET['tax']) ? $_GET['tax'] : '';
$stangTax = isset($_GET['stangTax']) ? $_GET['stangTax'] : '';
$bahtChar = isset($_GET['bahtChar']) ? $_GET['bahtChar'] : '';


if($document == 'ทวิ 50 ค่าเช่าบ้าน' || $document == 'ทวิ 50 ค่าทำบัญชี') {
	$ouput_file_dir = $local_dir.'tax50_office_rent/';
	$template_pdf = 'template_tax50_officerent.pdf';
}

function createStringTaxId(){
	
}


$taxId = $_GET['taxId1'].'&nbsp;&nbsp;&nbsp;'.$_GET['taxId2'].'&nbsp;&nbsp;'.$_GET['taxId3'].'&nbsp;&nbsp;'.$_GET['taxId4'].'&nbsp;&nbsp;'.$_GET['taxId5'].'&nbsp;&nbsp;&nbsp;'.$_GET['taxId6'].'&nbsp;&nbsp;'.$_GET['taxId7'].'&nbsp;&nbsp;'.$_GET['taxId8'].'&nbsp;&nbsp;'.$_GET['taxId9'].'&nbsp;&nbsp;'.$_GET['taxId10'].'&nbsp;&nbsp;&nbsp;'.$_GET['taxId11'].'&nbsp;&nbsp;'.$_GET['taxId12'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$_GET['taxId13'];


$data = array($day, $month, $year, $bookNo, $documentNo, $description,
	$name, $address, $taxId, $amount, $stangAmount, $tax, $stangTax, $bahtChar  );
		
// ตัวอย่าง URL http://localhost/create_pdf_officerent.php?csv=$filename		
if( $ouput_file_dir != '') {
	$outfile = $ouput_file_dir.'tax53_office_rent_'.$day.'_'.$month.'_'.$year.'.pdf';
	if (!file_exists($outfile)) {					
		createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $data, FALSE );				
		echo "<a href = 'show_pdf.php?filename=$outfile' target='_blank'> $outfile </a> --> สร้างไฟล์สำเร็จ<br>";									
				
	} else {
		echo '<hr><br>ไฟล์ '. $outfile.'  มีอยู่แล้ว <br>';		
	}		
} else {
	echo '<hr><br>ระบุเอกสารที่จะสร้างผิด<br>';	
}
			
exit();





?>

