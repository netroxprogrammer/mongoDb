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
	if($data->level=="2"){
		header("Location: level3.php");
	}
	

}


if(isset($_POST["submit"])){
	//header("Location: level3.php");
	if(isset($_POST["techniques"]) || !empty($_POST["techniques"]) 
	   && isset($_POST["upEvent"])  || !empty($_POST["upEvent"])
	   && isset($_POST["copy"])  || !empty($_POST["copy"])
	   && isset($_POST["NCopy"])  || !empty($_POST["NCopy"])){
		$s=$_POST["techniques"];
		$upEvent=$_POST["upEvent"];
		$copy=$_POST["copy"];
		$Ncopy=$_POST["NCopy"];
		
		$document = ["upEvent" => "$upEvent" ,"copy"=>"$copy" ,"NCopy"=>"$Ncopy" , "hiddenValue" => "$hidden"];
		 
		
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->insert($document);
		// add User WWelcome Page Information
		$crud->addUserData($dblevel2, $bulk);
		 
		$bulkk = new MongoDB\Driver\BulkWrite;
		$level=["hiddenValue"=>"$hidden", "level"=>"2"];
		$bulkk->insert($level);
		$crud->addUserData($dblevels, $bulkk);
		header("Location: level3.php");
		
	}
}

?>



<html>
<head>

<link rel="stylesheet" type="text/css" href="css/level2style.css" />
<title>Level 2</title>
</head>

<body>
<div class="wrapper">
    <div class="container">
    <h2>Level 2: Coping</h2>
    
    <div class="tableform">
     <h3>Day 1</h3>
                       <form class="form" method="post">
                         <table>
                              <tr>
                               <th>Problem Focused</th>
                               <th>Emotional Focused (Adaptive)</th>
                               <th>Emotional Focused (Maladaptive)</th>
                               </tr>
                               <tr> 
                                 <td> 
                                     Make Plans <input type="Checkbox" name="techniques[]" value="Make Plans">
                                 </td>
                                  <td> 
                                     Seeking social support(for emotional reason) <input type="Checkbox" name="techniques[]" value="Seeking social support(for emotional reason)">
                                  </td>
                                   <td> 
                                     Deny event has happend <input type="Checkbox" name="techniques[]" value="Deny event has happend">
                                   </td>
                                   </tr>
                                   <tr> 
                                 <td> 
                                     Seek out information <input type="Checkbox" name="techniques[]" value="Seek out information">
                                 </td>
                                  <td> 
                                     Positve reinterpretation <input type="Checkbox" name="techniques[]" value="Positve reinterpretation">
                                  </td>
                                   <td> 
                                     Disengage mentally <input type="Checkbox" name="techniques[]" value="Disengage mentally">
                                   </td>
                                   </tr>
                                   <tr> 
                                 <td> 
                                     Approach the stressor <input type="Checkbox" name="techniques[]" value="Approach the stressor">
                                 </td>
                                  <td> 
                                     Acceptance <input type="Checkbox" name="techniques[]" value="Acceptance">
                                  </td>
                                   <td> 
                                     Behaviorally disengage <input type="Checkbox" name="techniques[]" value=" Behaviorally disengage">
                                   </td>
                                   </tr>
                                   
                                   <tr> 
                                 <td> 
                                     Seek social support (for instrumental reasons) <input type="Checkbox" name="techniques[]" value="Seek social support (for instrumental reasons)">
                                 </td>
                                  <td> 
                                     Religion <input type="Checkbox" name="techniques[]" value=" Religion">
                                  </td>
                                   <td> 
                                     Substance use (food alchohol and drugs) <input type="Checkbox" name="techniques[]" value="Substance use (food alchohol and drugs)">
                                   </td>
                                   </tr>
                                   <tr> 
                                 <td> 
                                     supress competing activities <input type="Checkbox" name="techniques[]" value="supress competing activities">
                                 </td>
                                  <td> 
                                     Humor <input type="Checkbox" name="techniques[]" value=" Humor">
                                  </td>    
                                  <td></td>                             
                                  </tr>
                                  
                                  </tr>
                                   <tr>
                                   <td></td>
                                  <td> 
                                     Medication <input type="Checkbox" name="techniques[]" value="Medication">
                                  </td>
                                  <td></td>
                                   </tr>
                                   <tr>
                                   <td></td>
                                  <td> 
                                     Relaxation <input type="Checkbox" name="techniques[]" value="    Relaxation">
                                  </td>
                                  <td></td>
                                   </tr>
                                   <tr>
                                   <td></td>
                                  <td> 
                                     Exercise <input type="Checkbox" name="techniques[]" value="Exercise">
                                  </td>
                                  <td></td>
                                   </tr>
  
                               </table>
                              
                        
</div>
<hr>



<br>
<br>
<br>
<br>
<br>

<div >

        <form >
        <label>Upcoming Events</label>
            <input type="text"  class="textbox" name="upEvent" placeholder="Upcoming Events" required="required">
            <label>Usual Coping Techniques</label>
            <input type="text"  class="textbox" name="copy" placeholder="Usual Coping Techniques" required="required">
           <label>New Coping Techniques</label>
            <input type="text" class="textbox"  name="NCopy" placeholder="New Coping " required="required">
            <input type="submit" name="submit" class="btn" value="Save">
            <br><br>
          
        </form>
        </div>
    </div>
</div>
</body>
</html>
