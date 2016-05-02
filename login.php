<?php session_start(); ?>
<?php include_once 'includes/header.php';?>
<?php
$crud = new CRUD();

/* 
 $query = new MongoDB\Driver\Query([]);
$crud->readDatabase($query);  */
  
//phpinfo();

if(isset($_GET['error'])){?>
<br><br>
	<p class="bg-danger text-center"><?php echo $_GET['error'];?></p></center>
<?php } 

if(isset($_SESSION['name']) && isset($_SESSION['userName']) && isset($_SESSION['hidden']) ){
	header("Location: welcome.php?message=Your are already Login");
	
}
else{




// check submit button press 
if(isset($_POST['submit'])){

if(isset($_POST['username']) || !empty($_POST['username'])
		&& isset($_POST['password']) || !empty($_POST['password'])
		){

	$userName = $_POST['username'];
	$pass=$_POST['password'];

	$filter = ["userName" => "$userName" , "pass"=>"$pass"];
	$options = [
			'projection' => ['name' => "","email"=>"",'userName'=>"","","pass"=>"","hiddenValue"=> ""],
	];
	
	$query = new MongoDB\Driver\Query($filter, $options);
	
	$crud->login($query);
	
	
/* 	$result=$crud->Insert($bulk);
	if($result){
		echo "Data Enter";
	} */
}


// Create a bulk write object and add our insert operation





}
?>

<html>
<head>
</head>
<body>
<br><br><br><br><br><br><br><br>
<div class="row">
<div class="col-xs-8 well  col-xs-offset-2">
<button type="button" class="btn btn-primary btn-lg btn-block">Login</button><br><br>
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" placeholder="username"  required="required" >
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password" required="required">
    </div>
  </div>
  
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default"  name="submit">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="signup.php" class="btn btn-default">SignUp</a>
    </div>
  </div>
  
</form>
</div>
 </div>
  

</body>
</html>
<?php }?>

