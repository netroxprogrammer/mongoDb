<?php
$filter = ["name" => "abdullah" , "pass"=>"12345"];
$options = [
   'projection' => ['name' => "","email"=>"",'userName'=>"","","pass"=>""],
];

$query = new MongoDB\Driver\Query($filter, $options);

$manager = new MongoDB\Driver\Manager();
$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_SECONDARY_PREFERRED);
$cursor = $manager->executeQuery("db.questionConnection", $query, $readPreference);


foreach($cursor as $document) {
/*     $string = file_get_contents($document);
$json_a = json_decode($string, true); */
//var_dump($document);
echo $document->userName."<br>";

}


?>