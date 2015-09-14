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

//Add ajax functionality to pages, all not just in admin
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}
add_action('wp_ajax_getSingleProfile', 'getSingleProfile');  
add_action('wp_ajax_nopriv_getSingleProfile', 'getSingleProfile');  //_nopriv_ allows access for both signed in users, and not
add_action('wp_ajax_saveGeneralEmail', 'saveGeneralEmail');  
add_action('wp_ajax_nopriv_saveGeneralEmail', 'saveGeneralEmail'); 
add_action('wp_ajax_saveProductEmail', 'saveProductEmail');  
add_action('wp_ajax_nopriv_saveProductEmail', 'saveProductEmail'); 
 

function generateJSON(){
	//header('Content-type: application/json');
	// Set your CSV feed
	$feed = get_bloginfo('template_directory') . '/data/user-profiles-test.csv';
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

function writeLatLong($profiles){
  $count = 0;

  foreach ($profiles as $profile){
     
      if($profile['Lat'] == ''){
        $address = $profile['City'] . ' ' . $profile["State (USA only)"] . ' ' . $profile["Country"];
         $loc = geocode($address);
         $profiles[$count]['Lat'] = $loc[0];
         $profiles[$count]['Lng'] = $loc[1];
         
      }
      $count++;
    
  }
  print_r($profiles);
  file_put_contents('wp-content/themes/csis/data/user-profiles.json', json_encode($profiles));
}

// function to geocode address, it will return false if unable to geocode address
function geocode($address){
 
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }else{
        return false;
    }
}




function renderProfileGrid($profiles){

  $count = 0;
 
 	foreach ($profiles as $profile) {
      $year = array();
      //Get Filter Data
      $impact = getSingleProfileFilterData($profiles, $count,'Impact');
      $expertise = getSingleProfileFilterData($profiles, $count,'Expertise');
      $geographic = getSingleProfileFilterData($profiles, $count,'Geographic');
      $affil = getSingleProfileFilterData($profiles, $count,'Affiliation');
      $year[0] = $profile['What year did you participate in your first CSIS program?'];
      $filters = array_merge($impact, $expertise, $geographic, $affil, $year);
      
      $filter_string = '';
      foreach ($filters as $filter) {
        $filter = str_replace(" ", "-", $filter);
        $filter = str_replace("&", "", $filter);
        $filter_string .= $filter . ' ';
      }


     $output  = '<div class="mix three columns '.$filter_string.'" data-id="'.$count.'" >';
     $output .=    '<div class="network-grid-item " style="background-image: url(http:'.$profile['Profile Picture'] .' ); " >';
     $output .=       '<div class="hover-info">';
     $output .=          '<span class="name">'. $profile['Name | First'] .' '.$profile['Name | Last'] .'</span>';
     $output .=          '<span class="title">'. $profile['Title'] .', '. $profile['Current Organization / School'] .'</span>';
     $output .=          '<span class="location">'. $profile['City'] .', '. $profile['State (USA only)'] .'</span>';
     $output .=        '</div>';
     $output .=    '</div>';
     $output .= '</div>';

     echo $output;
     $count++;

 	}

  return 0;

 	
}

function renderHomeProfileGrid(){
  $profiles = getProfileArray();
  $count = 0;

  $rand_items = array_rand($profiles, 8);
  //print_r($rand_items);
  for($count = 0; $count < 8; $count++) {
     $id = $rand_items[$count];
     $output  = '<div class="three columns " data-id="'.$id.'" >';
     $output .=    '<a class="no-opacity" href="'.get_bloginfo('url').'/global-network"><div class="network-grid-item " style="background-image: url(http:'.$profiles[$id]['Profile Picture'] .' ); " >';
    // $output .=       '<div class="hover-info">';
    // $output .=          '<span class="name">'. $profiles[$id]['Name | First'] .' '.$profiles[$id]['Name | Last'] .'</span>';
    // $output .=          '<span class="title">'. $profiles[$id]['Title'] .', '. $profiles[$id]['Current Organization / School'] .'</span>';
    // $output .=          '<span class="location">'. $profiles[$id]['City'] .', '. $profiles[$id]['State (USA only)'] .'</span>';
    // $output .=        '</div>';
     $output .=    '</div></a>';
     $output .= '</div>';

     echo $output;
   

  }

  return 0;

  
}

function getSingleProfile(){

  $id = $_POST['profile_id'];

  $profiles = getProfileArray();
  $profile = $profiles[$id];

  
  $output = '';
 	$output .= '<div class="three columns offset-by-two"><img src="'.$profile['Profile Picture']. '" /></div>';
  $output .= '<div class="five columns" ><div class="profile-info">';

  $output .=    '<h3>'.$profile['Name | First']. ' ' . $profile['Name | Last']. '</h3>';
  if($profile['Title'] != ''){
    $output .=    '<span class="title">'. $profile['Title'];
  }
  if($profile['Current Organization / School'] != ''){
    $output .=    ', '. $profile['Current Organization / School'] .'</span>';
  }
  $output .=    '<span class="location">'. $profile['City'] .', '. $profile['State (USA only)'] .'</span>';

  $bio = htmlentities($profile['Short Bio']);
  $output .=    '<p>'. $bio. '</p>';

  if($profile['Action Statement | I am '] != ''){
    $output .=    '<span class="green-primary">I am: </span>' . $profile['Action Statement | I am '] . '<br/>';
    $output .=    '<span class="green-primary">to: </span>' . $profile['Action Statement | to'] . '<br/>';
    $output .=    '<span class="green-primary">in order to: </span>' . $profile['Action Statement | in order to'] . '<br/><br/>';
  }

  if($profile['Ask me about:'] != ''){

    $output .=    '<span class="green-primary">Ask me about: </span>' . $profile['Ask me about:'] . '<br/><br/>';
  }

  if($profile['I am looking for:'] != ''){
    $output .=    '<span class="green-primary">I am looking for: </span>' . $profile['I am looking for:'] . '<br/><br/>';
  }

  if($profile['If you have a link to a pitch video, please copy it here:'] != ''){
    $url = $profile['If you have a link to a pitch video, please copy it here:'];
    parse_str( parse_url( $url, PHP_URL_QUERY ), $vars );
    $video_id =  $vars['v'];  

    $output .=    '<p><iframe width="640" height="360" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe></p>';
  }

  $output .=  '<div class="footer-social ">';
  $output .=  '<ul>';
  
  if($profile['Social Media Links | Facebook'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | Facebook']  .' target="_blank"><i class="fa fa-facebook"></i></a></li>';
  }
  if($profile['Social Media Links | Twitter'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | Twitter']  .' target="_blank"><i class="fa fa-twitter"></i></a></li>';
  }
  if($profile['Social Media Links | Instagram'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | Instagram']  .' target="_blank"><i class="fa fa-instagram"></i></a></li>';
  }
  if($profile['Social Media Links | LinkedIn'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | LinkedIn']  .' target="_blank"><i class="fa fa-linkedin"></i></a></li>';
  }
  $output .=  '</ul></div>';
        

  $output .= '</div></div>'; 
  echo $output;

  die();

}

function getSingleProfileFilterData($profiles, $id, $listname){

  //get all values/titles make funciton to retrieve ImpactAreas[], Expertise, etc
      $impactArr =  array();
      $expertiseArr =  array();
      $geoArr =  array();
      $affilArr = array();
      

      foreach ($profiles[$id] as $key => $data) {
 
        //get sub string util [ 
        if (strpos($key, '[') !== FALSE)
        {
          $name = explode("[", $key , 2);
          $first = $name[0];

          if($first!='')
          {

            if($data == '1')
            {
              //get value between [ ]
              preg_match('~\[(.*?)\]~', $key, $value);
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
              elseif($first == 'Year '){
                array_push($yearArr,$value);
              }
              else{

              }
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

              if(strpos($value,"Other,") !== 0)
              { 
   
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

function saveGeneralEmail(){

  $email = $_POST['email'];
  $to = 'joshdodd@meshfresh.com';
  $subject = 'New Email List Signup';
  $body = $email . ' has signed up to the <strong>General Email List</strong>. Please add the email address to the appropriate list.';
  $headers = array('Content-Type: text/html; charset=UTF-8');

  wp_mail( $to, $subject, $body, $headers );

  $output = "Thank you for signing up. You have been added to our mailing list!";
  echo $output;

  die();


}

function saveProductEmail(){

  $email = $_POST['email'];
  $first = $_POST['firstname'];
  $last = $_POST['lastname'];
  $product = $_POST['pagename'];
 
  $to = 'joshdodd@meshfresh.com';
  $subject = 'New Product Email List Signup';
  $body = $first . ' ' . $last . ', ' . $email . ', has signed up to the '. $product.' list for more information. Please add the email address to the appropriate list.';
  $headers = array('Content-Type: text/html; charset=UTF-8');

  wp_mail( $to, $subject, $body, $headers );

  $output = "Thank you for signing up. You have been added to our mailing list!";
  echo $output;

  die();


}






?>
