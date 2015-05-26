<html>
<head>
	<title>Living Calc</title>
	<meta http-equiv="content-type"content="text/html;charset=utf-8" />
</head>

<body>
<?php
// define variables and set to empty values
$nameErr = $birthErr = $endErr = $yearErr = "";
$name = $birthYear = $endYear = "";
$error = "";

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
function validYear($tmpYear){
    // check if date is formatted correctly
    if (!preg_match("/^[0-9]*$/",$tmpYear)) {
       $yearErr = "Invalid Year format";
	} elseif (strlen($tmpYear)!='4')  {
		$yearErr = "Must be 4 digits long";  
	} elseif ($tmpYear < 1900) {
		$yearErr = "Year must be >= 1900";
	} elseif ($tmpYear > 2000) {
		$yearErr = "Year must be <= 2000";
	} else {
		$yearErr = "";
	}
	return $yearErr;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
   }
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
	   $error = true;
     }
   
   if (empty($_POST["birthYear"])) {
     $birthErr = "Birth year is required";
   } else {
     $birthYear = test_input($_POST["birthYear"]);
	 $birthErr = validYear($birthYear);
	 if ($birthErr != "") {
		$error = true; 
	 }
   }
     
    if (empty($_POST["endYear"])) {
     $endErr = "End year is required";
	 $error = true;
   } else {
     $endYear = test_input($_POST["endYear"]);
	 $endErr = validYear($endYear);
	 if ($endErr != "") {
		 $error = true;
	 }
   }
 }
?>

<h2>Living Calc PHP Form</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Birth Year: <input type="text" name="birthYear">
   <span class="error">* <?php echo $birthErr;?></span>
   <br><br>
   End Year: <input type="text" name="endYear">
   <span class="error">* <?php echo $endErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name . " " . $birthYear . " " . $endYear;

if (!$error) {
	$output=$name . "," . $birthYear . "," . $endYear;
	file_put_contents("problem1_workfile.txt", $output . "\n", FILE_APPEND);
}

?>

</body>
</html>