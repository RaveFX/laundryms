


<?php
// session_start();
// // print_r($_SESSION["user_id"]);
//     $emailFromDB =  $_SESSION["user_id"];

//    //  $servername = "localhost";
//    //  $username = "root";
//    //  $password = "";
//    //  $dbname = "laundry_db";

// $servername = getenv("DB_SERVER");
// $username = getenv("DB_USERNAME");
// $password = getenv("DB_PASSWORD");
// $dbname = getenv("DB_NAME");
    
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//     }
    
//     $sql = "SELECT * FROM `signup_form` WHERE email='$emailFromDB'";
//     $result = $conn->query($sql);
    
//     if ($result->num_rows > 0) {
      
//        while($row = $result->fetch_assoc()) {          
//           $passwordFromDB = $row["password"];
//        }
//     } else {
//        echo "0 results";
//     }
    




//       //$connection = mysqli_connect('localhost','root','','book_db');
//       //$connection = new mysqli('localhost', 'root', '', 'laundry_db');
//       $connection = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));
//       if(isset($_POST['send-pass'])){
//         //  $currentPW = $_POST['curr_pass'];
//          $newPW = $_POST['new_pass'];
//          $reNewPW = $_POST['re_new_pass'];
         
//          if( $newPW==$reNewPW )
//          {
//             $request = "update signup_form set password ='$newPW' where email ='$emailFromDB'" ;
//             if ($connection->query($request)) {
//                $_POST = array();
//                echo '<script>alert("Password Updated Successfully.Please Login Again");location.href="http://localhost:998/laundryms/index.php";</script>';

//             } else {
//             echo "Error: " . $request . "<br>" . $connection->error;
//             }
            
//          } else{
//             echo '<script>alert("Please check your password");location.href="http://localhost:998/laundryms/password.php";</script>';
//         }
//       }else{
//          echo 'something went wrong please try again!';
//       }

session_start();
$emailFromDB =  $_SESSION["user_id"];

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

$connection = new mysqli($servername, $username, $password, $dbname);
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
<!-- <center>
<h1>Booking created successfully,sit back we'll contact you soon.</h1><br>
<div class="btn" onclick="location.href='http://localhost:998/laundryms/index.php';">Return To Home</div>
      
</center> -->
   </html> 