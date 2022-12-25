<?php

function createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $data, $show){
	
	$date = $data[0];
	$name = $data[1];
	$address1 = $data[2];	
	$taxID = $data[3];
	$book = $data[4];
	$price = $data[5];
	$reduce = $data[6];
	$shipping = $data[7];
	$quantity = $data[8];	
	$total_net_price = $data[9];
	$order_no = $data[10];		
	
	$total_price =  $price * $quantity;
	
	//https://htmlpdfapi.com/blog/free_html5_invoice_templates
	$html_invoice = '<div class="date1">$date</div>
	<div class="order_no">$order_no</div>
	<div class="name_customer">$name</div>
	<div class="address1">$address1</div>
	<div class="taxID">$taxID</div>
	<div class="book">$book</div>
	<div class="date2">$date</div>	
	<div class="total_price">$total_price</div>
	<div class="reduce">$reduce</div>
	<div class="shipping">$shipping</div>
	<div class="total_net_price">$total_net_price</div>';
	$vars = array(
	    '$date' => $date, 
		'$name' => $name,
		'$address1' => $address1,      
		'$taxID' => $taxID,    
		'$book' => $book, 
		'$total_price' => $total_price,
		'$reduce' => $reduce, 
		'$order_no' => $order_no,
		'$shipping' => $shipping,
		'$total_net_price' => $total_net_price,
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
	$stylesheet = file_get_contents('create_pdf_receipt.css');
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
$ouput_file_dir = $local_dir.'receipt_AI_easy_book_1/';

$template_pdf = 'receipt_template.pdf';

// ตัวอย่าง URL http://localhost/create_pdf_receipt.php?csv=$filename
$csv_file = isset($_GET['csv']) ? $_GET['csv'] : '';
if( !empty($csv_file )){	
	$csv_file = $csv_file;
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
		$row = 1;
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {	
		$is_createfile=FALSE;
		while (($data = fgetcsv($handle)) !== FALSE) {			
			if ($row++ == 1) continue; // skip head row in csv file			
			//$date = explode(' ', $data[0])[0];			
			$dateOrder = $data[0];
			$date = $data[1];			
			$name = $data[2];
			$address1 = $data[3];			
			$taxID = $data[4] != '' ? "<span style='font-weight: bold;'>เลขประจำตัวผู้เสียภาษี</span>&nbsp;&nbsp;$data[4]" : '';			
			$tel = $data[5];			
			$book = $data[6];			
			$price = $data[7];			
			$reduce = $data[8];	
			$shipping = $data[9];
			$quantity = $data[10];	
			$net =$data[11];					
			$order_no = $data[12];
			$status = $data[13];
			$outfile = $ouput_file_dir.$name.'.pdf';

			$allInput = array($date, $name, $address1, $taxID, $book, $price, $reduce, $shipping, $quantity, $net, $order_no);
			if (!file_exists($outfile) && $status==='SENT') {					
				createPDF($template_pdf, $size, $pwd1, $pwd2, $outfile, $allInput , FALSE );				
				echo "<a href = 'show_pdf.php?filename=$outfile' target='_blank'> $name.pdf </a> --> สร้างไฟล์สำเร็จ<br>";									
				$is_createfile=TRUE;
			} 		 
		}		
		fclose($handle);	
		if( $is_createfile == FALSE){
			echo '<hr><br>มีได้สร้างไฟล์ pdf เพราะยังไม่มีรายชื่อลูกค้าใหม่เข้ามาเลย<br>';		
		}		
	} else {
		echo "<hr><br>ไม่มีไฟล์  $csv_file<br>";		
	}		
	exit();
} 

?>

