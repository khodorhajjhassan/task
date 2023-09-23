<?php
include_once('../config.php');

session_start();

$id = $_SESSION['id'];
if(isset($_SESSION['id'])&& ($_SESSION['is_admin']==1))
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

$host = $_SERVER['HTTP_HOST'];
$jsonData = file_get_contents("http://$host/task/api/admin/viewNewUser.php");
$data = json_decode($jsonData, true);

$count= count($data)

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
    <title>Dashboard</title>
</head>
<body>
  <style>
    .notification {
      content:"";
      width: 20px;
      heigth:20px;
      background-color:red;
      border-radius:50%;
      position:absolute;
      top:1;
      left:15px;
      color:white;
      line-heigth:20px;
      text-align:center;

    }
  </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid container">
          <a class="navbar-brand fs-3" href="stats.php">Welcome <span class="text-primary"><?php echo $row['name']?></span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
             
             
            </ul>
            <div class="d-flex align-items-center gap-5">
                <h4 class="fs-4 font-weight-light"> <a class="nav-link  text-primary" aria-current="page" href="./allUsers.php">Users</a></h4>
                <div style="position:relative">
                  <a class="text-dark fs-4" href="newUsers.php"><i class="fa-solid fa-globe"></i></a>
                  <span class="notification"><?php echo $count ?></span>
                </div>
                <h4 class="fs-4 font-weight-light"> <a class="nav-link  text-danger" aria-current="page" href="../logout.php">logout</a></h4>

            </div>
            
          </div>
        </div>
      </nav>
      
</body>
</html>