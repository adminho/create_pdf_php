<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

<div style="display:flex; justify-content: center; margin-top:2%;">
<form id="myForm" action="confirm_create_pdf.php" method="get">
	<div class="form-group" align="center">
		<h4>สร้างใบสำคัญจ่าย</h4><hr>
	</div>
	
	<div class="form-group">
		<div class="form-inline">
			<label>วันที่ : &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="date" placeholder="Date" required>
		</div>
	</div>

	<div class="form-group">
		<div class="form-inline" style="margin-bottom: 5px">
			<label>รายการ :&nbsp;</label>	
			<select class="form-control form-control-sm" name="items" placeholder="Items" onchange="selectItems(this)" style=" width: 80%" required>
				<option value="ค่าเช่าสถานประกอบการ">ค่าเช่าสถานประกอบการ</option>    
				<option value="ค่าบริการทำบัญชี">ค่าบริการทำบัญชี</option>    		
			</select>
		</div>
	</div>

	<div class="form-group">		
		<div class="form-inline" style="margin-bottom: 5px">
			<label>ผู้รับเงิน :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="name" placeholder="Name" style=" width: 67%" required>
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>ที่อยู่ :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="address" placeholder="Address" style=" width: 84%" required>
		</div>
		<div class="form-inline">
			<label>Tax ID :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="taxId" placeholder="Tax ID" style=" width: 84%" required>
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-inline" style="margin-bottom: 5px">
			<label>จำนวนเงินที่จ่าย : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="amount" placeholder="Baht" required>								
		</div>		
		<div class="form-inline" style="margin-bottom: 5px">
			<label>หัก ณ ที่จ่าย  : &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="taxPercent" placeholder="Baht" required>				
		</div>		
		<div class="form-inline" style="margin-bottom: 5px">
			<label>จำนวนภาษีที่ถูกหัก: &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="tax" placeholder="Baht" required>			
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>คงเหลือสุทธิ  : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="net" placeholder="Baht" required>									
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>รวมจำนวนเงิน (ตัวอักษร)  : &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="bahtChar" size=50 placeholder="ตัวอักษรบาท" required>			
		</div>
	</div>

	<div class="form-group">
		<div class="form-inline">		
			<label>Document No :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="documentNo" placeholder="Document No." required> 			
		</div>
	</div>

	<hr>
	<input class="btn btn-primary" type="submit">
	<input type="hidden" name="urlConfirm" value="create_pdf_payment_voucher.php">	

</form>
</div>
<script>
let myForm = document.getElementById("myForm");
let currentDate = new Date();

function selectItems(selectObject){

 var value = selectObject.value;  
 if (value == "ค่าเช่าสถานประกอบการ"){	
	//myForm.description.value = "ค่าเข่าสถานประกอบการ";
	myForm.name.value = "น.ส. ณัฐภรินทร์ พัฒนทรงศิวิไล";
	myForm.address.value = "เลขที่ 7 หมู่ที่ 4 ตำบลขามทะเลสอ อำเภอขามทะเลสอ จังหวัดนครราชสีมา 30280";
	
	myForm.amount.value=3000;
	//myForm.stangAmount.value="00";
	myForm.taxPercent.value="5%";
	myForm.tax.value=150;
	//myForm.stangTax.value="00";
	myForm.net.value=2850;
	myForm.bahtChar.value="สองพันแปดร้อยห้าสิบบาทถ้วน";

	myForm.taxId.value = "3301900034842";	
	
 } else if (value == "ค่าบริการทำบัญชี"){ 
	//myForm.description.value = "ค่าบริการทำบัญชี";
	myForm.name.value = "นางภัทรพร ทบนอก";
	myForm.address.value = "เลขที่ 93 หมู่ที่ 3 ตำบลขามทะเลสอ อำเภอขามทะเลสอ จังหวัดนครราชสีมา 30280";
	
	myForm.amount.value=2000;
	//myForm.stangAmount.value="00";
	myForm.taxPercent.value="3%";
	myForm.tax.value=60;
	//myForm.stangTax.value="00";
	myForm.net.value=1940;
	myForm.bahtChar.value="หนึ่งพันเก้าร้อยสี่สิบบาทถ้วน";
	
	myForm.taxId.value = "3301900031525";		
 } 

}

function createDate() {      
    let currentDate = new Date();
    let day = currentDate.getDate();
    let month = currentDate.getMonth() + 1;
    let year = currentDate.getFullYear();
    let my_date = day+"/"+month+"/"+year;
	
    myForm.date.value=my_date;    	  	
}

function genOrderNo(){
	let my_date = myForm.date.value.replaceAll("/", ""); 
	let strRandom = Math.random().toString(36).substring(2,7).toUpperCase();	
	myForm.documentNo.value=my_date+strRandom;  
}


window.onload = (event) => {
  createDate();  
  genOrderNo();
  selectItems(myForm.items);
};
</script>
</body>
</html>