<?php


function renderList($file) {

	 $returnObj = array();
	 $returnObj["@context"] = "https://iiif.io/api/presentation/2/context.json";
	 $returnObj["@id"] = "https://etcpanel.princeton.edu/LTI/mirador2/collection.json",
	 $returnObj["@type"] = "sc:Collection",
	 $returnObj["label"] = "Lecture Images",
	 $returnObj["description"] = "A collection of lecture images",
	 $returnObj["manifests"] = array();
	 
	 $windowObjects = array();
	 $manifests = array();
	 $lines = file($file);

	 foreach($lines as $key=>$line) {
	  $parts = explode("	",$line);
	  $man = new StdClass();
	  $man["@type"] = "sc:Manifest";
	  $man["@id"] = trim($parts[0]);
	  //if(isset($parts[1])) { $man["label"] = trim($parts[1]); } else { $man["label"] = "";  }
	  
	  $returnObj["manifests"][] = $man;
	 
	  // if this is the first or second, add it to the windows that appear by default
	  /*
	  if($key<1) { 
	      $z = new StdClass();
	      $z->loadedManifest = trim($parts[0]);
	      $z->viewType = "ImageView";
	      $z->annotationLayer = false;
	      $z->annotationCreation = false;
	      $z->annotationState = "annoOff";
	      $z->slotAddress = "row1.column1";
	      $z->thumbnailNavigationPosition = 'far-bottom';
	      $windowObjects[] = $z;
	  }
	 }
	 */
	 
	 //$returnObj['windowObjects'] = $windowObjects;
	 //$returnObj['manifests'] = $manifests;

	return json_encode($returnObj);
}




/**********************************************/

if(!isset($_GET['code'])) {
  echo "url must include ?code=...";
}
else {
  $code = $_GET['code'];
  $file = "../course-manifest/{$code}.txt";

  if( file_exists ( $file ) ){
     header('Content-Type: application/json');
     echo renderList($file);
  }
}
