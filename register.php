<?php
include 'configs/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phonenumber = $_POST["phonenumber"];
    $location = $_POST["location"];
    $yob = $_POST["yob"];
    $nextofkin_name = $_POST["nextofkin_name"];
    $nextofkin_phone = $_POST["nextofkin_phone"];
    $nextofkin_relationship = $_POST["nextofkin_relationship"];


   $insertPatient = "INSERT INTO patients (fname, lname, yob, pno, location) 
                     VALUES ('$firstname', '$lastname', '$yob' , '$phonenumber', '$location')";

    if ($conn->query($insertPatient) === TRUE) {
        $patient_id = $conn->insert_id;
        echo "Patient record inserted successfully. ID: " . $patient_id . "<br>";

        $insertNextofKin = "INSERT INTO nextofkin (p_id, names, pno, rel) 
                           VALUES ('$patient_id', '$nextofkin_name', '$nextofkin_phone', '$nextofkin_relationship')";
        if ($conn->query($insertNextofKin) === TRUE) {
            echo "Next of kin record inserted successfully.";
        } else {
            echo "Error inserting next of kin record: " . $conn->error;
        }
    } else {
        echo "Error inserting patient record: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>HRMS</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container-fluid">
        




    <!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
    />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Search Results</a>
    </nav>
    <div class="container-fluid">
        <div class="m-10">
            <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search by Name or Phone Number" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                $searchTerm = $_GET['search'];

                $servername = "your_server_name";
                $username = "your_username";
                $password = "your_password";
                $database = "patients_record";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT * FROM patients WHERE fname LIKE '%$searchTerm%' OR pno LIKE '%$searchTerm'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>Name</th><th>Phone Number</th></tr></thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["fname"] . ' ' . $row["lname"] . '</td>';
                        echo '<td>' . $row["pno"] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "No results found.";
                }

                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>

      <div class="m-10">
        <form method="post">
          <div class="form-group row">
            <label for="firstname" class="col-sm-2 col-form-label"
              >First Name</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="firstname"
                name="firstname"
                placeholder="First Name"
              />
            </div>
          </div>
          <div class="form-group row">
            <label for="lastname" class="col-sm-2 col-form-label"
              >Last Name</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="lastname"
                name="lastname" 
                placeholder="Last Name"
              />
            </div>
          </div>

          <div class="form-group row">
            <label for="phonenumber" class="col-sm-2 col-form-label"
              >Phone Number</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="phonenumber"
                name="phonenumber"
                placeholder="Phone Number"
              />
            </div>
          </div>
          <div class="form-group row">
             <label for="location" class="col-sm-2 col-form-label">Location</label>
             <div class="col-sm-10">
                <input
                type="text"
                class="form-control"
                id="location"
                name="location"
                placeholder="Location"
                />
            </div>
         </div>
         <div class="form-group row">
            <label for="yob" class="col-sm-2 col-form-label">Year of Birth</label>
            <div class="col-sm-10">
                <input
                type="text"
                class="form-control"
                id="yob"
                name="yob"
                placeholder="Year of Birth"
                />
            </div>
        </div>

          <!-- Next of kin -->
          <div class="form-group row">
            <label for="nextofkin-name" class="col-sm-2 col-form-label"
              >Next of Kin Name</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="nextofkin-name"
                name="nextofkin_name"
                placeholder="Next of kin name"
              />
            </div>
          </div>

          <div class="form-group row">
            <label for="nextofkin-pno" class="col-sm-2 col-form-label"
              >Next of Kin Phone Number</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="nextofkin-pno"
                name="nextofkin_phone"
                placeholder="Phone Number"
              />
            </div>
          </div>

          <div class="form-group row">
            <label for="nextofkin-rel" class="col-sm-2 col-form-label"
              >Relationship</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control"
                id="nextofkin-rel"
                name="nextofkin_relationship"
                placeholder="Relationship"
              />
            </div>
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>


    table to appear here kindly
  </body>
</html>


