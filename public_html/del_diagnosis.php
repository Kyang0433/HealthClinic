<!DOCTYPE html>
<html>
<head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

	<?php
	require_once('db_setup.php');
	$sql = "USE jyoung32_1;";
	if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
	} else {
		echo "Error using  database: " . $conn->error;
	}
// Query:

	$Patient_fname = $_POST['Patient_fname'];
	$Patient_lname = $_POST['Patient_lname'];
	$Patient_DOB = $_POST['Patient_DOB'];

	$Condition_name = $_POST['Condition_name'];

$sql1 = "SELECT Ssn FROM PATIENT
	 WHERE Fname='$Patient_fname' AND Lname='$Patient_lname' AND DOB='$Patient_DOB';";


$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Patient_Ssn=$row['Ssn'];
	$sql = "DELETE FROM DIAGNOSIS
	WHERE Condition_name='$Condition_name' AND Patient_Ssn='$Patient_Ssn';";
	$result = $conn->query($sql);

	if ($result === TRUE) {
		echo "Matching records deleted.<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	} 
//$stmt = $conn->prepare("Select * from Students Where Username like ?");
//$stmt->bind_param("s", $username);
//$result = $stmt->execute();
//$result = $conn->query($sql);
	}
	else {
	    echo "Matching patient not found.<br>";
	}
	?>
	<a href="welcome.html">Return to homepage</a>
	<?php
	$conn->close();
	?>  

</body>
</html>
