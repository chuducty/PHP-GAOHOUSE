<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}
function display_img_in_main_page($imgs){
  $result = '';
  foreach ($imgs as $img) {
    $tmp = "<li>
                    <figure class=\"meal-photo\">
                        <img src=\"";
    $tmp .= $img->image_path();
    $tmp .= "\" alt=\"Korean bibimbap with egg and vegetables\">
                    </figure>
                </li>";
    $result .= $tmp;
    # code...
  }
  return $result;
}
function display_img($img){
  $img_src = $img->image_path();

  $tmp = "<div class=\"col span-1-of-3\">
      <div class=\"ih-item square effect right_to_left\">
                        <a href=\"#\">
                        <div class=\"img\"><img src=\"";
  $tmp .= $img_src;
  $tmp .= "\" alt=\"img\"></div><div class=\"info\">
                                  <h3>

                                  ";
  $tmp .= $img->caption;
  $tmp .="</h3>
                                  
                                </div></a>
                        </div>
                    </div>";
  //echo $tmp;
  return $tmp;

}


function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }



}

?>