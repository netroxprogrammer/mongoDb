<?php
$filter = ["name" => "abdullah" , "pass"=>"12345"];
$options = [
   'projection' => ['name' => "","email"=>"",'userName'=>"","","pass"=>""],
];

$query = new MongoDB\Driver\Query($filter, $options);



?>