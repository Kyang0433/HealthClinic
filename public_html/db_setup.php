<?php
$servername = "localhost";
$username = "jyoung32";
$password = "german=Ripen2brink";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$sql = "USE jyoung32_1;";
$result = $conn->query($sql);
/*
if ($result === TRUE) {
    echo "DB setup successful.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
*/
/*
$sql = "CREATE TABLE Students (
	id INT PRIMARY KEY,
	name VARCHAR(20),
	gpa DECIMAL(3, 2));";

$result = $conn->query($sql);
*/
/*
if ($result === TRUE) {
    echo "DB setup successful.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
*/

?>


