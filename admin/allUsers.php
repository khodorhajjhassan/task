<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
        .icon{
            border:none;
            background-color:transparent;
            font-size: 20px;
            transition:all 0.4s;
        }
        .icon:hover{
           cursor:pointer;
           transform:scale(1.3);
           color:blue
        }

    </style>
   <?php include_once('./dashboard.php') ?>
   <div class="container">
   <div>
   <table id="trip-table" class="table table-hover mt-5 ">
      <thead>
        <tr class="fs-6">
          <th  scope="col">#</th>
          <th  scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Blood Type</th>
          <th scope="col">Gender</th>
          <th scope="col">Last Login Time</th>
          <th scope="col">Action</th>

          
        </tr>
      </thead>
      <tbody>
        <?php
           $host = $_SERVER['HTTP_HOST'];
           $jsonData = file_get_contents("http://$host/task/api/admin/viewUser.php");
           $data = json_decode($jsonData, true);
            $i=1;

            if($data){

            
              foreach ($data as $row) {
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['blood_type']."</td>";
                echo "<td>".$row['gender']."</td>"; // Remove the extra </td> tag here
                echo "<td>".$row['last_login']."</td>";
                echo '<td colspan=""><a href="user_details.php?user_id=' . $row['user_id'] . '" data-toggle="tooltip" data-placement="right" title="View user details" class="icon"><i class="fa-solid fa-eye"></i></a></td>';
                echo "</tr>";
                $i++;
            }
            
        }else {
          echo '<h5 class=" text-center text-danger mt-4">No Users Found</h5>';
        }
        ?>
      </tbody>
    </table>
      </div>
   </div>
    
</body>
</html>