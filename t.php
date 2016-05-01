<?php

include_once 'includes/header.php';
session_start();
$crud = new CRUD();
/*  $query = new MongoDB\Driver\Query([]);
$crud->readDatabase($query); 
 */


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
			echo $data->level;
	}

}
	/* $filter = ["hidden" => "$userName" , "pass"=>"$pass"];
	$options = [
			'projection' => ['name' => "","email"=>"",'userName'=> "","","pass"=>"","hiddenValue"=> ""],
	];
	
	$query = new MongoDB\Driver\Query($filter, $options);
	
	$crud->login($query);
	 */
	

?>
