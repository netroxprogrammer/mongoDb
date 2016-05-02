<?php 
include_once 'includes/header.php';
session_start();
$crud = new CRUD();
/*  $query = new MongoDB\Driver\Query([]);
 $crud->readDatabase($query);
*/
if(!isset($_SESSION['name']) && !isset($_SESSION['userName']) && !isset($_SESSION['hidden'])){
	header("Location: login.php?error=Please login");

}

?>

<html>
<head>
<title>Levels Complete</title>

</head>
<body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
   <a  href="logout.php" class="btn btn-primary btn-lg btn-block" > Logout </a>
     
</body>
</html>