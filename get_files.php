<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "past_questions";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get department from the URL
$department = isset($_GET['department']) ? $_GET['department'] : '';

$sql = "SELECT file_name, file_path FROM files WHERE department = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

// Display the files
$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}
echo json_encode($files);
$stmt->close();
$conn->close();
?>
