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
	if($data->level=="3"){
		header("Location: level5.php");
	}

}

if(isset($_POST["submit"])){
	if(isset($_POST['experiance']) || !empty($_POST['experiance'])
	   && isset($_POST['lovetime']) || !empty($_POST['lovetime'])
	   && isset($_POST['lovetime']) || !empty($_POST['likelove'])	
	   && isset($_POST['happen']) || !empty($_POST['happen'])
			){
		$experiacne = $_POST['experiance'];
		$lovetime = $_POST['lovetime'];
		$likelove = $_POST['lovetime'];
		$happen = $_POST['happen'];
		

		$document = ["upEvent" => "$experiacne" ,"copy"=>"$lovetime" ,"NCopy"=>"$likelove" , 
				"happen" =>"$happen", "hiddenValue" => "$hidden"];
			
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		// add User WWelcome Page Information
		$crud->addUserData($dblevel3, $bulk);
			
		$bulkk = new MongoDB\Driver\BulkWrite;
		$level=["hiddenValue"=>"$hidden", "level"=>"3"];
		$bulkk->insert($level);
		$crud->addUserData($dblevels, $bulkk);
		header("Location: level4.php");
		
		
		header("Location: level5.php?");
	}
}


?>

<html>
<head>

<link rel="stylesheet" type="text/css" href="css/level5.css" />
<title>Untitled Document</title>
</head>

<body>
<div class="wrapper">
    <div class="container">
        <h2>Level 3: Bonding</h2>       
        <form class="form" method="post">
        <h3>Day 1</h3>
        
        
        <label>Please Write you personal Expriences with indvidual(family/friend?</label>
            <input type="text" class="textbox"  name="experiance"  placeholder="Enter Text" required="required">
            
           <label>How much time do you spend with your love ones?</label>
            <input type="text" class="textbox"  name="lovetime" placeholder="Enter Text" required="required">
           
            <label>How much time would you like to spend with the love one?</label>
            <input type="text" class="textbox" name="likelove" placeholder="Enter Text" required="required">
            <label>What can you do to make it happen?</label>
            <input type="text" class="textbox" name="happen" placeholder="Enter Text" required="required">
            <input type="submit" class="btn" name="submit" value="Save">
        </form>
    </div>
</div>
</body>
</html>
