<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script>

</script>
</head>
<body>

<div style="display:flex; justify-content: center; margin-top:10%;">
<form id="myForm" action="confirm_create_pdf.php" method="get">
	<div class="form-group" align="center">
		<h4>สร้างไฟล์ PDF เพื่อขาย ebook</h4>
	</div>
	<div class="form-group">
		<input class="form-control" type="text" name="date" placeholder="Date" required style="margin-bottom: 5px">
		<input class="form-control" type="text" name="email" placeholder="E-mail" required style="margin-bottom: 5px">
		<input class="form-control" type="text" name="name"  placeholder="Name" required style="margin-bottom: 5px">
		<input class="form-control" type="text" name="orderNo" placeholder="Order No" required style="margin-bottom: 5px">
		<input class="form-control" type="text" name="status" value="SENT" placeholder="Status" required style="margin-bottom: 5px">
			
		<select class="form-control" id="" name="book" placeholder="Book name" required>
			<option value="python beginner book">python beginner book</option>
			<option value="หนังสือ AI ไม่ยาก ปี 1">หนังสือ AI ไม่ยาก ปี 1</option>    
		</select>
	</div>
	
	<input id="btnSubmit" class="btn btn-primary" type="submit" value="ส่งข้อมูล">
	<input type="hidden" id="custId" name="urlConfirm" value="save_to_csv_python_ebook.php">	

</form>

</div>

<script>

let myForm = document.getElementById("myForm");

function my_curr_date() {      
    var currentDate = new Date();
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