<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);



function renderList($file) {

	 $returnObj = array();
	 $windows = array();
	 $manifests = array();
	 $lines = file($file);

	 foreach($lines as $key=>$line) {
	  $parts = explode("	",$line);
	  $m = new StdClass();
	  $m->manifestId = trim($parts[0]);
	  $m->provider = trim($parts[1]);
	  $manifests[] = $m;
	  // if this is the first or second, add it to the windows that appear by default
	  if($key<2) { 
	      $z = new StdClass();
	      $z->manifestId = $parts[0];
	      $z->thumbnailNavigationPosition = 'far-bottom';
	      $windows[] = $z;
	  }
	 }

	 
	 $returnObj['windows'] = $windows;
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
