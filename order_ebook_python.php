<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script>

</script>
</head>
<body>
<div style="display:flex; justify-content: center; margin-top:10%;">
<!-- ตัวอย่าง URL http://localhost/save_to_csv_pdfbook.php.php-->
<form id="myForm" action="save_to_csv_pdfbook.php" method="get">
	<div id="allData">
		<h5>สร้างไฟล์ PDF เพื่อขาย ebook</h5>
		<div class="form-group">
			<input class="form-control" type="text" name="date" placeholder="Date" required>
			<input class="form-control" type="text" name="email" placeholder="E-mail" required>
			<input class="form-control" type="text" name="name" size="50" placeholder="Name" required>
			<input class="form-control" type="text" name="orderNo" placeholder="Order No" required>
			<input class="form-control" type="text" name="status" value="SENT" placeholder="Status" required>
			
			<select class="form-control" id="" name="book" placeholder="Book name" required>
				<option value="python beginner book">python beginner book</option>
				<option value="AI book">AI book</option>    
			</select>
		</div>
	</div>
	<div id="showAllData" style="display:none; justify-content: center; margin-top:5%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px; border-style:double; border-color:green;">
	</div>
	<div>
		<input id="btnConfirm" class="btn btn-primary" type="button" value="ตรวจสอบข้อมูล" onclick="showConfirmBottom()">
		<br>
		<input id="btnSubmit" class="btn btn-success" type="submit" value="กดส่งข้อมูล" style="display:none;">
	</div>
</div>
</form>

<div id="showAllData" style="display:flex; justify-content: center; margin-top:10%;">
</div>
</div>

<script>

let myForm = document.getElementById("myForm");

function showConfirmBottom(){
   let params = "";
   for( let i=0; i<myForm.elements.length; i++ ) {
		let e = myForm.elements[i];
		let fieldName = e.name;
		let fieldValue = e.value;

        if( e.type != "submit" && e.type != "button"){
			params += fieldName + ':  ' + fieldValue + '<br>';
		}
   }
	
	document.getElementById("showAllData").style.display = "block";
	document.getElementById("showAllData").innerHTML= "<p>" + params + "</p>";
	document.getElementById("btnConfirm").style.display = "none";
	document.getElementById("btnSubmit").style.display = "block";
}

function my_curr_date() {      
    var currentDate = new Date()
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();
    var my_date = day+"/"+month+"/"+year;
	
	
	myForm.date.value=my_date;    
	
	var str = Math.random().toString(36).substring(2,7).toUpperCase();
	var my_orderNo =  day+""+month+""+year+""+str;
	myForm.orderNo.value=my_orderNo;    	
}

window.onload = (event) => {
  my_curr_date();
};
</script>
</body>
</html>