<?php
      
    // $connection = new mysqli('localhost', 'root', '', 'laundry_db');
    // if(isset($_POST['send'])){
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $password=$_POST['password'];
    // $phone = $_POST['phone'];
    // $address = $_POST['address'];
    // $securityquestion = $_POST['securityquestion'];
    // $securityanswer = $_POST['securityanswer'];

    // if($name==null || $email==null || $password==null || $phone==null || $address==null || $securityquestion==null || $securityanswer==null)
    // {
    //    echo '<script>alert("Fields cannot be empty");location.href="http://localhost:998/laundryms/signup.php";</script>';
    // } else{
    // $request = " insert into signup_form(name, email, password, phone, address, securityquestion, securityanswer) values('$name','$email', '$password', '$phone','$address','$securityquestion','$securityanswer') ";
    //      //mysqli_query($connection, $request);
    //         if ($connection->query($request)) {
    //         //echo'hii';
    //         //echo'<script>alert("New record created successfully");</script>';
    //         $_POST = array();
    //         echo '<script>alert("Account Created Successfully.Please Login.");location.href="http://localhost:998/laundryms/index.php";</script>';

    //         } else {
    //             echo "Error: " . $request . "<br>" . $connection->error;
    //         }
    //      //header('location:book.php'); 
    //     }
    // }
    //     else{
    //     echo 'something went wrong please try again!';
    // }

    //corrected
    // $connection = new mysqli('localhost', 'root', '', 'laundry_db');
    

// if (isset($_POST['send'])) {
//   $name = $_POST['name'];
//   $email = $_POST['email'];
//   $password = $_POST['password'];
//   $phone = $_POST['phone'];
//   $address = $_POST['address'];
//   $securityquestion = $_POST['securityquestion'];
//   $securityanswer = $_POST['securityanswer'];

//   if ($name == null || $email == null || $password == null || $phone == null || $address == null || $securityquestion == null || $securityanswer == null) {
//     echo '<script>alert("Fields cannot be empty");location.href="http://localhost:998/laundryms/signup.php";</script>';
//   } else {
//     $stmt = $connection->prepare("INSERT INTO signup_form (name, email, password, phone, address, securityquestion, securityanswer) VALUES (?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("sssssss", $name, $email, $password, $phone, $address, $securityquestion, $securityanswer);

//     if ($stmt->execute()) {
//       $_POST = array();
//       echo '<script>alert("Account Created Successfully.Please Login.");location.href="http://localhost:998/laundryms/index.php";</script>';
//     } else {
//       echo "Error: " . $connection->error;
//     }
//   }
// } else {
//   echo 'something went wrong please try again!';
// }


// Establish database connection with PDO
$dsn = "mysql:host=localhost;dbname=laundry_db;charset=utf8mb4";
$username = "root";
$password = "";
$pdo = new PDO($dsn, $username, $password);

if(isset($_POST['send'])) {
    // Sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $securityquestion = filter_input(INPUT_POST, 'securityquestion', FILTER_SANITIZE_STRING);
    $securityanswer = filter_input(INPUT_POST, 'securityanswer', FILTER_SANITIZE_STRING);

    if(empty($name) || empty($email) || empty($password) || empty($phone) || empty($address) || empty($securityquestion) || empty($securityanswer)) {
        // Use htmlspecialchars to prevent XSS attacks
        $error_msg = "Fields cannot be empty";
        echo '<script>alert("' . htmlspecialchars($error_msg) . '");location.href="http://localhost/Laundry_Management_System/signup.php";</script>';
    } else {
        $stmt = $pdo->prepare("INSERT INTO signup_form(name, email, password, phone, address, securityquestion, securityanswer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $phone, $address, $securityquestion, $securityanswer]);

        if($stmt) {
            // Use htmlspecialchars to prevent XSS attacks
            $success_msg = "Account Created Successfully. Please Login.";
            echo '<script>alert("' . htmlspecialchars($success_msg) . '");location.href="http://localhost/Laundry_Management_System/index.php";</script>';
        } else {
            $error_msg = "Error: " . $stmt->errorInfo()[2];
            echo '<script>alert("' . htmlspecialchars($error_msg) . '");location.href="http://localhost/Laundry_Management_System/signup.php";</script>';
        }
    }
} else {
    echo 'Something went wrong. Please try again!';
}

?>


<link rel="stylesheet" href="css/style.css">
<center>
<h1> Account created successfully.</h1><br>
<div class="btn" onclick="location.href='http://localhost:998/laundryms/index.php';">Go to Login Page</div>
</center> 
