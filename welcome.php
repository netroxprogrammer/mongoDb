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
	if($data->level=="0"){
		header("Location: level1.php");
	}
	
}  
	
	
if(isset($_POST["submit"])){
	//header("Locatiion: level1.php");
	if(isset($_POST['decide']) || !empty($_POST['decide'])
	 && isset($_POST['thing1']) || !empty($_POST['thing1'])
	 && isset($_POST['thing2']) || !empty($_POST['thing2'])
	 && isset($_POST['thing3']) || !empty($_POST['thing3'])
	 && isset($_POST['constrain']) || !empty($_POST['constrain'])){
		
	  $decide = $_POST['decide'];
	  $thing1=$_POST['thing1'];
	  $thing2=$_POST['thing2'];
	  $thing3=$_POST['thing3'];
	  $constrain= $_POST['constrain'];
	  $hidden=$_SESSION['hidden'];
	  
	  $document = ["decide" => "$decide", "thing1"=>"$thing1" , "thing2" => "$thing2", "thing3"=>"$thing3" , "constrain"=>"$constrain"
	  		, "hiddenValue" => "$hidden"];
	  

	  $bulk = new MongoDB\Driver\BulkWrite;
	  $bulk->insert($document);
	  // add User WWelcome Page Information
	  $crud->addUserData($dbwelcome, $bulk);
	  
	  $bulkk = new MongoDB\Driver\BulkWrite;
	  $level=["hiddenValue"=>"$hidden", "level"=>"0"];
	  $bulkk->insert($level);
	  $crud->addUserData($dblevels, $bulkk);
	  header("Location: level1.php");
	  
	 }
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/level5.css" />
</head>
<body>
<div class="wrapper">
<br><br>
    <div class="container">
        <p>Welcome to ON The mind please Complete the following  the questionaire below</p>       
        <form class="form" method="post">
        1.Why have you decided to use this app?
            <input type="text" class="textbox" placeholder="Enter Text" name="decide" required="required">
            <br><br>
        2.what three things would like to get out of using this app?
            <input type="text" class="textbox" placeholder="Enter Text" required="required" name="thing1">
            <input type="text" class="textbox" placeholder="Enter Text" required="required" name="thing2">
            <input type="text" class="textbox" placeholder="Enter Text" required="required" name="thing3">
           
            <br><br>
            3.What time constraints do you forese and how can you plan around them?
            <input type="text" class="textbox" placeholder="Enter Text" required="required" name="constrain" >
            <br><br>
            <input type="submit" class="btn" name="submit" >
          
        </form>
    </div>
</div>

</body>
</html>
