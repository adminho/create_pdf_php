<?php
$row = 1;
if (($handle = fopen("customer.csv", "r")) !== FALSE) {
    //while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	while (($data = fgetcsv($handle)) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}

?>