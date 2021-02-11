<?php

  	$pathsPath = realpath('../../app/Config/Paths.php');
	// ^^^ Change this if you move your application folder

	/*
	 *---------------------------------------------------------------
	 * BOOTSTRAP THE APPLICATION
	 *---------------------------------------------------------------
	 * This process sets up the path constants, loads and registers
	 * our autoloader, along with Composer's, loads our constants
	 * and fires up an environment-specific bootstrapping.
	*/

	//Ensure the current directory is pointing to the front controller's directory
  	//chdir(DIR);

	// Load our paths config file
  	//require $pathsPath;
  	$paths = new Config\Paths();

	// Location of the framework bootstrap file.
  	$app = require rtrim($paths->systemDirectory, '/ ') . '/bootstrap.php';

	/*
	 *---------------------------------------------------------------
	 * LAUNCH THE APPLICATION
	 *---------------------------------------------------------------
	 * Now that everything is setup, it's time to actually fire
	 * up the engines and make this app do its thang.
	 */

    $db =  db_connect();

	define("DB_HOST",$db->hostname);        
	define("DB_USER", $db->username);    
	define("DB_PASSWORD",$db->password);    
	define("DB_NAME", $db->database);

	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	// Check connection
	if (mysqli_connect_errno()){
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = "SELECT * FROM payment_gateway WHERE identity='bitcoin'";
	$result = $con->query($sql);
	/**
	 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
	 *  Place values from your gourl.io signup page
	 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional), etc...");
	 */
	$cryptobox_private_keys = array();

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$pri_key = unserialize($row['private_key']);
	    	foreach ($pri_key as $key => $value) { 
				if ($value) {
					array_push($cryptobox_private_keys, $value);
				}
			}

	    }
	} else {
	    echo "0 results";

	}

	define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
	unset($cryptobox_private_keys); 
?>