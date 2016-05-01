<?php session_start(); ?>
<?php include_once 'includes/header.php';?>
<?php
$crud = new CRUD();



if(isset($_GET['error'])){?>
	<p class="bg-danger text-center"><?php echo $_GET['error'];?></p></center>
<?php }

if(isset($_SESSION['name']) && isset($_SESSION['userName']) && isset($_SESSION['hidden'])){
	header("Location: welcome.php?message=Your are already Login");

}
else{
//phpinfo();
if(isset($_POST['submit'])){

if(isset($_POST['name']) || !empty($_POST['name'])
		&& isset($_POST['email']) || !empty($_POST['email'])
		&& isset($_POST['username']) || !empty($_POST['username'])
		&& isset($_POST['password']) || !empty($_POST['password'])
		&& isset($_POST['cmfrmpassword']) || !empty($_POST['cmfrmpassword'])
		){
	
	$name =$_POST['name'];
	$email =$_POST['email'];
	$userName = $_POST['username'];
	$pass=$_POST['password'];
	$cfrmpass= $_POST['cmfrmpassword'];
	if($pass!=$cfrmpass){
		header("Location: signup.php?error=Password Not Match");
	} 
	else{
	$document = ["name" => "$name", "email"=>"$email" , "userName" => "$userName", "pass"=>"$pass" , "cofrmpass"=>"$cfrmpass" 
			, "hiddenValue" => "$email.$hiddenValue"];

	$bulk = new MongoDB\Driver\BulkWrite;
	$bulk->insert($document);
	$result=$crud->Insert($bulk);
	if($result){
		header("Location: login.php");
	}
	
	
/* 	$result=$crud->Insert($bulk);
	if($result){
		echo "Data Enter";
	} */
}


// Create a bulk write object and add our insert operation




}
}
?>

<html>
<head>
</head>
<body>
<br><br><br><br><br><br>
<div class="row">
<div class="col-xs-8 well  col-xs-offset-2">
<button type="button" class="btn btn-primary btn-lg btn-block">Register Now</button><br><br>
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="name"  required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" placeholder="username" required="required">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password" placeholder="Password" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="cmfrmpassword" placeholder="Confirm Password" required="required">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default"  name="submit">
    </div>
  </div>
</form>
</div>
 </div>
  

</body>
</html>
<?php } ?>


