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
$Fname = $_POST['Fname'];
$Mname = $_POST['Mname'];
$Lname = $_POST['Lname'];
$Title = $_POST['Title'];
$Ssn = $_POST['Ssn'];
$Phone = $_POST['Phone'];
$Email = $_POST['Email'];
$Salary = $_POST['Salary'];

$sql = "INSERT INTO PROVIDER VALUES ('$Fname', '$Mname', '$Lname', '$Title',
				    '$Ssn', '$Phone', '$Email', '$Salary');";



$result = $conn->query($sql);

if ($result === TRUE) {
    echo "New record created successfully<br>";
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
