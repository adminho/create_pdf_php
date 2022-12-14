<html>
<head>
<title></title>
</head>
<body>
<form action="save.php" name="frmAdd" method="post">
<table width="284" border="1">
  <tr>
    <th width="120">Order date</th>
    <td width="238"><input type="text" name="Order_date" size="5"></td>
    </tr>
  <tr>
    <th width="120">Name</th>
    <td><input type="text" name="Name" size="20"></td>
    </tr>
  <tr>
    <th width="120">Email</th>
    <td><input type="text" name="Email" size="20"></td>
    </tr>
  <tr>
    <th width="120">Status</th>
    <td>		
		<select name="Status" value="SEND">
			<option value="SEND">SEND</option>			
		</select>		
	</td>
    </tr>
  <tr>
    <th width="120">Book list</th>
    <td>
		<select name="Book_list" value="python ฉบับการ์ตูน">
			<option value="python ฉบับการ์ตูน">1</option>			
		</select>	
	</td>
    </tr>
  </table>
  <input type="submit" name="submit" value="submit">
</form>
</body>
</html>