<?php

class CRUD{
	public $manager;
	public $wc;
	public $rp;
	public function __construct(){
		 
		$this->configuration();

		 
	}
	
	
	public  function  configuration(){
		// Create Connection
		$this->manager =new \MongoDB\Driver\Manager();
			
		
		// Create Write Access
		$this->wc = new MongoDB\Driver\WriteConcern(
				// Guarantee that writes are acknowledged by a majority of our nodes
				MongoDB\Driver\WriteConcern::MAJORITY,
				// But only wait 1000ms because we have an application to run!
				1000
		);

		// Construct a read preference
		$this->rp = new MongoDB\Driver\ReadPreference(
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
		
	}
	
	/*
	 * Insert Into Database
	 */
	public  function Insert($bulkk){
		
		try {
			/* Specify the full namespace as the first argument, followed by the bulk
			 * write object and an optional write concern. MongoDB\Driver\WriteResult is
			 * returned on success; otherwise, an exception is thrown. */
			$result = $this->manager->executeBulkWrite("db.questionConnection", $bulkk, $this->wc);
			return true;
	      // var_dump($result);
		} catch (MongoDB\Driver\Exception\Exception $e) {
			echo $e->getMessage(), "\n";
		}
		return false;
	}
	/**
	 * @Login Databse
	 * 
	 */
	
	public function  login($query){
		$this->manager = new MongoDB\Driver\Manager();
		
		$cursor = $this->manager->executeQuery("db.questionConnection", $query, $this->rp);
		if($cursor!=null || !empty($cursor)){
		foreach($cursor as $document) {
			return 1;
			
		}
		
	}
	return -1;
	}
	
	/**
	 * Read From Database
	 */
	public  function readDatabase($query){

		try {
			/* Specify the full namespace as the first argument, followed by the query
			 * object and an optional read preference. MongoDB\Driver\Cursor is returned
			 * success; otherwise, an exception is thrown. */
			$cursor = $this->manager->executeQuery("db.questionConnection", $query, $this->rp);
		
			// Iterate over all matched documents
			foreach ($cursor as $document) {
				var_dump($document);
			}
		} catch (MongoDB\Driver\Exception\Exception $e) {
			echo $e->getMessage(), "\n";
		}
	}
	
	/**
	 * 
	 */
	
}

?>