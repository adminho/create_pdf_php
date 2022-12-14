<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
	//ini_set('display_errors', 1);
	//error_reporting(~0);

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "my_cartoon_python_book";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	$email =$_POST["Email"];
	$sql = "INSERT INTO customer (Order_date, Name, Email, Status, Book_list) 
		VALUES ('".$_POST["Order_date"]."','".$_POST["Name"]."','".$_POST["Email"]."'
		,'".$_POST["Status"]."','".$_POST["Book_list"]."')";

	$query = mysqli_query($conn,$sql);

	if($query) {
		echo "Record add successfully";
	} else {
		echo "Record failed";
	}

	mysqli_close($conn);
?>
<br/>
<?php

echo "send mail to <a href='send_email.php?email=metoping@hotmail.com&name=จตุรพัชร์&book_id=1'>".$email."</a>";
?>
</body>
</html>