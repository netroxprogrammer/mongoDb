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

$hidden=$_SESSION['hidden'];

$filter = ["hiddenValue" => "$hidden" ];
$options = [
		'projection' => ['hiddenValue'=> "" ,'level' => ""],
];

$query = new MongoDB\Driver\Query($filter, $options);

$corsur = $crud->checkLeveles($dblevels,$query);
foreach($corsur as $data ){
	//
    
	//var_dump($data);
	if($data->level=="1"){
		header("Location: level2.php");
	}
	
	

}


if(isset($_POST["submit"])){
	//header("Location: level2.php");
	if(isset($_POST['list3']) || !empty($_POST['list3'])){
		 $list= $_POST['list3'];
	  $document = ["list3" => "$list"  , "hiddenValue" => "$hidden"];
	  

	  $bulk = new MongoDB\Driver\BulkWrite;
	  $bulk->insert($document);
	  // add User WWelcome Page Information
	  $crud->addUserData($dblevel1, $bulk);
	  
	  $bulkk = new MongoDB\Driver\BulkWrite;
	  $level=["hiddenValue"=>"$hidden", "level"=>"1"];
	  $bulkk->insert($level);
	  $crud->addUserData($dblevels, $bulkk);
	  header("Location: level2.php");
	}
}
?>

<html>
<head>
<title>Level 1</title>
<link rel="stylesheet" type="text/css" href="css/formstyle.css" />
</head>
<body>
<div class="wrapper">
<br><br>
    <div class="container">
       <h3>Day 1</h3>    
        <form class="form" method="post">
        List 3 good things happen today?
            <input type="text" class="textbox"  placeholder="Enter Text" name="list3" required="required">
            
            <br><br>
           
            <input type="submit" class="btn" name="submit">
          
        </form>
    </div>
</div>

</body>
</html>