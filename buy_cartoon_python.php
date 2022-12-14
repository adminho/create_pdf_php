<?php

function createPDF($book, $size, $pwd1, $pwd2, $outfile, $data, $show){
	$name = $data[0];
	$email = $data[1];
	$date = $data[2];
	
	$info_buyer = 'ผู้ซื้อ: '.$name.' เมล: '.$email.' ซื้อเมื่อวันที่: '.$date;

	$html_buyer = '<div class="buyer">$info_buyer</div>';
	$vars = array( '$info_buyer' => $info_buyer );
	$html_buyer = strtr($html_buyer, $vars);
		
	$html_intro = '
	<div class="container">		    
		<p>อีบุ๊กเล่มนี้ปกติวางขายที่  <a href="https://www.mebmarket.com/web/index.php?action=BookDetails&data=YToyOntzOjc6InVzZXJfaWQiO3M6NzoiMTcyNTQ4MyI7czo3OiJib29rX2lkIjtzOjY6IjEzMTQxMiI7fQ">meb</a></p>
		<p>แต่ผมก็เปิดช่องทางขายเป็นเวอร์ชั่น pdf พิเศษ </p>
		<p>เพื่อคุณ&nbsp;<font color="green">$name</font> โดยเฉพาะ</p>
		<p>สามารถ print ออกมาอ่านดูส่วนตัวได้นะครับ</p>
		<p><font color="red">แต่ขอร้อง ไม่นำไปจำหน่ายหรือแจกจ่ายต่อนะครับ</font></p>    
		<p>ถ้าเกิดผมอัปเดตอะไรใหม่ในหนังสือ</p> 
		<p>ก็จะแจ้งผ่านทางเมลคุณ <font color="blue">$email</font></p>    
		<!--<p>ส่วนรหัสผ่านเปิด PDF ใช้เป็น <font color="red">$pwd1</font></p> -->
		<p>มีปัญหาติดต่อได้ที่เมล <font color="blue">patanasongsivilai@gmail.com</font> นะครับ</p>   
	</div>';
	
	$frist_name = explode(' ', $name)[0];
	//$frist_name = $name;
	$vars = array(
		'$name' => $frist_name,
		'$email' => $email,      
		'$pwd1' => $pwd1,  
	);
	$html_intro = strtr($html_intro, $vars);

	$html_end = '<p class="ticken">หวังว่าหนังสือนี้จะเป็นประโยชน์ต่อคุณ<br/> <font color="green"> $name</font></p>';  
	$vars = array( '$name' => $frist_name );
	$html_end = strtr($html_end, $vars);

	//https://htmlpdfapi.com/blog/free_html5_invoice_templates
	$html_invoice = '<html><body>    
	<header class="clearfix">
	  <h1>ใบเสร็จรับเงิน/Receipt</h1>
      <div id="company" class="clearfix">        
      </div>
      <div id="project">        
		<div>ผู้ขาย/Seller:<span> จตุรพัชร์ พัฒนทรงศิวิไล</span></div>
		<div>ที่อยู่/Address:<span> 7 ม.4 ต.ขามทะเลสอ อ.ชามทะเลสอ จ.นครราชสีมา</span></div>		
		<div>อีเมล/Email:<span> patanasongsivilai@gmail.com</span></div>  
		
		<div style="padding: 10px 0;">
		<div>ลูกค้า/Client:<span> $name</span></div>                
		<div>อีเมล/Email:<span> $email</span></div>
		<div>วันที่/Date:<span> $date</span> </div>	
		</div>		
      </div>	  	  
    </header>
    <main>
      <table>
        <thead>
          <tr>
			<th class="service">ลำดับ<br/>No.</th>		  
            <th class="desc">รายการ<br/>Description</th>
            <th>ราคาต่อหน่วย<br/>Unit Price</th>
            <th>จำนวน<br/>Qty</th>
            <th>จำนวนเงิน<br/>Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
			<td class="service">1</td>
            <td class="desc">PDF<br/>โปรแกรมเมอร์ก็รวยได้ ด้วยเส้นทาง<br/>เอาท์ซอร์สสายดำ</td>
            <td class="unit">330 ฿</td>
            <td class="qty">1</td>
            <td class="total">330 ฿</td>
          </tr>                   
          <tr>
            <td colspan="4" class="grand total">รวม&nbsp;&nbsp;&nbsp;<br/>TOTAL</td>
            <td class="grand total"><font style="color:#003300">330 ฿</td>
          </tr>
        </tbody>
      </table>
	  <div id="notices">ลงชื่อ&nbsp;__________________________&nbsp;ผู้รับเงิน
	  </div>
      <div id="notices">        
		<div class="notice">NOTICE: เอกสารฉบับนี้ออกให้กับลูกค้าโดยโปรแกรมอัตโนมัติ </div>		
      </div>      
    </main><footer>ขอบคุณที่อุดหนุน (Thank you)</footer></body></html>';
	$vars = array(
		'$name' => $name,
		'$email' => $email,      
		'$date' => $date, 
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

	//------ Set Meta data -----//
	$mpdf->SetTitle('หนังสือ "โปรแกรมเมอร์ก็รวยได้ ด้วยเส้นทางเอาท์ซอร์สสายดำ"');
	$mpdf->SetAuthor('นายจตุรพัชร์ พัฒนทรงศิวิไล');
	$mpdf->SetCreator('Jaturapat Patanasongsivilai');
	$mpdf->SetSubject($info_buyer);
	$mpdf->SetKeywords('โปรแกรมเมอร์, เอาท์ซอร์ส, Outsource');

	//------Enter password and protect pdf don't print, edit, copy
	//$mpdf->SetProtection(array(), $pwd1, $pwd2);
	$mpdf->SetProtection(array('print'), $pwd1, $pwd2);

	$pagecount = $mpdf->SetSourceFile(__DIR__ . '/ebooks/'.$book);
	// Import the last page of the source PDF file
	// copy all pages from the old unprotected pdf in the new one
	for ($page = 1; $page <= $pagecount; $page++) {
		$tplidx = $mpdf->importPage($page);
		$mpdf->addPage();
		$mpdf->useTemplate($tplidx);
		$stylesheet = file_get_contents('style.css');
		$mpdf->WriteHTML($stylesheet,1);
		if($page == 4){		
			$mpdf->WriteHTML($html_intro);				
		} else if($page == 5){		
			$mpdf->WriteHTML($html_invoice);	
		} else if($page === $pagecount-2)  {
			$mpdf->WriteHTML($html_end);
		} 
		
		if($page % 10 === 0)  {
			$mpdf->WriteHTML($html_buyer);
		}
	}

	// And end page
	/*$mpdf->AddPage();
	$stylesheet = file_get_contents('style_invoice.css');
	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->WriteHTML($data[3]);*/

	//--- Output file pdf ---//	
	if ($show){
		$mpdf->Output($outfile, \Mpdf\Output\Destination::INLINE);
	}else{
		$mpdf->Output($outfile);
	}
} // end function

//$csv_file = 'ลูกค้า หนังสือ _โปรแกรมเมอร์ก็รวยได้ ด้วยเส้นทางเอาท์ซอร์สสายดำ_ (การตอบกลับ) - การตอบแบบฟอร์ม 1';
//$xls_file = 'outsource_1.xlsx';
/*
$book = 'sale_rich_with_outsource.pdf';	
$size = 'A5';
$date = ''; //$date = date("d/m/Y");
$pwd1 = '';
$pwd2 = ')+I[To^a2/1oR#!0z%xP2v&3@5qX-f;=(|\\';
*/
$xls_file = isset($_GET['xls']) ? $_GET['xls'] : '';
$xls_file = 'D:/sales/'.$xls_file;
/*
if( !empty($xls_file )){
	// https://github.com/shuchkin/simplexlsx
	require_once __DIR__.'/SimpleXLSX.php';	
	if ( $xlsx = SimpleXLSX::parse($xls_file) ) {		
		$row = 1;		
		foreach($xlsx->rows() as $data) {
			if ($row++ == 1) continue; // skip head row in csv file			
			//$date = explode(' ', $data[0])[0];			
			$date = $data[0];				
			$email = $data[1];
			$name = $data[2];
			$status = $data[4];
			$outfile = 'D:/sales/salebook_outsource_1/'.$email.'.pdf';
			if (!file_exists($outfile) && $status==='SENT') {
				createPDF($book, $size, $pwd1, $pwd2, $outfile, array($name, $email, $date), false );
			}
		}		
		echo 'สร้างไฟล์ pdf สำเร็จแล้ว <br/>';
		exit();
	} else {
		echo SimpleXLSX::parseError();
	}
}*/
/*
$csv_file = isset($_GET['csv']) ? $_GET['csv'] : '';
if( !empty($csv_file )){
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
		$row = 1;
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		while (($data = fgetcsv($handle)) !== FALSE) {
			if ($row++ == 1) continue; // skip head row in csv file			
			//$date = explode(' ', $data[0])[0];			
			$date = $data[0];			
			$email = $data[1];
			$name = $data[2];			
			$outfile = __DIR__ . '/output/'.$email.'.pdf';
			if (!file_exists($outfile)) {
				createPDF($book, $size, $pwd1, $pwd2, $outfile, array($name, $email, $date), false );
			}
		}		
		fclose($handle);		
	}		
	echo 'สร้างไฟล์ pdf สำเร็จแล้ว <br/>';
	exit();
}
*/
/*
// คลิกลิงก์แล้วสร้างไฟล์ pdf แล้วโชว์หน้า Desktop เลย
$csv_file = 'C:/Users/Administrator/Downloads/รายชื่อลูกค้าที่ส่งหนังสือรวยด้วย outsource สายดำ - Form Responses 1.csv';
session_start();
$users = array();
if (array_key_exists("users", $_SESSION)){
	$users = $_SESSION["users"];		
}

// Check email in SESSION ?
$email = isset($_GET['usr']) ? $_GET['usr'] : '';
if ( (!array_key_exists($email, $users) && !empty($email)) || empty($users) ){
	// If it does not found email key in session, It will get all data from csv file again.
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
		$row = 1;
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		while (($data = fgetcsv($handle)) !== FALSE) {
			if ($row++ == 1) continue; // skip head row in csv file	
			//$date = explode(' ', $data[0])[0];			
			$date = $data[0];						
			$users[$data[1]] = array( 'name'=> $data[2],
									  'id'=> $data[3],
									  'date' => $date);
		}
		fclose($handle);		
	}			
	$_SESSION["users"] = $users;
}


if ( !array_key_exists($email, $users) ){ // check email again
	echo '<h3>ขอโทษทีครับ มีปัญหาบางอย่าง ทำให้ email: <font color="red">'.$email.'</font> เปิดอ่าน pdf ไม่ได้</h3><br/>';
	echo '<h4>มีปัญหาสอบถามได้ที่เมล patanasongsivilai@gmail.com</h4><br/>';
	exit();
}

$detail = $users[$email];
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ( $id !== $detail['id']){
	echo '<h3>ขอโทษทีครับ มีปัญหาบางอย่าง ทำให้ email: <font color="blue">'.$email.'</font> เปิดอ่าน pdf ไม่ได้</h3><br/>';
	echo '<h4>มีปัญหาสอบถามได้ที่เมล patanasongsivilai@gmail.com</h4><br/>';
	exit();
}

$name = $detail['name'];
$date = $detail['date'];
$outfile = $email.'.pdf';
*/

$book = 'sale_rich_with_outsource.pdf';	
$size = 'A4';
$pwd1 = '';
$pwd2 = ')+I[To^a2/1oR#!0z%xP2v&3@5qX-f;=(|\\';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$name = '';
$date = ''; //$date = date("d/m/Y");

//connect database
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "my_cartoon_python_book";

$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
$query = "SELECT * from customer WHERE email = '" . $email."'" or die("Error:" . mysqli_error()); ; 

$result = mysqli_query($conn,$query);	

while($row = mysqli_fetch_array($result)) { 
	$name = $row['Name'];
	$date = $row['Order_date']; 	
	
}	
mysqli_close($conn);

if($name === ''){
	echo "ไม่พบว่า ".$email. " ได้สั่งซื้อสินค้า <br/> (ถ้าท่านยืนยันว่าได้สั่งซื้อโปรดแจ้ง patanasongsivilai@gmail.com)";
	exit();
}

$outfile = $email.'.pdf'; // ถ้าแสดงหน้าเว็บ ไม่ต้องเซฟไฟล์ .pdf
createPDF($book, $size, $pwd1, $pwd2, $outfile, array($name, $email, $date), true);

?>

