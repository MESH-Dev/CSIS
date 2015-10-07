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
add_action( 'wp_ajax_nopriv_loadPosts', 'loadPosts' );
add_action( 'wp_ajax_loadPosts', 'loadPosts' );

function loadPosts() {
    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

    $query_vars['paged'] = $_POST['page'];

    $posts = new WP_Query( $query_vars );
    $GLOBALS['wp_query'] = $posts;

    if( ! $posts->have_posts() ) {
        get_template_part( 'content', 'none' );
    }
    else {
        while ( $posts->have_posts() ) {

            $posts->the_post();
            echo '
            <div class="six columns">

                <div class="blog-post blog-post-small">
                  <div class="blog-post-categories"> ';

                    $post_categories = wp_get_post_categories( get_the_id() );
                    $cats = array();
                    $link = get_permalink();

                    foreach($post_categories as $c){
                      $cat = get_category( $c );
                      $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                      echo $cat->name;
                    }

              echo '
                  </div>

                  <div class="thumbnail">';

                    // Must be inside a loop.

                    if ( has_post_thumbnail() ) {
                      the_post_thumbnail();
                    }


            echo '</div>

                  <h5><a href="'; echo get_permalink(); echo'">'; the_title();  echo '</a></h5>
                  <h6><span class="postdate">'; the_time('F j, Y'); echo '</span> | <span class="postauthor">'; the_author(); echo '</span></h6>';

                  the_excerpt();

             echo '<div class="social-icons">
                    <a href="https://twitter.com/home?status=I%20just%20read%20this%20article%3A%20' . $link  .'"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=I%20just%20read%20this%20article%3A%20'. $link  .'"><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-vimeo"></i></a>
                  </div>
                </div>

              </div> ';


        }
    }


    echo '</div><div id="loadmore-posts">';
    $args = array('next_text'  => __('Load More Posts'));
    echo paginate_links($args);
    echo '</div>';

    die();

}


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
  //print_r($profiles);
  file_put_contents('wp-content/themes/csis/data/user-profiles.json', json_encode($profiles));
}

function createImages($profiles){
  $count = 0;

  foreach ($profiles as $profile){

    //Get remote image location, filename and extension
    $url = $profile['Profile Picture'];
    $filename = basename($url);
    $ext = pathinfo($filename, PATHINFO_EXTENSION);


    $fname = $profile['Name | First'];
    $fname = preg_replace("/[^a-zA-Z0-9\s]/", "", $fname);
    $fname = str_replace(' ', '', $fname);


    $lname =  $profile['Name | Last'];
    $lname = preg_replace("/[^a-zA-Z0-9\s]/", "", $lname);
    $lname = str_replace(' ', '', $lname);


    $location = 'wp-content/themes/csis/data/img/'.$fname . '-' . $lname.'.' .$ext;

    if($url != '' && !(file_exists($location))){
      $imageString = file_get_contents($url);
      $fp = fopen($location, "w");
      fwrite($fp, $imageString);
      fclose($fp);
      $new_loc = get_bloginfo('template_directory') . '/data/img/'.$fname . '-' . $lname.'.' .$ext;
      $profiles[$count]['Profile Picture'] = $new_loc;
      createBWImage($location,$ext);

    }
    $count++;

  }
  //print_r($profiles);
  file_put_contents('wp-content/themes/csis/data/user-profiles.json', json_encode($profiles));
}

function createBWImage($filename,$ext){
  if($ext == 'jpg'){
    $im = imagecreatefromjpeg($filename);
    if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
    {
        echo 'Image converted to grayscale.';
        imagejpeg($im, $filename);
    }
    else
    {
        echo 'Conversion to grayscale failed.';
    }
    imagedestroy($im);
  }
  elseif($ext=='png'){
    $im = imagecreatefrompng($filename);
    if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
    {
        echo 'Image converted to grayscale.';
        imagepng($im, $filename);
    }
    else
    {
        echo 'Conversion to grayscale failed.';
    }
    imagedestroy($im);
  }
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

      $state = '';
      if($profile['State (USA only)']!=''){
        $state = ', '. $profile['State (USA only)'];
      }


     $output  = '<div class="mix three columns '.$filter_string.'" data-id="'.$count.'" >';
     $output .=    '<div class="network-grid-item " style="background-image: url('.$profile['Profile Picture'] .' ); " >';
     $output .=       '<div class="hover-info">';
     $output .=          '<span class="name">'. $profile['Name | First'] .' '.$profile['Name | Last'] .'</span>';
     $output .=          '<span class="title">'. $profile['Title'] .', '. $profile['Current Organization / School'] .'</span>';
     $output .=          '<span class="location">'. $profile['City'] . $state .'</span>';
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
     $output .=    '<a class="no-opacity" href="'.get_bloginfo('url').'/global-network"><div class="network-grid-item " style="background-image: url('.$profiles[$id]['Profile Picture'] .' ); " >';
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

  if($profile['Action Statement | I am'] != ''){
    $output .=    '<span class="green-primary">I am: </span>' . $profile['Action Statement | I am'] . '<br/>';
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
    $output .=    '<li><a href="'.$profile['Social Media Links | Facebook']  .'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
  }
  if($profile['Social Media Links | Twitter'] != ''){
    $output .=    '<li><a href="http://twitter.com/'.$profile['Social Media Links | Twitter']  .'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
  }
  if($profile['Social Media Links | Instagram'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | Instagram']  .'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
  }
  if($profile['Social Media Links | LinkedIn'] != ''){
    $output .=    '<li><a href="'.$profile['Social Media Links | LinkedIn']  .'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
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
  $to = 'robbie@meshfresh.com';
  $subject = 'New Email List Signup';
  $body = $email . ' has signed up to the <strong>General Email List</strong>. Please add the email address to the appropriate list.';
  $ip = $_POST['ip'];

  $headers = array('Content-Type: text/html; charset=UTF-8');

  wp_mail( $to, $subject, $body, $headers );

  updateEmailDatabase($email, $ip);

  $output = "Thank you for your interes in the Center. You have been added to our mailing list!";
  echo $output;

  die();


}

function saveProductEmail(){

  $email = $_POST['email'];
  $first = $_POST['firstname'];
  $last = $_POST['lastname'];
  $product = $_POST['pagename'];
  $ip = $_POST['ip'];

  $to = 'robbie@meshfresh.com';
  $subject = 'New Product Email List Signup';
  $body = $first . ' ' . $last . ', ' . $email . ', has signed up to the '. $product.' list for more information. Please add the email address to the appropriate list.';
  $headers = array('Content-Type: text/html; charset=UTF-8');

  wp_mail( $to, $subject, $body, $headers );

  updateEmailDatabase($email, $ip, $first, $last, $product);

  $output = "Thank you for signing up. You have been added to our mailing list!";
  echo $output;

  die();


}

function updateEmailDatabase( $email, $ip, $first = '', $last = '', $product = '' ) {

  global $wpdb;

  $wpdb->insert(
  	'leads',
  	array(
  		'email' => $email,
  		'firstname' => $first,
      'lastname' => $last,
      'ip' => $ip,
      'product' => $product
  	)
  );

}




?>
