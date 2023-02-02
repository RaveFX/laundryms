<?php
session_start();
$emailFromDB =  $_SESSION["user_id"];

$connection = new mysqli('localhost', 'root', '', 'laundry_db');
if(isset($_POST['send'])){
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $phone = mysqli_real_escape_string($connection, $_POST['phone']);
  $address = mysqli_real_escape_string($connection, $_POST['address']);

  if($name==null || $phone==null || $address==null )
  {
     echo '<script>alert("Fields cannot be empty");location.href="http://localhost:998/laundryms/profile.php";</script>';
  } else{
     $request = "UPDATE signup_form SET name =?,phone =?,address =? WHERE email =?";
     $stmt = $connection->prepare($request);
     $stmt->bind_param("ssss", $name, $phone, $address, $emailFromDB);
     if ($stmt->execute()) {
        $_POST = array();
        echo '<script>alert("Profile Updated Successfully.");location.href="http://localhost:998/laundryms/home.php";</script>';
     } else {
        echo "Error: " . $request . "<br>" . $connection->error;
        echo '<script>alert("Profile Update Failed.Please try Again");location.href="http://localhost:998/laundryms/profile.php";</script>';
     }
  }
}else{
  echo 'something went wrong please try again!';
}
?>
<html>
<link rel="stylesheet" href="css/style.css">
<center>
</center>
</html>