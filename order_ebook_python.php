<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script>

</script>
</head>
<body>
<div style="display:flex; justify-content: center; margin-top:10%;">
<!-- ตัวอย่าง URL http://localhost/confirm_ebook.php-->
<form id="myForm" action="confirm_ebook.php" method="get">
	<h4>สร้างไฟล์ PDF เพื่อขาย ebook</h4>
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
	
	<input id="btnSubmit" class="btn btn-success" type="submit" value="ส่งข้อมูล">
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