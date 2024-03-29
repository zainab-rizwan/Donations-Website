<?php
require_once('db_connection.php');
include('auth.php');
?>

<?php
//Edit particulars
if (isset($_GET['edit'])) 
{
	$id = stripslashes($_GET['edit']);
    $id = mysqli_real_escape_string($conn, $id);

	$sql = "SELECT * FROM particulars WHERE particular_id=?";
	$stmt = $conn->prepare($sql); 
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$showModal = "true";
	while($res = mysqli_fetch_array($result))
	{
		$name = $res['particular_name'];
		$id = $res['particular_id'];
	}
}

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
<title>Particulars</title>
<style type="text/css">
	
	body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 15px;
	}

	/**********Navbar**********/
    ul 
    {
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

	/**********Table**********/
	.table-wrapper {
        background: #fff;
        padding: 15px 20px;
        margin: 25px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 10px;
		background: #435d7d;
		color: #fff;
		padding: 10px 23px;
		margin: -19px -23px 7px;
		border-radius: 3px 3px 0 0;
    }

	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		float: right;
		margin: 10px;
		font-size: 15px;
		border: none;
		height: 2.5em;
		text-align: center;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}

	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }

    /**********Search Filter**********/
    #search
    {
    	width: 99%;
    	padding: 1em;
    	margin-bottom: 1em;
    	border-style: 1px solid gray;
    }

    /**********Alerts**********/
    .alert
    {
    	display: flex;
    	background: white;
    	color: #435d7d;
    	padding-left: 1em;
    }

</style> 
  <body>
  	<!---------Navbar--------->
  	<ul>
  	  <li><a href="logout.php">Logout</a></li>
	  <li><a href="dashboard.php"><p><?php echo $_SESSION['username']; ?></p></a></li>
	</ul>

	<!---------Alerts--------->
  	<?php if (isset($_SESSION['message'])): ?>
	<div class="alert alert-<?=$_SESSION['msg_type']?>" >
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>

	<!---------Table--------->
  	<br>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Particulars</h2>

					</div>
					<div class="col-sm-6">
						<a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Particular</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="particulars">
            	<br>
            	<input type="text" placeholder="Search particular" id="search" onkeyup="search()">
            	<br>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Particular Title</th>
                        <th>Controls</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            $sql = "SELECT particular_id, particular_name FROM particulars ORDER BY particular_id";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){

                while ($row = mysqli_fetch_assoc($result)) 
                {
                	$particular_id=$row['particular_id'];
                	$particular_name=$row['particular_name'];
                    echo '<tr>';
                    echo '<td>'. $particular_id .'</td>';
                    echo '<td>'. $particular_name .'</td>';?>
                     <td>
                     <!---------Controls--------->
						 <a href="particulars.php?edit=<?php echo $particular_id;?>" name="edit" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" id="edit" title="Edit">&#xE254;</i></a>
                          <a href="crud_p.php?del=<?php echo $row['particular_id'];?>"  name="delete" class="del_btn" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" id="delete." title="Delete">&#xE872;</i></a>
                    </td>
                  <?php  echo '</tr>';
                }
            }?>

                                          
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add New Particular -->
	<div id="addModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="crud_p.php" method="post">
						<div class="modal-header">						
							<h4 class="modal-title">Add New Particular</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label>Particular Title</label>
								<input type="text" class="form-control" name="title" required>
						  		<input type="hidden" name="name" value="<?php echo $particular_name; ?>">
							</div>
								
						</div>

						<div class="modal-footer" >
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">							
							<input type="submit" name="create" class="btn btn-success" value="Add">
							
						</div>
					</form>
				</div>
			</div>
	</div>
	
		

	<!-- Edit Particular -->
	<div id="editModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="crud_p.php" method="post" name="update_user" >
						<div class="modal-header">						
							<h4 class="modal-title">Edit Particular</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label>Particular Title</label>
								<input type="text" class="form-control" name="name" required>
								<input type="hidden" class="form-control" name="id" value=<?php echo $id;?> required>
							</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" name="update" class="btn btn-info" value="Update">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>

</body>
<script>
/*********Search Filter*********/
function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("particulars");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }


}
</script>
<?php	
//Show modal		
	if(!empty($showModal)) {
		echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#editModal").modal("show");
			});
		</script>';
	} 
?>

</html>
