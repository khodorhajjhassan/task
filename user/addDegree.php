<?php
include_once('../config.php');



session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_SESSION['id']) )
    {
        
        $user_id=$_SESSION['id'];
        $certeficat=$_POST['certeficate'];
        $degreename=$_POST['degreename'];


        $query = 'INSERT INTO usercertificates (user_id, certificate_id, degree_name) VALUES (?,?,?)';
        $stmt=mysqli_prepare($conn,$query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'iis', $user_id, $certeficat, $degreename);
            if (mysqli_stmt_execute($stmt)) {
                header('location:user.php?msg=success');
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
      
      else
      {
        header('location:../index.php?msg=please_login');
          mysqli_close($conn);
      }



}
?>