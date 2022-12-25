<?php

$count = count($_GET);
$urlConfirm = isset($_GET['urlConfirm']) ? $_GET['urlConfirm'] : '';
$urlBack = isset($_GET['urlBack']) ? $_GET['urlBack'] : '';

if($count > 0) {
  echo '<div style="justify-content: center;  margin-top:3%; margin-left:20%; margin-right:20%; padding-top:0px;  padding-left:10px;  padding-right:10px;  padding-bottom:10px; border-style:double; border-color:green;">';
  echo '<h4>ตรวจสอบข้อมูล</h4>';
  echo "<form action=$urlConfirm method='get'>";
    foreach($_GET as $query_string_variable => $value) {
		if($query_string_variable != "urlConfirm" && $query_string_variable != "urlBack"){
		echo "<label>$query_string_variable :&nbsp;</label><input type='text' name=$query_string_variable readonly='readonly' value='$value' style='margin-top:5px;border:0;width:80%;background:#F8F8F8;border-radius:5px;'><br>";
		}
    }
	echo "<br><div align='left'><input type='submit' value='ยืนยัน'></div>";		
	echo "</form>";		
	echo "<br><div align='left'><input type='submit' value='กลับไปแก้ไข' onclick='window.history.back();'></div>";		
  echo "</div>";  
}

?> 