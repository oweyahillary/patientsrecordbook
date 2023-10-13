<?php
include '/configs/config.php';

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$dob = $data->dob;
$gender = $data->gender;
$serviceType = $data->serviceType;
$comments = $data->comments;

$insertQuery = "INSERT INTO patients (name, dob, gender, serviceType, comments) VALUES ('$name', '$dob', '$gender', '$serviceType', '$comments')";

if (mysqli_query($conn, $insertQuery)) {
  echo json_encode(['message' => 'Patient record inserted successfully.']);
} else {
  echo json_encode(['error' => 'Error inserting patient record: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
