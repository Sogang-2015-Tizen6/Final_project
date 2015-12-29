<?php
$servername = "localhost";
$username = "cs20121581";
$password = "qwer1234";
$dbname = "db_20121581";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$q = $_REQUEST["q"];

$sql = "SELECT name, count FROM Issue_DB WHERE nation = '$q'";
$result = $conn->query($sql);

$data = array();

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
