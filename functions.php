<?php

include('functions/start.php');

include('functions/clean.php');

//Custon wp-admin logo
function my_custom_login_logo() {
  echo '<style type="text/css">
		        h1 a {
		          background-size: 227px 85px !important;
		          margin-bottom: 20px !important;
		          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
		    </style>';
}


function getCSVdata(){
	$row = 1;

      $csv = get_bloginfo('template_directory') . '/data/user-profiles.csv';
     

      if (($handle = fopen($csv, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);

          if ($row == 1) {
          	print_r($data);
          }

          if ($row != 1) {

            for ($c=0; $c < $num; $c++) {
                //echo $data[$c];
            }

            echo "<br/>";
          }

          $row++;
        }
        fclose($handle);
      }
}

function generateJSON(){
	//header('Content-type: application/json');
	// Set your CSV feed
	$feed = get_bloginfo('template_directory') . '/data/user-profiles.csv';
	// Arrays we'll use later
	$keys = array();
	$newArray = array();
	// Function to convert CSV into associative array
	function csvToArray($file, $delimiter) { 
	  if (($handle = fopen($file, 'r')) !== FALSE) { 
	    $i = 0; 
	    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 
	      for ($j = 0; $j < count($lineArray); $j++) { 
	        $arr[$i][$j] = $lineArray[$j]; 
	      } 
	      $i++; 
	    } 
	    fclose($handle); 
	  } 
	  return $arr; 
	} 
	// Do it
	$data = csvToArray($feed, ',');
	// Set number of elements (minus 1 because we shift off the first row)
	$count = count($data) - 1;
	  
	//Use first row for names  
	$labels = array_shift($data);  
	foreach ($labels as $label) {
	  $keys[] = $label;
	}
	// Add Ids, just in case we want them later
	$keys[] = 'id';
	for ($i = 0; $i < $count; $i++) {
	  $data[$i][] = $i;
	}
	  
	// Bring it all together
	for ($j = 0; $j < $count; $j++) {
	  $d = array_combine($keys, $data[$j]);
	  $newArray[$j] = $d;
	}

	$jsonfile = get_bloginfo('template_directory') . '/data/user-profiles.json';


	// Print it out as JSON
	$fp = fopen('wp-content/themes/csis/data/user-profiles.json', 'w');
	fwrite($fp, json_encode($newArray));
	fclose($fp);
 
}

function getProfileArray(){
	$json = get_bloginfo('template_directory') . '/data/user-profiles.json';
	$string = file_get_contents($json);
	$profiles = json_decode($string, true);

	return $profiles;
}

function renderProfileGrid($profiles){

 	foreach ($profiles as $profile) {
 		echo $profile['Owner'] . '<br>'; 
 	}

 	
}

function getSingleProfile($profiles,$id){
	//Loop here to generate single array 
 	return $profiles[$id]; 

}


function getFilterLists($profiles, $listname){

	//get all values/titles make funciton to retrieve ImpactAreas[], Expertise, etc
      $impactArr =  array();
      $expertiseArr =  array();
      $geoArr =  array();
      $affilArr = array();

      foreach(array_keys($profiles[0]) as $paramName){

 
        //get sub string util [ 

        if (strpos($paramName, '[') !== FALSE)
        {

          $name = explode("[", $paramName , 2);
          $first = $name[0];
 

          if($first!='')
          {
              //get value between [ ]
              preg_match('~\[(.*?)\]~', $paramName, $value);
              $value =  $value[0]; 
              $value = substr($value,1,-1);
   
              //Push value to appropriate array
              if($first == 'Impact Areas '){
                array_push($impactArr,$value);
              }
              elseif($first == 'Expertise '){
                array_push($expertiseArr,$value);
              }
              elseif($first == 'Geographic Interest '){
                array_push($geoArr,$value);
              }
              elseif($first == 'Primary Affiliation with the Center '){
                array_push($affilArr,$value);
              }
              else{

              }
   
          }
        }
      }
      if($listname == 'Impact') 
      	return $impactArr;
      elseif($listname == 'Affiliation') 
      	return $affilArr;
      elseif($listname == 'Expertise') 
      	return $expertiseArr;
      elseif($listname == 'Geographic') 
      	return $geoArr;
      else
      	return 0;
         

}




?>
