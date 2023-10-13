<?php
include '/configs/config.php';

$query = "SELECT * FROM patients";

$result = mysqli_query($conn, $query);

$patients = array();

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $patients[] = $row;
  }
  echo json_encode($patients);
} else {
  echo json_encode(['message' => 'No patient records found.']);
}

mysqli_close($conn);
?>
