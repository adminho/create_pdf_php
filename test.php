<?php

session_start();
// If the user is not logged in redirect to the login page...
/*if (!isset($_SESSION['loggedin'])) {
	header('location: login.php');
	exit;
} else {
    $currentTime = time();
    if($currentTime > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    header('location: login.php');
	exit;
   }
} */



function endsWith($haystack, $needle, $case = true) {
	if ($case) {
		return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)), $needle) === 0);
	}
	return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)), $needle) === 0);
}

function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

$BOOK_ID = isset($_GET['BOOK_ID']) ? $_GET['BOOK_ID'] : '';
//http://localhost/test.php?BOOK_ID=easy_ai_chapter10_17AX12BNTU

$LINK_TO_ADS = "https://www.mebmarket.com/web/index.php?action=BookDetails&data=YToyOntzOjc6InVzZXJfaWQiO3M6NzoiMTcyNTQ4MyI7czo3OiJib29rX2lkIjtzOjY6IjEwODI0NiI7fQ";
$IMG_TO_ADS = "https://cdn-local.mebmarket.com/meb/server1/108246/Thumbnail/book_detail_large.gif?21";
$BOOK_ID = "easy_ai_chapter10_17AX12BNTU";
$BLANK_IMG="";

if(startsWith($BOOK_ID , "easy_ai_")){
	$BLANK_IMG="blank_img_A4_AI_book.png";
}	

$local_dir = "";
if($BOOK_ID == "easy_ai_chapter10_17AX12BNTU") {
	$local_dir = 'ebooks_img/easy_ai_chapter10/';	
}
   
// Initialize the counter variable to 0
$i = 0; 
if( $handle = opendir($local_dir) ) {
	while( ($file = readdir($handle)) !== false ) {
		if( !in_array($file, array('.', '..')) && !is_dir($local_dir.$file))
			if(endsWith($file, ".png")){
				$i++;
		    }			
	}
}		
	
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<!-- Meta Pixel Code -->
<!--
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '850555626301080');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=850555626301080&ev=PageView&noscript=1"
/></noscript>-->
<!-- End Meta Pixel Code -->
<style>
* {box-sizing: border-box}

body {
	font-family: Verdana, sans-serif; 
	margin:0;
	background-color: #616160 ;
}

.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
button.prev, button.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: lightgray;
  font-weight: bold;  
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  z-index: 3;
  position: fixed;
  border: none;
  outline:none;
  background-color: Transparent;
}

.prev {
  left: 2%;
  border-radius: 3px 0 0 3px;
}

/* Position the "next button" to the right */
.next {
  right: 5%;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  /*color: #f2f2f2;*/
  color: gray;
  font-size: 16px;
  font-weight: bold;
  padding: 8px 12px;
  position: absolute;
  top: 0; 
  right: 0;
  left: 0;
  justify-content: center;
  display: flex;
  position: fixed;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

.ads {
  position: fixed; /* Sit on top of the page content */
  display: block; /* Hidden by default */
  width: 8%; 
  height: 8%; 
  top: 0;
  left: 5%; 
  background-color: rgba(0,0,0,0.0); /* Black background with opacity */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */	
	
}

.loading{
  position: fixed; /* Sit on top of the page content */
  display: block; /* Hidden by default */  
  z-index: 4;
  text-align: center; 
  color: #E97451;	
}

.fixControlBtn{
	background: #D3D3D3;	
	position: fixed;
	bottom: 0;
	right: 0;
	left: 0;
	justify-content: center;
	display: flex;
	z-index: 5;	  	
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 320px) {
  .text, .numbertext {font-size: 10px;}  
  .loading{
	width: 30%; 
	height: 10%;
	top: 10%;
	left: 40%;  
	font-size: 12px;
  }
  button.prev, button.next  {
    font-size: 12px;
  }
}

@media only screen and (min-width:321px) and (max-width:768px){
  .text, .numbertext {font-size: 14px;}  
  .loading{
	width: 30%; 
	height: 10%;
	top: 10%;
	left: 40%;  
	font-size: 16px;
  }
  button.prev, button.next  {
    font-size: 16px;
  }	
}

@media only screen and (min-width:769px) {
  .text, .numbertext {font-size: 18px;}  
  .loading{
	width: 25%; 
	height: 10%;
	top: 50%;
	left: 40%;  
	font-size: 30px;
  }
  button.prev, button.next  {
    font-size: 40px;
  }
}



</style>
<script>
   
</script>
</head>
<body>
<div class="container">

<div id="textLoading" class="loading"></div>
<div id="myAds" class="ads"></div>
<span id="pageNoHeader" class="numbertext"></span>


<button id="previousPageArrow" class="prev" onclick="previousPage()">&#10094; ก่อนหน้า</button>
<button id="nextPageArrow" class="next" onclick="nextPage()">ถัดไป &#10095;</button>


<div>
	<div class="text-center" style="background-color:black; border-style: ridge; border-color: lightgray; margin-bottom:5%;" >	   
       <img id="showImageArea"/> 	   
   </div>
</div>
 
<div class="d-flex justify-content-center fixControlBtn">
  
  <div class="p-2">
	<button id="firstPageBtn" type="button" class="btn btn-secondary btn-sm" onclick="firstPage()">&lt;&lt;</button>
  </div>
  <div class="p-2">
	<button id="previousPageBtn" type="button" class="btn btn-primary btn-sm" onclick="previousPage()">prev</button>
  </div>
  
  <div class="p-2" style="margin-top:4px; width:30px">
	<span id="pageNoText" ></span>
  </div>
  <div class="p-2">
	<button id="nextPageBtn" type="button" class="btn btn-primary btn-sm" onclick="nextPage()">next</button>
  </div>
  <div class="p-2">
	<button id="lastPageBtn" type="button" class="btn btn-secondary btn-sm" onclick="lastPage()">>></button>
  </div>

  <div class="p-2">
	&nbsp;
  </div>  
  <div class="p-2">
	<img src="zoom.png" style="width:20px"/>
	<select id="selectReduceImage" class="form-select form-select-sm" onchange="adjustSizeImage(this)" >					  			
				<option value="50%">50%</option> 
				<option value="60%">60%</option>    
				<option value="70%">70%</option>  
				<option value="80%">80%</option>    
				<option value="90%">90%</option>  
				<option selected value="100%">100%</option> 
	</select>
  </div>
 </div>


</div>


<script>

const LINK_TO_ADS = "<?php echo $LINK_TO_ADS; ?>";
const IMG_TO_ADS = "<?php echo $IMG_TO_ADS; ?>";
const BOOK_ID = "<?php echo $BOOK_ID; ?>";
const BLANK_IMG = "<?php echo $BLANK_IMG; ?>";
const TOTAL_PAGE = "<?php echo $i; ?>";
const FIRST_PAGE = 1;
const token = "<?php echo 123?>";


let showImageArea = document.getElementById("showImageArea");
let pageNoText = document.getElementById("pageNoText");
let pageNoHeader = document.getElementById("pageNoHeader");
let textLoading = document.getElementById("textLoading");
let imgAreaContainer = document.getElementById("imgAreaContainer");

function msgWaitLoadImage(enabled){
	let msg = enabled?"กำลังโหลด...":"";	
	textLoading.innerHTML=msg;
}

function disableAllBtn(){
	document.getElementById("firstPageBtn").disabled=true;
		document.getElementById("previousPageBtn").disabled=true;
		document.getElementById("nextPageBtn").disabled=true;
		document.getElementById("lastPageBtn").disabled=true;		
		
		document.getElementById("previousPageArrow").style.display="none";
		document.getElementById("previousPageArrow").disabled=true;
		document.getElementById("nextPageArrow").style.display="none";
		document.getElementById("nextPageArrow").disabled=true;
}


function showAllBtn(pageNo){
	if(pageNo<=FIRST_PAGE){
		document.getElementById("firstPageBtn").disabled=true;
		document.getElementById("previousPageBtn").disabled=true;
		
		document.getElementById("nextPageBtn").disabled=false;
		document.getElementById("lastPageBtn").disabled=false;
		
		document.getElementById("previousPageArrow").style.display="none";
		document.getElementById("previousPageArrow").disabled=true;
		document.getElementById("nextPageArrow").style.display="block";
		document.getElementById("nextPageArrow").disabled=false;
		
	} else if(pageNo>=TOTAL_PAGE) {
		document.getElementById("firstPageBtn").disabled=false;
		document.getElementById("previousPageBtn").disabled=false;
		
		document.getElementById("nextPageBtn").disabled=true;
		document.getElementById("lastPageBtn").disabled=true;
		
		document.getElementById("previousPageArrow").style.display="block";
		document.getElementById("previousPageArrow").disabled=false;
		document.getElementById("nextPageArrow").style.display="none";
		document.getElementById("nextPageArrow").disabled=true;
	} else{
		document.getElementById("firstPageBtn").disabled=false;
		document.getElementById("previousPageBtn").disabled=false;
		document.getElementById("nextPageBtn").disabled=false;
		document.getElementById("lastPageBtn").disabled=false;		
		
		document.getElementById("previousPageArrow").style.display="block";
		document.getElementById("previousPageArrow").disabled=false;
		document.getElementById("nextPageArrow").style.display="block";
		document.getElementById("nextPageArrow").disabled=false;
	}
}

function adjustSizeImage(selected){
	showImageArea.style= `width: ${selected.value};`;	
}

function showImage(pageNo){	
	pageNoHeader.innerHTML = "";
	disableAllBtn();
	showImageArea.src = BLANK_IMG;
	msgWaitLoadImage(true);
	
	if( pageNo >= FIRST_PAGE && pageNo <= 9){
		pageNo = '0'+ pageNo;
	} 		
		
	let objXMLHttpRequest = new XMLHttpRequest();
	objXMLHttpRequest.onreadystatechange = function() {
	if(objXMLHttpRequest.readyState === 4) {
			if(objXMLHttpRequest.status === 200) {							
				setTimeout( () => {
							msgWaitLoadImage(false);
							
							let value = objXMLHttpRequest.responseText;
							if(value == "session timeout") {
								window.location.href = "login.php";
							} else {													
								showImageArea.src	= value;
								showAllBtn(pageNo);
								pageNoText.innerHTML = pageNo;
								pageNoHeader.innerHTML = `- ${pageNo} -`;	
							}
				}, 100);
												
			} else {
				console.log('Error Code: ' +  objXMLHttpRequest.status);
				console.log('Error Message: ' + objXMLHttpRequest.statusText);
			}
		}	
	}
objXMLHttpRequest.open('GET', `encode_base64.php?page_no=${pageNo}&book_id=${BOOK_ID}&token=${token}`);
	objXMLHttpRequest.send();	
}


function nextPage(){
	currentPage=parseInt(pageNoText.innerHTML);
	currentPage++;
	
	if(currentPage <= TOTAL_PAGE){
		showImage(currentPage);			
		
	} else if(currentPage > TOTAL_PAGE) {
		currentPage = TOTAL_PAGE;
		showImage(currentPage);
	}	
	
}

function previousPage(){	
	currentPage=parseInt(pageNoText.innerHTML);
	currentPage--;
	
	if(currentPage >= FIRST_PAGE){
		showImage(currentPage);	
		
	} else if(currentPage < FIRST_PAGE){
		currentPage = FIRST_PAGE;		
		showImage(currentPage);
	}
	
	
}

function firstPage(){
	currentPage=FIRST_PAGE;
	showImage(FIRST_PAGE);	
}

function lastPage(){
	currentPage=TOTAL_PAGE;
	showImage(TOTAL_PAGE);
}
  
window.onload = (event) => {		

	document.getElementsByTagName("html")[0].setAttribute("oncontextmenu", "return false"); 	
	
	document.onkeydown = function(e){
		//e.cancelBubble = true;
        //e.preventDefault();
        //e.stopImmediatePropagation();
	}
	
	showImage(FIRST_PAGE);	
	adjustSizeImage(document.getElementById("selectReduceImage"));		
	
	document.getElementById("myAds").innerHTML=`<a href=${LINK_TO_ADS}  target="_blank" ><img src=${IMG_TO_ADS} style="width:100%"/></a>`;	
};

</script>



</body>
</html> 
