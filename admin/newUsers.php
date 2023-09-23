<?php 
include_once('../config.php');

function sendVerificationEmail($email) {
    require('../sendmail.php');

    $to = $email;
    $cc = "test@gmail.com";
    $subject = "Accept to join Our Team";
    $message = "
    <div style='width: 100%; background-color:#E5F6FF;padding:10px;border-radius:5px;'>
        <h4 style='color: #0A3B5F; text-align: center;'>Enjoy !! You are now one of our Team</h4>
        <div style='text-align: center;'>
        <h4>Thank you so much</h4>
        </div>
    </div>
    ";

    sendEmailWithCC($to, $cc, $subject, $message);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['user_id'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userId = $_POST['user_id'];
    $email = $_POST['user_email'];

    $query = "UPDATE users SET is_approved=1 WHERE user_id=?";
    $stmt=mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,'s',$userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($stmt->execute()) {
    sendVerificationEmail($email);
    header('location:newUsers.php?msg=success');
    } else {
        $response['success'] = false;
        $response['message'] = 'User acceptance failed.';
    }

    $stmt->close();
    $conn->close();
} else {
    $response = array('success' => false, 'message' => 'Invalid request.');
}

if(isset($_GET['msg']) && ($_GET['msg']=="success")){
   
    $errorMessage = "User add successfuly !";
}


?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Approval</title>
</head>
<body>
<style>
    .icon {
        border: none;
        background-color: transparent;
        font-size: 20px;
        transition: all 0.4s;
    }
    .icon:hover {
        cursor: pointer;
        transform: scale(1.3);
        color: green;
    }
</style>
<?php include_once('./dashboard.php') ?>
<div class="container">
    <div>
        <h4 class="text-center text-success mt-4"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></h4></span>
        <table id="trip-table" class="table table-hover mt-5">
            <thead>
                <tr class="fs-6">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Blood Type</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = $_SERVER['HTTP_HOST'];
                $jsonData = file_get_contents("http://$host/task/api/admin/viewNewUser.php");
                $data = json_decode($jsonData, true);
                $i=1;
                if ($data) {

                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td>".$row['blood_type']."</td>";
                    echo "<td>".$row['gender']."  </td>";
                    echo '<td colspan=""><button name="user" data-toggle="tooltip" data-placement="right" title="accept user" data-userid="' . $row['user_id'] . '" data-email="' . $row['email'] . '" class="icon"><i class="fa-solid fa-circle-check"></i></button></td>';
                    echo "</tr>";
                    $i++;
                }
            }else {
          echo '<h5 class=" text-center text-danger mt-4">No New Users Registered</h5>';

            }
                ?>
            </tbody>
        </table>
    </div>
</div>

<form id="accept-user-form" method="POST" action="">
    <input type="hidden" id="user_id" name="user_id" value="">
    <input type="hidden" id="user_email" name="user_email" value="">
</form>


<script>
  const buttons = document.querySelectorAll('.icon');
const form = document.getElementById('accept-user-form');
const userIdInput = document.getElementById('user_id');
const userEmailInput = document.getElementById('user_email');

buttons.forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.getAttribute('data-userid');
        const userEmail = this.getAttribute('data-email'); 
        userIdInput.value = userId;
        userEmailInput.value = userEmail;
        form.submit();
    });
});

</script>
</body>
</html>
