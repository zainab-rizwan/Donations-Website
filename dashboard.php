<?php
require('db_connection.php');
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Dashboard</title>
<style type="text/css">
   html {
       height: 100%;
       width: 100%;
   }
   /******************Navbar******************/
   ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
  }

  li {
    float: right;
  }

  li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover:not(.active) {
    background-color: #ddd;
  }

  li a.active {
    color: white;
    background-color: #04AA6D;
  }

  /******************Main board******************/
   #container {
       background-color: black;
       padding: 3em;
       opacity: 0.7;
       width: 0 auto;
       margin: 10%;
       margin-bottom: 5%;
       margin-top: 5%;
       text-align: center;
   }

   h3 {
       text-align: center;
       vertical-align: middle;
       line-height: 3rem;
       height: 3rem;
       color: white;
   }

   p
   {
    color: white;
    font-size: 15px;
   }

   
   td
   {
    text-align: left;
   }

   /******************Table******************/
   .container
   {
    padding:5%;
    margin-top: -1em;
   }



</style>
</head>
<body>
  <!---------Navbar-------->
  <ul>
      <li><a href="logout.php">Logout</a></li>
    <li><a href="dashboard.php"><?php echo $_SESSION['username']; ?></a></li>
  </ul>

  <!---------Main Board-------->
  <div id="container">
    <h3>Admin Access</h3>
        <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
        <p><a href="batch_fund.php">Batch Funds</a></p>
        <p><a href="particulars.php">Particulars</a></p>
        <p><a href="registration.php">Register User</a></p>
  </div>

  <!---------Table-------->
  <h3 style="color: black;">Registered Users</h3>
  <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                  <table class="table table-hover table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql="SELECT id, username, email FROM admin ORDER BY id";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if(mysqli_num_rows($result) > 0){

                          while ($row = mysqli_fetch_assoc($result)) 
                          {
                            $id=$row['id'];
                            $name=$row['username'];
                            $email=$row['email'];
                              echo '<tr>';
                              echo '<td>'. $id .'</td>';
                              echo '<td>'. $name .'</td>';
                              echo '<td>'. $email .'</td>';
                              echo '</tr>';
                          }
                      }?>
                           
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
  </div>
<br>
</body>
</html>