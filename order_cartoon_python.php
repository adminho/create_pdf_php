<?php
$con= mysqli_connect("localhost","root","","my_cartoon_python_book") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'tis620' ");
 
 
 //2. query ข้อมูลจากตาราง tb_member: 
$query = "SELECT * FROM customer ORDER BY Order_date asc" or die("Error:" . mysqli_error()); 
//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($con, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
 
echo "<table border='1' align='center' width='500'>";
//หัวข้อตาราง
echo "<tr align='center' bgcolor='#CCCCCC'><td>รหัส</td><td>Uername</td><td>ชื่อ</td><td>นามสกุล</td><td>อีเมล์</td><td>แก้ไข</td><td>ลบ</td></tr>";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td>" .$row["ID"] .  "</td> "; 
  echo "<td>" .$row["Order_date"] .  "</td> ";  
  echo "<td>" .$row["Email"] .  "</td> ";
  echo "<td>" .$row["Status"] .  "</td> ";
  echo "<td>" .$row["URL"] .  "</td> ";
  //แก้ไขข้อมูล
  echo "<td><a href='UserUpdateForm.php?ID=$row[0]'>edit</a></td> ";
  
  //ลบข้อมูล
  echo "<td><a href='UserDelete.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($con);


?>
