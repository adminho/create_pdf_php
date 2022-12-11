<?php

$count = count($_GET);
if($count > 0) {
  echo '<div style="justify-content: center;  margin-top:3%; margin-left:20%; margin-right:20%; padding-top:0px;  padding-left:10px;  padding-right:10px;  padding-bottom:10px; border-style:double; border-color:green;">';
  echo '<h4>ตรวจสอบข้อมูล</h4>';
  echo '<form id="myForm" action="save_to_csv_pdfbook.php" method="get">';
    foreach($_GET as $query_string_variable => $value) {
       echo "<label>$query_string_variable :&nbsp;</label><input type='text' name=$query_string_variable size=50 readonly='readonly' value='$value' ><br>";
    }
	echo "<br><div align='left'><input type='submit' value='ยืนยัน'></div>";		
	echo "</form>";	
	echo "<div align='left'><a href='order_ebook_python.php'><button>Back</button></a></div>";
  echo "</div>";
  
  
}

?> 