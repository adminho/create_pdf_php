<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

<!-- ตัวอย่าง URL http://localhost/form_receipt.php-->
<div style="display:flex; justify-content: center; margin-top:5%; margin-left:5%; margin-right:5%; padding-top:25px; padding-left:20px; padding-right:20px; border-style:double; border-color:green;">

<form id="myForm" action="save_to_csv_receipt.php" method="get">
<h5>สร้างใบเสร็จรับเงิน</h5>
<div class="form-group">
	<div class="row">
		<div class="col">
			<div class="form-inline">
				<label>วันที่ออกใบเสร็จ : &nbsp;</label>
				<input class="form-control form-control-sm" type="text" name="date" placeholder="Date" required>
			</div>
		</div>
		<div class="col">
			<div class="form-inline">
				<label>วันที่สั่งซื้อ : &nbsp;</label>
				<input class="form-control form-control-sm" type="text" name="dateOrder" placeholder="Date" required>
				&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" type="button" onclick="copyDate()" >วันที่เดียวกับออกใบเสร็จ</button>
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<label>ข้อมูลลูกค้า :</label>
	<div class="row">
		<div class="col">
			<input class="form-control form-control-sm" type="text" name="name" placeholder="Name" required>
		</div>
		<div class="col">
			<input class="form-control form-control-sm" type="text" name="tel" placeholder="Tel" >
		</div>
	</div>
	<div class="row">
		<div class="col">
			<input class="form-control form-control-sm" type="text" name="address1" placeholder="Adress 1" required>
		</div>
		<div class="col">
			<input class="form-control form-control-sm" type="text" name="address2" placeholder="Adress 2">
		</div>
	</div>
	
</div>

<div class="form-group">
	<div class="form-inline">
		<label>Book :&nbsp;</label>	
		<select class="form-control form-control-sm" name="book" onchange="selectBook(this)" placeholder="Book name" required>
			<option value="หนังสือ AI ไม่ยาก ปี 1">AI book 1</option>    
			<option value="python beginner book">python beginner book</option>    
		</select>
	</div>
</div>

<div class="form-group">
	<div class="form-inline">
		<label>Price :&nbsp;</label>
		<input class="form-control form-control-sm" type="number" name="price" onchange="sumPrice()" placeholder="Price" required>
		<label>&nbsp;Quantity :&nbsp;</label>
		<input class="form-control form-control-sm" type="number" name="quantity" value=1 onchange="sumPrice()" placeholder="Quantity" required>
		<label>&nbsp;Reduce :&nbsp;</label>
		<input class="form-control form-control-sm" type="number" name="reduce" value=0 onchange="sumPrice()" placeholder="Reduce" required>
		<label>&nbsp;Shipping :&nbsp;</label>
		<input class="form-control form-control-sm" type="number" name="shipping" value=0 onchange="sumPrice()" placeholder="Shipping" required>
		<label>&nbsp;Total net price :&nbsp;</label>
		<input class="form-control form-control-sm" type="number" name="net" value=0 placeholder="Total net price" required>
	</div>
</div>

<div class="form-group">
	<div class="form-inline">		
		<label>Order No :&nbsp;</label>	
		<input class="form-control form-control-sm" type="text" name="orderNo" placeholder="Order No" required> 	
		&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" type="button" onclick="genOrderNo()" >Generate</button>	
	</div>
</div>

<div class="form-group">
	<div class="form-inline">	
		<label>ช่องทางการขาย :&nbsp;</label>	
		<select class="form-control form-control-sm" name="chanel" onchange="selectChanel(this)" placeholder="Chanel required">
			<option value="Shopee">Shopee</option>    
			<option value="ขายโดยตรง">ขายโดยตรง</option>        
		</select>
	&nbsp;&nbsp;<input class="form-control form-control-sm" type="text" name="status" value="SENT" placeholder="STATUS" required>
</div>
<hr>
<input class="btn btn-primary" type="submit">
</form>
</div>
<script>
let myForm = document.getElementById("myForm");
function sumPrice(){	
	 myForm.net.value= (parseInt(myForm.price.value)*parseInt(myForm.quantity.value)) - parseInt(myForm.reduce.value) + parseInt(myForm.shipping.value);    	
}

function selectBook(selectObject){
 var value = selectObject.value;  
 var field = myForm.price
 if (value == "python beginner book"){
	field.value=299; 
 } else if (value == "หนังสือ AI ไม่ยาก ปี 1"){
	field.value=495; 
 }
  
 sumPrice();	
}

function selectChanel(selectObject){
 var value = selectObject.value;  
 var field = myForm.shipping;
 console.log(value, field.value);
 if (value == "ขายโดยตรง"){
	field.value=0; 
 } else if (value == "Shopee"){
	field.value=64; 
 }
 
 sumPrice();	
}

function my_curr_date() {      
    let currentDate = new Date()
    let day = currentDate.getDate();
    let month = currentDate.getMonth() + 1;
    let year = currentDate.getFullYear();
    let my_date = day+"/"+month+"/"+year;
	
    myForm.date.value=my_date;    	  	
}

function copyDate(){
	myForm.dateOrder.value=myForm.date.value;   
}

function genOrderNo(){
	let my_date = myForm.date.value.replaceAll("/", ""); 
	let strRandom = Math.random().toString(36).substring(2,7).toUpperCase();	
	myForm.orderNo.value=my_date+strRandom;  
}

window.onload = (event) => {
  my_curr_date();
  selectBook(myForm.book);
  selectChanel(myForm.chanel)  
};
</script>
</body>
</html>