<?php


//Shortcodes

//::Button shortcodes for the 'new' version of product pages
//  really just 'new' styling, so these could be used elsewhere
function button_filter ($atts, $content = null){
	 $a = shortcode_atts( array(
	 	'type' => '',
        'src' => '#',
        'opens_in' => '',
        'color' => 'new-blue',
    ), $atts );

	$dir  = get_template_directory_uri(); 

	//var_dump($a["src"]);

	$opens_in = '';
	$type = '';
	$mod = '';
	$col = '';
	$src = '';
	
	if ($a['opens_in']=='new'){
		$ext='target="_blank"';
		$mod='';
	}elseif(($a['opens_in']=='lightbox')){
		$ext='';
		$mod = 'is_modal';
	}elseif(($a['opens_in']=='self')){
		$ext='target="_self"';
	}else{
		$ext='';
		$mod='';
	}

	if($a['color']=='red'){
		$col = 'new-red';
	}elseif($a['color']=='blue'){
		$col = 'new-blue';
	}elseif($a['color']=='purple'){
		$col = 'new-purple';
	}elseif($a['color']=='yellow'){
		$col = 'new-yellow';
	}

	// if($a['modal']==true){
	// 	$mod = 'is_modal';
	// }

	if($a['type']=='download'){
		//$icon = '<i class="fa fa-fw fa-graduation-cap fa-2x pull-left"></i>';
		$icon = '<img src="'.$dir.'/img/graduation-cap_icon.png">';
		$src = "href='".$a['src']."'";
	}elseif ($a['type']=='video' || $a['type']=='youtube' || $a['type']=='vimeo'){
		$icon = '<img src="'.$dir.'/img/video_icon.png">';
		$src = "href='#'";
	}elseif ($a['type']=='form' || $a['type']=='custom' ){
		$icon = '<img src="'.$dir.'/img/graduation-cap_icon.png">';
		$src = "href='#'";
	}else{
		$icon='';
	}

	//if($a['modal']==false){
		return "<div class='cta-wrap has-gradient ".$mod."' data-modal='".$mod."' data-type='".$a['type']."' data-src='".$a['src']."'>
					<div class='cta-button'>
						<a class='cta-link ".$col."' ".$src." ".$ext." >".$icon." ".$content."</a>
					</div>
				</div>";
	//}else{
		//return'';
	//}

	
}

add_shortcode( 'cta_button', 'button_filter' );

// add_filter( 'no_texturize_shortcodes', 'shortcodes_to_exempt_from_wptexturize' );
// function shortcodes_to_exempt_from_wptexturize( $shortcodes ) {
//     $shortcodes[] = 'font';
//     return $shortcodes;
// }

//Font styling in MCE
function font_filter ($atts, $content = null){
	$a = shortcode_atts( array(
        'uppercase' => '',
        'weight' => '',
        'size' => '',
        'color' => 'font-color: #ee555c; ',
    ), $atts ); 

$upper='';
$weight='';
$color='';

if($a['uppercase'] == true){
	$upper = 'text-transform:uppercase; ';
}

if ($a['weight'] == 'heavy'){
	$weight = "font-family: 'Avenir Next Cyr W00 Heavy'; ";
}elseif ($a['weight'] == 'bold'){
	$weight = "font-family: 'Avenir Next Cyr W00 Bold';' ";
}

if($a['color']=='red'){
	$color = 'color:#ee555c; ';
}elseif($a['color']=='blue'){
	$color = 'color:#248fb7; ';
}elseif($a['color']=='yellow'){
	$color = 'color:#f2b031; ';
}elseif($a['color']=='purple'){
	$color = 'color:#8a559f; ';
}

if ($upper != '' || $weight != '' || $color != ''){
	$style = 'style="'.$upper.$color.$weight.'"';
}

return '<span '.$style.'>'.$content.'</span>';

}

add_shortcode( 'font', 'font_filter' );

?>
