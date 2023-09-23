<?php 
include('../config.php');
include('./controller_register/functionRegister.php');

$data = [
    'name' => mysqli_real_escape_string($conn, $_POST['name']),
    'email' => mysqli_real_escape_string($conn, stripcslashes($_POST['email'])),
    'blood_type' => mysqli_real_escape_string($conn, $_POST['blood_type']),
    'gender' => mysqli_real_escape_string($conn, $_POST['gender']),
    'hashedPassword' => password_hash( mysqli_real_escape_string($conn, stripcslashes($_POST['password'])), PASSWORD_DEFAULT),
];

 if(existingEmail($conn,$data['email'])){
    header('location:register.php?msg=emailfailed'. 
    "&name=" . urlencode($data['name']) . 
    "&blood_type=" . urlencode($data['blood_type']) . 
    "&email=" . urlencode($data['email']) . 
    "&gender=" . urlencode($data['gender'])); 
}else
{
    addUser($conn,$data);
    header('location:../index.php?msg=register_success');

} 
$conn->close();

?>