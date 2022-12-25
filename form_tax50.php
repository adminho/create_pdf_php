<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>
<body>

<div style="display:flex; justify-content: center; margin-top:2%;">
<form id="myForm" action="confirm_create_pdf.php" method="get">
	<div class="form-group" align="center">
		<h4>สร้างทวิ 50</h4><hr>
	</div>
	
	<div class="form-group">
		<div class="form-inline">
			<label>Book No :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="bookNo" size=10 placeholder="Book No" required>
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-inline">
			<label>วันที่ : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="day" size=2 placeholder="Day" required onchange="genOrderNo()">
			<label>&nbsp;&nbsp;เดือน : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="month" size=2 placeholder="Month" required onchange="genOrderNo()">				
			<label>&nbsp;&nbsp;ปี : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="year" size=4 placeholder="Year" required onchange="genOrderNo()">				
		</div>
	</div>

	<div class="form-group">
		<div class="form-inline">
			<label>Document :&nbsp;</label>	
			<select class="form-control form-control-sm" name="document" placeholder="เอกสาร" onchange="selectDocument(this)" required>
				<option value="ทวิ 50 ค่าเช่าบ้าน">ทวิ 50 ค่าเช่าบ้าน</option>    
				<option value="ทวิ 50 ค่าทำบัญชี">ทวิ 50 ค่าทำบัญชี</option>    
				<option value="ทวิ 50 ค่าขนส่ง Shopee">ทวิ 50 ค่าขนส่ง Shopee</option>    
				<option value="ทวิ 50 ค่าบริการต่างๆ ของ Shopee">ทวิ 50 ค่าบริการต่างๆ ของ Shopee</option>  
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="form-inline" style="margin-bottom: 5px">
			<label>รายละเอียดเงินได้ :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="description" placeholder="Description" style=" width: 70%" required>
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>ผู้ถูกหักภาษี ณ ที่จ่าย :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="name" placeholder="Name" style=" width: 67%" required>
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>ที่อยู่ :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="address" placeholder="Address" style=" width: 84%" required>
		</div>
		<div class="form-inline">
			<label>Tax ID :&nbsp;</label>	
			<input class="form-control form-control-sm" type="number" name="taxId1" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId2" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId3" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId4" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId5" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId6" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId7" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId8" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId9" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId10" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId11" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId12" style=" width: 45px" required>
			<input class="form-control form-control-sm" type="number" name="taxId13" style=" width: 45px" required>
		</div>
	</div>
	
	<div class="form-group">
		<div class="form-inline" style="margin-bottom: 5px">
			<label>จำนวนเงินที่จ่าย : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="amount" placeholder="Baht" required>
			<label>&nbsp;&nbsp;สตางค์: &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="stangAmount" placeholder="Baht" style=" width: 10%" required>							
		</div>		
		<div class="form-inline" style="margin-bottom: 5px">
			<label>ภาษีที่หักและนำส่งไว้  : &nbsp;</label>
			<input class="form-control form-control-sm" type="number" name="tax" placeholder="Baht" required>
			<label>&nbsp;&nbsp;สตางค์ : &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="stangTax" placeholder="Baht" style=" width: 10%" required>							
		</div>
		<div class="form-inline" style="margin-bottom: 5px">
			<label>รวมเงินภาษีที่หักนำส่ง (ตัวอักษร)  : &nbsp;</label>
			<input class="form-control form-control-sm" type="text" name="bahtChar" size=50 placeholder="ตัวอักษรบาท" required>			
		</div>
	</div>

	<div class="form-group">
		<div class="form-inline">		
			<label>No :&nbsp;</label>	
			<input class="form-control form-control-sm" type="text" name="documentNo" placeholder="Document No." required> 			
		</div>
	</div>

	<hr>
	<input class="btn btn-primary" type="submit">
	<input type="hidden" name="urlConfirm" value="create_pdf_tax50.php">	
	
</form>
</div>
<script>
let myForm = document.getElementById("myForm");
let currentDate = new Date();

function pushTaxIdtoElement(myForm, taxId){
let count = 1;
	for (const n of taxId) {
		myForm["taxId" + count++ ].value=n;
	}
}
function selectDocument(selectObject){
 myForm.bookNo.value = "OR-2022"; 

 var value = selectObject.value;  
 if (value == "ทวิ 50 ค่าเช่าบ้าน"){	
	myForm.description.value = "ค่าเข่าสถานประกอบการ";
	myForm.name.value = "น.ส. ณัฐภรินทร์ พัฒนทรงศิวิไล";
	myForm.address.value = "เลขที่ 7 หมู่ที่ 4 ตำบลขามทะเลสอ อำเภอขามทะเลสอ จังหวัดนครราชสีมา 30280";
	
	myForm.amount.value=3000;
	myForm.stangAmount.value="00";
	myForm.tax.value=150;
	myForm.stangTax.value="00";
	myForm.bahtChar.value="หนึ่งร้อยห้าสิบบาทถ้วน";

	let taxId = "3301900034842";
	pushTaxIdtoElement(myForm, taxId);	
	
 } else if (value == "ทวิ 50 ค่าทำบัญชี"){ 
	myForm.description.value = "ค่าบริการทำบัญชี";
	myForm.name.value = "นางภัทรพร ทบนอก";
	myForm.address.value = "เลขที่ 93 หมู่ที่ 3 ตำบลขามทะเลสอ อำเภอขามทะเลสอ จังหวัดนครราชสีมา 30280";
	
	myForm.amount.value=2000;
	myForm.stangAmount.value="00";
	myForm.tax.value=60;
	myForm.stangTax.value="00";
	myForm.bahtChar.value="หกสิบบาทถ้วน";
	
	let taxId = "3301900031525";
	pushTaxIdtoElement(myForm, taxId);	
	
 } else if(value == "ทวิ 50 ค่าขนส่ง Shopee"){
	myForm.description.value = "ค่าขนส่ง";
	myForm.name.value = "บริษัท ช้อปปี้ เอ็กซ์เพรส (ประเทศไทย) จำกัด";
	myForm.address.value = "อาคาร เอไอเอ แคปปิตอล เซ็นเตอร์ ชั้นที่ 24 เลขที่ 89 ถนนรัชดาภิเษก แขวงดินแดง เขตดินแดง จังหวัดกรุงเทพมหานคร 10400";
	
	myForm.amount.value=0;
	myForm.stangAmount.value="00";
	myForm.tax.value=0;
	myForm.stangTax.value="00";
	myForm.bahtChar.value="";
	
	let taxId = "0105561164871";
	pushTaxIdtoElement(myForm, taxId);			
 
 } else if(value == "ทวิ 50 ค่าบริการต่างๆ ของ Shopee"){
	myForm.description.value = "ค่าบริการต่างๆ ของช้อปปี้ ";
	myForm.name.value = "บริษัท ช้อปปี้ (ประเทศไทย) จำกัด";
	myForm.address.value = "อาคาร เอไอเอ แคปปิตอล เซ็นเตอร์ ชั้นที่ 24 เลขที่ 89 ถนนรัชดาภิเษก แขวงดินแดง เขตดินแดง จังหวัดกรุงเทพมหานคร 10400";
	
	myForm.amount.value=0;
	myForm.stangAmount.value="00";
	myForm.tax.value=0;
	myForm.stangTax.value="00";
	myForm.bahtChar.value="";
	
	let taxId = "0105558019581";
	pushTaxIdtoElement(myForm, taxId);	
 
 }

}

function createDate() {      
    let currentDate = new Date();
    let day = currentDate.getDate();
    let month = currentDate.getMonth() + 1;
    let year = currentDate.getFullYear();
	    	
    myForm.day.value=day;    
	myForm.month.value=month;  
	myForm.year.value=year;  	
}

function genOrderNo(){
	let currentDate = new Date();	
    let d = parseInt(myForm.day.value) + 10;
    let m = parseInt(myForm.month.value) + 10;
    let y = myForm.year.value;
	let h = currentDate.getHours()+10;
	let mm = currentDate.getMinutes()+10;
	myForm.documentNo.value=d+""+m+""+y+""+h+""+mm;  
}

window.onload = (event) => {
  createDate();  
  genOrderNo();
  selectDocument(myForm.document);
};
</script>
</body>
</html>