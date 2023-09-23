<?php

function sendVerificationEmail($email, $name) {
    require('../sendmail.php');

    $to = $email;
    $cc = "";
    $subject = "Welcome to join Our Team";
    $message = "
    <div style='width: 100%; background-color:#E5F6FF;padding:10px;border-radius:5px;'>
        <h3 style='color: #0A3B5F;text-align: center;'>Welcome ".$name." </h3>
        <h4 style='color: #0A3B5F; text-align: center;'>Just you need to wait a few times for the admin check your data and accept you</h4>
        <div style='text-align: center;'>
        <h4>Thank you so much</h4>
        </div>
    </div>
    ";

    sendEmailWithCC($to, $cc, $subject, $message);
}
function existingEmail($conn, $email)
{
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    if ($row) {
        return true;
    } else {
        return false;
    }
}

function addUser($conn, $data){

$name=$data['name'];
$email=$data['email'];
$hashedPassword=$data['hashedPassword'];
$blood_type=$data['blood_type'];
$gender=$data['gender'];
$isApproved = 0;
$isAdmin = 0;

$sql = "INSERT INTO users ( name, email, password, blood_type, gender, is_approved, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $hashedPassword, $blood_type, $gender,$isApproved,$isAdmin);

if (mysqli_stmt_execute($stmt)) {
echo "<script>alert('User added successfully.');</script>";
sendVerificationEmail($email,$name);
header('Location: ../../index.php');
} else {
echo "<script>alert('Error: " . mysqli_stmt_error($stmt) . "');</script>";
}


mysqli_stmt_close($stmt);



}

function uploadFileToCloudinary($cloudName, $apiKey, $apiSecret, $file)
{
    $uploadUrl = 'https://api.cloudinary.com/v1_1/' . $cloudName . '/image/upload';
    $timestamp = time();
    $signature = sha1('timestamp=' . $timestamp . $apiSecret);

    $postData = array(
        'file' => curl_file_create($file['tmp_name']),
        'api_key' => $apiKey,
        'timestamp' => $timestamp,
        'signature' => $signature
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uploadUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}


function isOnline($conn,$isOnline,$id){


    $sql = "UPDATE users SET last_login=? WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $isOnline, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Update Success";
    } else {
        echo "<script>alert('Error: " . mysqli_stmt_error($stmt) . "');</script>";
    }
    mysqli_stmt_close($stmt);

}




?>