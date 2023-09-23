<?php

require_once '../config.php';

$email=$_POST['email'];
$password=$_POST['password'];

$query = "SELECT * from users where email=?";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,'s',$email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

if ($row && password_verify($password, $row['password'])) {

if($row['is_admin']== 1){
    session_start();
    $_SESSION["id"]=$row['user_id'];
    $_SESSION["is_admin"]=$row['is_admin'];
    header('location:../admin/stats.php?msg=success');
}
else if ($row['is_admin']==0 && $row['is_approved']==0){
    header('location:../user/waiting.php');
}
else if ($row['is_admin']==0 && $row['is_approved']==1){
    session_start();
    $_SESSION['id']=$row['user_id'];
    $_SESSION["is_admin"]=$row['is_admin'];
    header('location:../user/user.php');
}
}
else {
    header('location:../index.php?msg=failed'."&email=" . urlencode($email));
}

