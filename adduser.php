<?php
session_start();
error_reporting(0);
include('includes/config.php');

$stmt = $dbh->query("SELECT * FROM company");
while ($row = $stmt->fetch()) {
    $compeny_option .=  '<option value="'.$row['id'].'">'.$row['compeny_name'].'</option>';
}
// print_r($compeny_option );die;
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_POST['submit']))
  {	
	// $file = $_FILES['attachment']['name'];
	// $file_loc = $_FILES['attachment']['tmp_name'];
	// $folder="attachment/";
	// $new_file_name = strtolower($file);
	// $final_file=str_replace(' ','-',$new_file_name);
	
	$c_id=$_POST['c_id'];
	// echo $c_id;die;
	$name=$_POST['name'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
    $crole=$_POST['crole'];
    $gender=$_POST['gender'];
    $department=$_POST['department'];
    $status=$_POST['status'];
	$user=$_SESSION['alogin'];
	$reciver= 'Admin';
    $notitype='Send Feedback';
    $attachment=' ';

	// if(move_uploaded_file($file_loc,$folder.$final_file))
	// 	{
	// 		$attachment=$final_file;
	// 	}
	// $notireciver = 'Admin';
    // $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    // $querynoti = $dbh->prepare($sqlnoti);
	// $querynoti-> bindParam(':notiuser', $user, PDO::PARAM_STR);
	// $querynoti-> bindParam(':notireciver', $notireciver, PDO::PARAM_STR);
    // $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
    // $querynoti->execute();
		
	$sql="insert into users_c (c_id, name, lname,email,mobile,crole,gender,department,status) 
	values (:c_id, :name,  :lname, :email, :mobile, :crole, :gender, :department, :status)";
	// $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	$query = $dbh->prepare($sql);
	
	$query-> bindParam(':c_id', $c_id, PDO::PARAM_STR);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':lname', $lname, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query-> bindParam(':crole', $crole, PDO::PARAM_STR);
	$query-> bindParam(':gender', $gender, PDO::PARAM_STR);
	$query-> bindParam(':department', $department, PDO::PARAM_STR);
	$query-> bindParam(':status', $status, PDO::PARAM_STR);
	
    $query->execute(); 
	// $error = $query->errorInfo();
	// print_r($error);die;
	// print_r($query->errorInfo());
	// echo '1';die;
	//   header('Content-Type: text/plain; charset=utf-8');
	//   print_r($compeny_name);die;
	$msg="User add";
}    
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Edit Profile</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<script type= "text/javascript" src="../vendor/countries.js"></script>
	<style>
	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
<?php
		$sql = "SELECT * from users;";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
                       
							<div class="col-md-12">
                            <h2>Add Castomer</h2>
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
    <input type="hidden" name="user" value="<?php echo htmlentities($result->email); ?>">
	

	<label class="col-sm-2 control-label">First name<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="name" value="1" class="form-control" required>
	</div>
	<label class="col-sm-2 control-label">Last name<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="lname" value="1" class="form-control" required>
	</div>
</div>

<div class="form-group">

<label class="col-sm-2 control-label">Compeny name<span style="color:red">*</span></label>
	<div class="col-sm-4">

	<select  name="c_id"  class="form-control">
		<?php echo $compeny_option; ?>
	</select>
	</div>
	
	<label class="col-sm-2 control-label">Company role<span style="color:red">*</span></label>
	<div class="col-sm-4">

	<select  name="crole"  class="form-control">
		<option value="Director">Director</option>
		<option value="Employee">Employee</option>
		<option value="secretary">secretary</option>

	</select>
	</div>
	
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Email</label>
	<div class="col-sm-4">
	<input type="text" name="email" value="1" class="form-control" >
	</div>

	<label class="col-sm-2 control-label">Phone<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="mobile"  value="1" class="form-control" required>
	</div>

	
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Department</label>
	<div class="col-sm-4">
	<input type="text" name="department" value="1" class="form-control" >
	</div>

	<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="status"  value="1" class="form-control" required>
	</div>

	
</div>
<div class="form-group">

	<label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
		<div class="col-sm-4">

		<select  name="gender"  class="form-control">
			<option value="Male">Male</option>
			<option value="Female">Female</option>

		</select>
		</div>
</div>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Add</button>
	</div>
</div>

</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>
</body>
</html>
<?php } ?>