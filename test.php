<?php 
// The document that we'll be working with
$document = ["hello" => "world"];
$manager =new \MongoDB\Driver\Manager();
// Construct a write concern
$wc = new MongoDB\Driver\WriteConcern(
		// Guarantee that writes are acknowledged by a majority of our nodes
		MongoDB\Driver\WriteConcern::MAJORITY,
		// But only wait 1000ms because we have an application to run!
		1000
);

// Construct a read preference
$rp = new MongoDB\Driver\ReadPreference(
		/* We prefer to read from a secondary, but are OK with reading from the
		 * primary if necessary (e.g. secondaries are offline) */
		MongoDB\Driver\ReadPreference::RP_SECONDARY_PREFERRED,
		// Specify some tag sets for our preferred nodes
		[
				// Prefer reading from our west coast datacenter in Iceland
				["country" => "iceland", "datacenter" => "west"],
				// Fall back to any datacenter in Iceland
				["country" => "iceland"],
				// If Iceland is offline, read from whatever is available
				[],
		]
);

$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($document);

try {
	/* Specify the full namespace as the first argument, followed by the bulk
	 * write object and an optional write concern. MongoDB\Driver\WriteResult is
	 * returned on success; otherwise, an exception is thrown. */
	$result = $manager->executeBulkWrite("db.collection", $bulk, $wc);
	var_dump($result);
} catch (MongoDB\Driver\Exception\Exception $e) {
	echo $e->getMessage(), "\n";
}

/* Construct a query with an empty filter (i.e. "select all") */
$query = new MongoDB\Driver\Query([]);

try {
	/* Specify the full namespace as the first argument, followed by the query
	 * object and an optional read preference. MongoDB\Driver\Cursor is returned
	 * success; otherwise, an exception is thrown. */
	$cursor = $manager->executeQuery("db.collection", $query, $rp);

	// Iterate over all matched documents
	foreach ($cursor as $document) {
		var_dump($document);
	}
} catch (MongoDB\Driver\Exception\Exception $e) {
	echo $e->getMessage(), "\n";
}

?>