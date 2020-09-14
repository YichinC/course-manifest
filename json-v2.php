<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);



function renderList($file) {

	 $returnObj = array();
	 $windowObjects = array();
	 $manifests = array();
	 $lines = file($file);

	 
	 foreach($lines as $key=>$line) {
	  $parts = explode("	",$line);
          $man = new StdClass();
	  $man->manifestUri = trim($parts[0]);
	  $man->location = trim($parts[1]);

	  $manifests[] = $man;
	  
	  
	  // if this is the first or second, add it to the windows that appear by default
	  if($key<1) { 
	      $z = new StdClass();
	      $z->loadedManifest = $parts[0];
	      $z->viewType = "ImageView";
	      $z->annotationLayer = false;
	      $z->annotationCreation = false;
	      $z->annotationState = "annoOff";
	      $z->slotAddress = "row1.column1";
	      $z->thumbnailNavigationPosition = 'far-bottom';
	      $windowObjects[] = $z;
	  }
	 }

	 
	 $returnObj['windowObjects'] = $windowObjects;
	 $returnObj['manifests'] = $manifests;

	return json_encode($returnObj);
}



if(isset($_GET['code'])) {
  $code = $_GET['code'];

  $file = "./{$code}.txt";

  if( file_exists ( $file ) ){

     header('Content-Type: application/json');
     echo renderList($file);
  }
}

else { 
 echo "?code=ART202-HLS202_S2020";
}
