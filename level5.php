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
	if($data->level=="5"){
		header("Location: complete.php?message= You have complete Levels");
	}

}

if(isset($_POST["submit"])){
	//header("Location: level7.php");
	if(isset($_POST['active']) || !empty($_POST['active'])
	   && isset($_POST['who']) || !empty($_POST['who'])	
       && isset($_POST['what']) || !empty($_POST['what'])
       && isset($_POST['where']) || !empty($_POST['where'])
       && isset($_POST['when']) || !empty($_POST['when'])
	   && isset($_POST['Consequence']) || !empty($_POST['Consequence'])
	   && isset($_POST['feel']) || !empty($_POST['feel'])
	   && isset($_POST['do']) || !empty($_POST['do'])
	    && isset($_POST['selectactive']) || !empty($_POST['selectactive'])
			&& isset($_POST['selectwho']) || !empty($_POST['selectwho'])
			&& isset($_POST['selectwhat']) || !empty($_POST['selectwhat'])
			&& isset($_POST['selectwhere']) || !empty($_POST['selectwhere'])
			&& isset($_POST['selectwhen']) || !empty($_POST['selectwhen'])
			&& isset($_POST['selectConsequence']) || !empty($_POST['selectConsequence'])
			&& isset($_POST['selectfeel']) || !empty($_POST['selectfeel'])
			&& isset($_POST['selectdo']) || !empty($_POST['selectdo'])){
		$active = $_POST['active'];
		$who = $_POST['who'];
		$what = $_POST['what'];
		$where=$_POST['where'];
		$when= $_POST['when'];
		$conse= $_POST['Consequence'];
		$feel= $_POST['feel'];
		$do = $_POST['do'];
		$selectactive =$_POST['selectactive'];
		$selectwho= $_POST['selectwho'];
		$selectwhat =$_POST['selectwhat'];
		$selectwhere =$_POST['selectwhere'];
		$selectwhen= $_POST['selectwhen'];
		$selectConsequence=$_POST['selectConsequence'];
		$selectfeel=$_POST['selectfeel'];
		$selectdo=$_POST['selectdo'];
		
		
		
		
		$document = ["active" => "$active" ,"who"=>"$who" ,"what"=>"$what" ,
				"where" =>"$where", "when"=>"$when" , "Consequence"=> "$conse","feel"=>"$feel","do"=>"$do" 
				,"selectactive"=>"$selectactive",  "selectwho"=>"$selectwho" ,"selectwhat"=>"$selectwhat" ,"selectwhere"=>"$selectwhere",
				"selectwhen"=>"$selectwhen","selectConsequence"=>"$selectConsequence","selectfeel"=>"$selectfeel",
				"selectdo"=>"$selectdo","hiddenValue" => "$hidden"];
			
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		// add User WWelcome Page Information
		$crud->addUserData($dblevel5, $bulk);
			
		$bulkk = new MongoDB\Driver\BulkWrite;
		$level=["hiddenValue"=>"$hidden", "level"=>"5"];
		$bulkk->insert($level);
		$crud->addUserData($dblevels, $bulkk);
		header("Location: level5.php?message= You have complete Levels");
		
	}
		
}


?>


<html>
<head>

<link rel="stylesheet" type="text/css" href="css/level55.css" />
<title>Level 5</title>
</head>

<body>
<div class="wrapper">
    <div class="container">
        <h2>Level 5: Seeing Clearly</h2>       
        <form class="form" method="post" >
        <h3>Day 1</h3>
        <p>Please write those situations that "gets to you" and how much on scale of <small>1-10</small></p>
            <input type="text" class="textbox"  name="active" placeholder="Activating Event?" required="required">
                      <select name="selectactive">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>
            
            <br>
            <input type="text"  class="textbox"  name="who" placeholder="Who?" required="required">
            <select  name="selectwho">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
            <br>
            <input type="text"   class="textbox" name="what" placeholder="What?" required="required">
            <select name="selectwhat">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
            <br>
            <input type="text"  class="textbox" name="where" placeholder="Where?" required="required">
            <select name="selectwhere">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
           <br>
             <input type="text"  class="textbox"  name="when" placeholder="When?" required="required">
             <select name="selectwhen">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
            <br>
             <input type="text"  class="textbox"   name="Consequence" placeholder="Consequence?" required="required">
             <select name="selectConsequence">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
            <br>
             <input type="text"  class="textbox"  name="feel" placeholder="What did you feel?" required="required">
             <select name="selectfeel">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            
            <br>
             <input type="text"  class="textbox"  name="do" placeholder="What did you do?" required="required">
             <select name="selectdo">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                      </select>

            <input type="submit" class="btn" name="submit" value="submit">
            <br><br>
        </form>
    </div>
</div>
</body>
</html>
