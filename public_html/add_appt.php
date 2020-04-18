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

$Appt_date = $_POST['Appt_date'];
$Appt_time = $_POST['Appt_time'];
$Provider_fname = $_POST['Provider_fname'];
$Provider_lname = $_POST['Provider_lname'];
$Patient_fname = $_POST['Patient_fname'];
$Patient_lname = $_POST['Patient_lname'];
$Patient_DOB = $_POST['Patient_DOB'];
$Reason_for_visit = $_POST['Reason_for_visit'];
$Copayment = $_POST['Copayment'];
//echo $Patient_DOB;

$sql = "SELECT Ssn FROM PROVIDER
	WHERE Fname='$Provider_fname' AND Lname='$Provider_lname';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Provider_Ssn=$row['Ssn'];
$sql = "SELECT Ssn FROM PATIENT
	WHERE Fname='$Patient_fname' AND Lname='$Patient_lname'
	      AND DOB='$Patient_DOB';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$Patient_Ssn=$row['Ssn'];


$sql = "INSERT INTO APPOINTMENT VALUES
	('$Reason_for_visit', '$Appt_time', '$Appt_date',
	 $Copayment, '$Provider_Ssn', '$Patient_Ssn');";

//echo $sql;
#$sql = "SELECT * FROM Students where Username like 'amai2';";

$result = $conn->query($sql);

if ($result === TRUE) {
    echo "New record created successfully";
} else {
    if (strpos($conn->error, "Duplicate") !== FALSE) {
        echo "Error: trying to insert duplicate information.<br>";
    }
    elseif (strpos($conn->error, "foreign") !== FALSE) {
        echo "Error: trying to reference information that does not exist.<br>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
} 

//$stmt = $conn->prepare("Select * from Students Where Username like ?");
//$stmt->bind_param("s", $username);
//$result = $stmt->execute();
//$result = $conn->query($sql);

?>

<a href="welcome.html">Return to homepage</a>

<?php
$conn->close();
?>  

</body>
</html>
