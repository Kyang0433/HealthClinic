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

session_start();

$Old_Fname = $_SESSION['Fname'];
$Old_Lname = $_SESSION['Lname'];
$Old_DOB = $_SESSION['DOB'];

$Fname = $_POST['Fname'];
$Mname = $_POST['Mname'];
$Lname = $_POST['Lname'];
$Ssn = $_POST['Ssn'];
$Phone = $_POST['Phone'];
$Address = $_POST['Address'];
$Email = $_POST['Email'];
$DOB = $_POST['DOB'];
$Insurance_provider = $_POST['Insurance_provider'];
$Provider_Ssn = $_POST['Provider_Ssn'];


$sql = "UPDATE PATIENT
	SET Fname='$Fname', Mname='$Mname', Lname='$Lname', Ssn='$Ssn',
	    Phone='$Phone', Address='$Address', Email='$Email', DOB='$DOB',
	    Insurance_provider='$Insurance_provider', Provider_Ssn='$Provider_Ssn'
	WHERE Fname='$Old_Fname' AND Lname='$Old_Lname' AND DOB='$Old_DOB';";

#$sql = "SELECT * FROM Students where Username like 'amai2';";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Record updated successfully<br>";
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
