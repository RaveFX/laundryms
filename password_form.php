

<?php
session_start();
$emailFromDB =  $_SESSION["user_id"];

// $servername = "localhost"; //use of hardcoded credentials 
// $username = "root";
// $password = "";
// $dbname = "laundry_db";

$servername = getenv("DB_SERVER");
$username = getenv("DB_USERNAME");
$password = getenv("DB_PASSWORD");
$dbname = getenv("DB_NAME");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM `signup_form` WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $emailFromDB);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $passwordFromDB = $row["password"];
} else {
  echo "0 results";
}

// $connection = new mysqli('localhost', 'root', '', 'laundry_db');
$connection = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
if(isset($_POST['send-pass'])){
  $currentPW = $_POST['curr_pass'];
  $newPW = $_POST['new_pass'];
  $reNewPW = $_POST['re_new_pass'];

  if(($passwordFromDB==$currentPW) && ($newPW==$reNewPW)) {
    $request = "UPDATE signup_form SET password = ? WHERE email = ?";
    $stmt = $connection->prepare($request);
    $stmt->bind_param("ss", $newPW, $emailFromDB);

    if ($stmt->execute()) {
      $_POST = array();
      echo '<script>alert("Password Updated Successfully.Please Login Again");location.href="http://localhost:998/laundryms/index.php";</script>';
    } else {
      echo "Error: " . $connection->error;
    }
  } else {
    echo '<script>alert("Please check your password");location.href="http://localhost:998/laundryms/password.php";</script>';
  }
} else {
  echo 'something went wrong please try again!';
}
?>
<html>
<link rel="stylesheet" href="css/style.css">
</html>


   