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
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<hr>
		<p>อีบุ๊กเล่มนี้ปกติวางขายที่  <a href="https://www.mebmarket.com/web/index.php?action=BookDetails&data=YToyOntzOjc6InVzZXJfaWQiO3M6NzoiMTcyNTQ4MyI7czo3OiJib29rX2lkIjtzOjY6IjE5MjkyMiI7fQ">meb</a>
		<br>แต่ผมก็เปิดช่องทางขายเป็นเวอร์ชั่น pdf พิเศษ  (เวอร์ชั่นขาวดำ)
		<br>เพื่อคุณ&nbsp;$name&nbsp;โดยเฉพาะ
		<br>สามารถ print ออกมาอ่านดูส่วนตัวได้นะครับ
		<br><font color="red">แต่ขอร้อง กราบเบญจางคประดิษฐ์งามๆ <br>ไม่นำไปจำหน่ายหรือแจกจ่ายต่อให้คนอื่นนะครับ</font></p>    
		<hr>
		<!--<p>ถ้าเกิดผมอัปเดตอะไรใหม่ในหนังสือ</p>-->
		<!--<p>ก็จะแจ้งผ่านทางเมลคุณ <font color="blue">$email</font></p> -->   
		<!--<p>ส่วนรหัสผ่านเปิด PDF ใช้เป็น <font color="red">$pwd1</font></p> -->
		<!--<p>มีปัญหาติดต่อได้ที่เมล <font color="blue">patanasongsivilai@gmail.com</font> นะครับ</p> -->  
		
	</div>';
	
	$frist_name = explode(' ', $name)[0];
	//$frist_name = $name;
	$vars = array(
		'$name' => $name,
		'$email' => $email,      
		'$pwd1' => $pwd1,  
	);
	$html_intro = strtr($html_intro, $vars);

	$html_end = '<div class="container"><p id="thank">หวังว่าเล่มนี้จะเป็นประโยชน์ต่อคุณ<br>$name</p></div>';  
	$vars = array( '$name' => $name );
	$html_end = strtr($html_end, $vars);

	//https://htmlpdfapi.com/blog/free_html5_invoice_templates
	$html_invoice = '<html><body>    
	<header class="clearfix">
	  <h1>ใบเสร็จรับเงิน/Receipt</h1>
      <div id="company" class="clearfix">        
      </div>
      <div id="project">        
		<div>ผู้ขาย/Seller: <span>หจก. หกห้าเอ็ดดูเคชั่น</span></div>
		<div>ที่อยู่/Address: <span>7 ม.4 ต.ขามทะเลสอ อ.ชามทะเลสอ จ.นครราชสีมา 30280</span></div>		
		<div>อีเมล/Email: <span>patanasongsivilai@gmail.com</span></div>  
		
		<div style="padding: 10px 0;">
		<div>ลูกค้า/Client: <span>$name</span></div>          
		<div>ที่อยู่/Address: <span>$name</span></div>   		
		<div><font color="white">ที่อยู่/Address:</font> <span>$name</span></div>
		<div>อีเมล/Email: <span>$email</span></div>
		<div>วันที่/Date: <span>$date</span> </div>		
		</div>		
		<div style="padding: 10px 0;">
		<div>คำสั่งซื้อ/order: <span><font color="green">$date</font></span></div>	
		</div>		
      </div>	  	  
    </header>
    <main>
      <table>
        <thead>
          <tr>
			<th class="service">ลำดับ<br>No.</th>		  
            <th class="desc">รายการ<br>Description</th>
            <th>ราคาต่อหน่วย<br>Unit Price</th>
            <th>จำนวน<br>Qty</th>
            <th>จำนวนเงิน<br>Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>            
			<td class="service">1</td>
            <td class="desc">PDF<br/>เปิดซิงโค้ดดิ้งด้วยไพทอน<br>ไม่ใช่เด็กคอมก็เก็ต</td>
            <td class="unit">495 ฿</td>
            <td class="qty">1</td>
            <td class="total">495 ฿</td>
          </tr>                   
          <tr>
            <td colspan="4" class="grand total">รวม&nbsp;&nbsp;&nbsp;<br/>TOTAL</td>
            <td class="grand total"><font style="color:#003300">495 ฿</td>
          </tr>
        </tbody>
      </table>
	  <div id="notices">ลงชื่อ&nbsp;__________________________&nbsp;ผู้รับเงิน
	  </div>
      <div id="notices">        
		<div class="notice">NOTICE: เอกสารฉบับนี้ออกให้กับลูกค้าโดยโปรแกรมอัตโนมัติ </div>		
      </div>      
    </main><footer>ขอบคุณที่อุดหนุนกันครับ (Thank you)</footer></body></html>';
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
	$mpdf->SetTitle('AI ไม่ยาก"');
	$mpdf->SetAuthor('นายจตุรพัชร์ พัฒนทรงศิวิไล');
	$mpdf->SetCreator('หจก. หกห้าเอ็ดดูเคชั่น');
	$mpdf->SetSubject($info_buyer);
	$mpdf->SetKeywords('ไพทอน, Python,จตุรพัชร์ พัฒนทรงศิวิไล');

	$info_buyer_base64 = base64_encode($info_buyer);
			
	//------Enter password and protect pdf don't print, edit, copy
	//$mpdf->SetProtection(array(), $pwd1, $pwd2);
	//$mpdf->SetProtection(array('print'), $pwd1, $pwd2);

	$pagecount = $mpdf->SetSourceFile(__DIR__ . '/ebooks/'.$book);
	// Import the last page of the source PDF file
	// copy all pages from the old unprotected pdf in the new one
	$stylesheet = file_get_contents('AI_book_style.css');
	$mpdf->WriteHTML($stylesheet,1);	
		
	for ($page = 1; $page <= $pagecount; $page++) {
		
		$tplidx = $mpdf->importPage($page);
		$mpdf->useTemplate($tplidx);		
		$mpdf->WriteHTML('<font color="LightGray">$name------------</font>');
		if($page == 4){					
			///$mpdf->WriteHTML($html_invoice);			
		} else if($page == 6){					
			//$mpdf->WriteHTML($html_intro);					
		} //else if($page === $pagecount-1)  {			
			//$mpdf->WriteHTML($html_end);
		//} 		
		else if($page == 1){
			$test = '<div id="cover_page">เพื่อคุณ $name โดยเฉพาะ</div>';
			$vars = array( '$name' => $name);
			$test = strtr($test, $vars);
			$mpdf->WriteHTML($test);
		}
		else if($page==59 || $page==95 || $page==191 || $page==122 || $page==259 || $page==319 || $page==487)  {
			$test = '<div class="qrcode">เรียนคุณ $name</div>';
			$vars = array( '$name' => $name);
			$test = strtr($test, $vars);
			$mpdf->WriteHTML($test);
		} else
		if( $page==122 || $page==244 || $page==416 || $page==446 || $page==608) {
			
		}
		else if($page % 2 == 0){
			$test = '<div><p>เนื้อหาดัดแปลงมาจากเล่ม "AI ไม่ยาก เข้าใจด้วยเลขม. ปลาย"</p></div><div class="buyer">$info_buyer</div><div class="footer">รบกวนไม่นำไปแจกจ่าย แบ่งบัน หรือจำหน่ายให้คนอื่นนะครับ</div>';
			$vars = array( '$info_buyer' => $info_buyer_base64);
			$test = strtr($test, $vars);
			$mpdf->WriteHTML($test);
		} 
		
		
		if($page < $pagecount){
			$mpdf->addPage();
		}		
	}

	//--- Output file pdf ---//	
	if ($show){
		$mpdf->Output($outfile, \Mpdf\Output\Destination::INLINE);
	}else{
		$mpdf->Output($outfile);
	}
} // end function

//$csv_file = 'ลูกค้า หนังสือ _โปรแกรมเมอร์ก็รวยได้ ด้วยเส้นทางเอาท์ซอร์สสายดำ_ (การตอบกลับ) - การตอบแบบฟอร์ม 1';
//$xls_file = 'outsource_1.xlsx';

$book = 'AI_easy_book1_bw.pdf';	
//$size = 'B5';
$size = 'A4';
$date = ''; //$date = date("d/m/Y");
$pwd1 = '';
$pwd2 = ')+I[To^a2/1oR#!0z%xP2v&3@5qX-f;=(|\\';
$local_dir = 'D:/sales/';
$ouput_file_dir = $local_dir.'salebook_python/';

// ตัวอย่าง URL http://localhost/buy_ebook_python.php?csv=python_list_customer.csv
$csv_file = isset($_GET['csv']) ? $_GET['csv'] : '';
if( !empty($csv_file )){
	//$csv_file = $local_dir.$csv_file;
	$csv_file = $csv_file;
	if (($handle = fopen($csv_file, "r")) !== FALSE) {
		$row = 1;
		//while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {	
		$is_createfile=FALSE;
		while (($data = fgetcsv($handle)) !== FALSE) {			
			if ($row++ == 1) continue; // skip head row in csv file			
			//$date = explode(' ', $data[0])[0];			
			$date = $data[0];			
			$email = $data[1];
			$name = $data[2];			
			$status = $data[3];
			$outfile = $ouput_file_dir.$email.'.pdf';
			if (!file_exists($outfile) && $status==='SENT') {					
				createPDF($book, $size, $pwd1, $pwd2, $outfile, array($name, $email, $date), FALSE );				
				echo "<a href = 'show_pdf.php?filename=$outfile' target='_blank'> $email.pdf </a> --> สร้างไฟล์สำเร็จ<br>";	
											
				//$command = escapeshellcmd('python C:/python/merge_pdf.py');
				//$output = shell_exec($command);
				
				
				$is_createfile=TRUE;
			} 		 
		}		
		fclose($handle);	
		if( $is_createfile == FALSE){
			echo '<hr><br>มีได้สร้างไฟล์ pdf เพราะยังไม่มีรายชื่อลูกค้าใหม่เข้ามาเลย<br>';		
		}		
	} else {
		echo '<hr><br>ไม่มีไฟล์'.$csv_file.'<br>';		
	}		
	exit();
} 

?>

