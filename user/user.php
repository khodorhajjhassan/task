<?php

include_once('../config.php');

session_start();

$id = $_SESSION['id'];
if(isset($_SESSION['id'])&& ($_SESSION['is_admin']==0)  )
{
    $query = "select * from users WHERE user_id = $id";
    $result = mysqli_query($conn, $query) or die("Selecting user profile failed");
    $row = mysqli_fetch_array($result);
    $_SESSION['name']=$row['name'];
    $_SESSION['user_id']=$row['user_id'];
}
else
{
  header('location:../index.php?msg=please_login');
    mysqli_close($conn);
}
if(isset($_GET['msg']) && ($_GET['msg']=="success")){
   
    $errorMessage = "Success Add Certificate !";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>User Profile</title>
    <style>
    </style>
</head>
<body>
<main>
    <div class="container mt-5 mb-5">
        <div class="col-12 w-100 p-3 d-flex justify-content-between align-items-center p-2 box-shadow border rounded border-warning bg-success">
            <h2 class="text-center text-white mb-0">Welcome <?php echo $row['name'] ?></h2>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" id="edit">Edit</button>
                <button  class="btn btn-danger"><a class="text-white text-decoration-none" href="../logout.php">Logout</a></button>
            </div>
        </div>
        <div class="jumbotron mt-4 bg-success rounded text-white p-5">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <label class="text-warning" for="">Full Name</label>
                    <p><?php echo $row['name'] ?></p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label class="text-warning" for="">Blood Type</label>
                    <p><?php echo $row['blood_type'] ?></p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label class="text-warning" for="">Gender</label>
                    <p><?php echo $row['gender'] ?></p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <button class="btn btn-warning text-white" id="addDegree">Add Degree</button>
                    <button class="btn btn-info text-white" id="showDegree">Show Degree</button>
                </div>
            </div>
            <span class="fs-4 text-warning" id="err"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
            <div id="addInput"></div>
            <div id="showInput"></div>
        </div>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>