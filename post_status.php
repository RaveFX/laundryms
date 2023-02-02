<?php
      $connection = new mysqli('localhost', 'root', '', 'laundry_db');
      if(isset($_POST['send_status'])){
         $statusType = htmlspecialchars($_POST['statusType']);
         $email = htmlspecialchars($_POST['email']);
         

         if($email==null and $statusType==null)
         {
            echo '<script>alert("Please Select");location.href="http://localhost:998/laundryms/admin-status.php";</script>';
         } else{
            $request = "UPDATE signup_form SET status = ? WHERE email = ?";
            $stmt = $connection->prepare($request);
            $stmt->bind_param("ss", $statusType, $email);

            if ($stmt->execute()) {
               $_POST = array();
               echo '<script>alert("Status Updated.");location.href="http://localhost:998/laundryms/dashboard.php";</script>';

            } else {
                echo '<script>alert("Profile Update Failed. Please try Again.");location.href="http://localhost:998/laundryms/admin-status.php";</script>';
            }
         }
      } else {
         echo '<script>alert("Something went wrong. Please try again.");location.href="http://localhost:998/laundryms/admin-status.php";</script>';

      }
      ?>

<html>
<link rel="stylesheet" href="css/style.css">
</html> 