<!DOCTYPE html>
<html>
<head>

<style>
.indented {
  padding-left: 7px;
}
</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="form8.css">
<script src="form8.js"></script>

</head>
<body>

<?php
require_once('db_setup.php');
$sql = "USE jyoung32_1";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
session_start();
$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$DOB = $_POST['DOB'];

$_SESSION['Fname'] = $Fname;
$_SESSION['Lname'] = $Lname;
$_SESSION['DOB'] = $DOB;

$sql = "SELECT * FROM PATIENT
	WHERE Fname='$Fname' AND Lname='$Lname' AND DOB='$DOB';";

$result = $conn->query($sql);

if($result->num_rows > 0){
$row = $result->fetch_assoc();
$Ssn=$row['Ssn'];
$Mname=$row['Mname'];
$Phone=$row['Phone'];
$Address=$row['Address'];
$Email=$row['Email'];
$Insurance_provider=$row['Insurance_provider'];
$Provider_Ssn=$row['Provider_Ssn'];
$Ssn=$row['Ssn'];

?>
<div class="center">
<div class="form-style-8">
<h2> Update patient information</h2>
<form action="update_patient.php" method="post">
   First name:  <input value=<?php echo "$Fname"?> type="text" name="Fname"><br>
   Middle name:  <input type="text" value=<?php echo "$Mname"?> name="Mname"><br>
   Last name:  <input type="text" value=<?php echo "$Lname"?> name="Lname"><br>
   DOB (yyyy-mm-dd):  <input type="text" value=<?php echo "$DOB"?> name="DOB"><br>
   SSN:  <input type="text" value=<?php echo "$Ssn"?> name="Ssn"><br>
   Phone:  <input type="text" value=<?php echo "$Phone"?> name="Phone"><br>
   Email:  <input type="text" value=<?php echo "$Email"?> name="Email"><br>
   Address:  <input type="text" value=<?php echo "$Address"?> name="Address"><br>
   Insurance Co.:  <input type="text" value=<?php echo "$Insurance_provider"?> name="Insurance_provider"><br>
   Provider SSN:  <input type="text" value=<?php echo "$Provider_Ssn"?> name="Provider_Ssn"><br>
   <input type="submit"><br><br>
   <a href="welcome.html">Cancel</a>

</form>

</div>
</div>
<?php
}
else {
    echo "Matching record not found.";
}
$conn->close();
?>  

</body>
</html>
