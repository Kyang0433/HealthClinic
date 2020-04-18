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
$sql = "USE jyoung32_1";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}

$Patient_fname = $_POST['Patient_fname'];
$Patient_lname = $_POST['Patient_lname'];
$Patient_DOB = $_POST['Patient_DOB'];
$Provider_fname = $_POST['Provider_fname'];
$Provider_lname = $_POST['Provider_lname'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


if ($Patient_fname and $Patient_lname and $Patient_DOB) {
	$sql = "SELECT Ssn FROM PATIENT
		WHERE Fname='$Patient_fname' AND Lname='$Patient_lname'
                	AND DOB='$Patient_DOB';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$Patient_Ssn = $row['Ssn'];
	}
}
else {
	$Patient_Ssn = "%";
}


if ($Provider_fname and $Provider_lname) {
	$sql = "SELECT Ssn FROM PROVIDER
		WHERE Fname='$Provider_fname' AND Lname='$Provider_lname';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$Provider_Ssn = $row['Ssn'];
	}
}
else {
	$Provider_Ssn = "%";
}


$sql = "SELECT Pa.Fname AS PaFN, Pa.Lname AS PaLN, Pr.Fname AS PrFN, Pr.Lname AS PrLN, A.Appt_date, A.Appt_time, A.Copayment, A.Reason_for_visit
	FROM PATIENT Pa, PROVIDER Pr, APPOINTMENT A
	WHERE Pa.Ssn=A.Patient_Ssn AND Pr.Ssn=A.Provider_Ssn
	      AND A.Patient_Ssn LIKE '$Patient_Ssn' AND A.Provider_Ssn LIKE '$Provider_Ssn'
	      AND A.Appt_date BETWEEN '$from_date' AND '$to_date';";

$result = $conn->query($sql);

if($result->num_rows > 0){

//if(TRUE){ 
?>

   <table class="table table-striped">
      <tr>
         <th>Patient first name</th>
         <th>Patient last name</th>
         <th>Provider first name</th>
	 <th>Provider last name</th>
	 <th>Appt. date</th>
	 <th>Appt. time</th>
	 <th>Copay</th>
	 <th>Reason for visit</th>
      </tr>

<?php
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['PaFN']?></td>
          <td><?php echo $row['PaLN']?></td>
          <td><?php echo $row['PrFN']?></td>
          <td><?php echo $row['PrLN']?></td>
          <td><?php echo $row['Appt_date']?></td>
          <td><?php echo $row['Appt_time']?></td>
          <td><?php echo $row['Copayment']?></td>
          <td><?php echo $row['Reason_for_visit']?></td>
      </tr>

<?php
}
}
else {
echo "No matching records found.<br>";
}
?>

    </table>

<?php
$conn->close();
?>  

<a href="welcome.html">Return to homepage</a>

</body>
</html>
