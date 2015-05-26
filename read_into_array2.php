<html>
<head>
	<title>Read File</title>
	<meta http-equiv="content-type"content="text/html;charset=utf-8" />
</head>

<body>
<?php
// define variables and set to empty values
$arr_length = 0;
$outData = array();
$year = array();
$xYear = 0;
$name = "";
$beginDate = '';
$endDate = '';
$filename = "";
$tmpData = "";
$fp = "";
$aryName = 0;
$aryBegin = 1;
$aryEnd = 2;
$maxYear = "";
$maxCount = 0;

// initialize $year array
	for($xYear = 0; $xYear <=  100; $xYear++) {
		$year[$xYear] = 0;
	//	print_r($year);
	}

// read file into array 1 line at a time
$row = 1;
$filename = "problem1_workfile.txt";
$fp = fopen($filename, 'r'); 
while (($outData = fgetcsv($fp, filesize($filename)))!== FALSE) {
	$arr_length = count($outData);
	$name = $outData[$aryName];
	$beginDate = $outData[$aryBegin];
	$endDate = $outData[$aryEnd];
	echo "Line " . $row . " is " . $name . "," . $beginDate . "," . $endDate . "<br />\n";

	// increment the counter by 1 for each year the person is living
	// $year[] keeps track of how many people are alive during that year
	for ($x=$beginDate - 1900; $x <= $endDate - 1900; $x++) {
		$year[$x]++;
	}
	
	$row++;
}
fclose($fp);

// read through the $year array to find what year(s) the most people are living
echo "<br />\n";
for ($x=0; $x <= 100; $x++) {
	echo $x+1900 . " count: " . $year[$x] . "<br />\n";
	If ($year[$x] > $maxCount) {
		$maxYear = $x + 1900;
		$maxCount = $year[$x];
	}	
}
echo "<br />\n";
echo "The years with the most people living, with a count of " . $maxCount . " are: <br />\n";
for ($x=0; $x <= 100; $x++) {
	if ($year[$x] == $maxCount) {
		echo $x + 1900 . "<br />\n";
	}
}

?>

