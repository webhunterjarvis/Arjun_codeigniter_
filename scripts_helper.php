<?php 
/****************************************************
*****************************************************
@ Author: Arjun Singh Saini
@ Helper: script helper
@ Author URI: https://devartisan.in
@ Email: webhunterr@gmail.com
@ Description: this is essential script for 
  web developement purpose. its very useful
  for any php project.its also private use only. 

******************************************************
*****************************************************/

//javascript functions
function alert($msg){
echo "<script>alert('".$msg."');</script>";
}

function msgnpath($msg, $path){
    echo "<script>alert('".$msg."');</script>";
    echo "<script>window.location.href='".$path."';</script>";
                  
}


function reload(){
    echo "<script>location.reload();</script>";   
}


function delconfirm($msg){
//this is for view part and confirming delete or not.
   echo "if(confirm('{$msg}')) return true; else return false;";
}



//url and encoding decoding.
function getdash($path){
    
    $ex =  explode(" ",$path);
    $imp = implode("-",$ex);
    return  $imp;
}

function rdash($path){
    $imp = explode("-",$path);
    return implode(" ",$imp);
}

function drepaceslash($path){
	 $imp = explode("-",$path);
    return implode("/",$imp);
}
function stou($path){
	 $imp = explode(" ",$path);
    return implode("_",$imp);
}

function utos($path){
	 $imp = explode("_",$path);
    return implode(" ",$imp);
}


function refresh(){
    echo '<meta http-equiv="refresh" content="1">';
}

function clean($string){
	$vals = rtrim($string);
	$vals2 = ltrim($vals);
	$filter =  getdash($vals2);
	$filter2 =  preg_replace('/[^A-Za-z0-9\-]/', '', $filter);
	return $filter2;
}


function escape($str){
	echo htmlspecialchars($str, ENT_QUOTES); 
}



function path($url= null){
	if(!empty($url)){
		return base_url($url);
	}else{
	return  base_url();	
	}
	
}


//time functions
function ctime(){
    echo date('d-m-Y', time () );
}
function timestamp(){
	echo date('Y-m-d h:i:s');
}





function time_ago($timestamp){
  
  date_default_timezone_set("Asia/Kolkata");         
  $time_ago        = strtotime($timestamp);
  $current_time    = time();
  $time_difference = $current_time - $time_ago;
  $seconds         = $time_difference;
  
  $minutes = round($seconds / 60); // value 60 is seconds  
  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
  $weeks   = round($seconds / 604800); // 7*24*60*60;  
  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                
  if ($seconds <= 60){

    return "Just Now";

  } else if ($minutes <= 60){

    if ($minutes == 1){

      return "one minute ago";

    } else {

      return "$minutes minutes ago";

    }

  } else if ($hours <= 24){

    if ($hours == 1){

      return "an hour ago";

    } else {

      return "$hours hrs ago";

    }

  } else if ($days <= 7){

    if ($days == 1){

      return "yesterday";

    } else {

      return "$days days ago";

    }

  } else if ($weeks <= 4.3){

    if ($weeks == 1){

      return "a week ago";

    } else {

      return "$weeks weeks ago";

    }

  } else if ($months <= 12){

    if ($months == 1){

      return "a month ago";

    } else {

      return "$months months ago";

    }

  } else {
    
    if ($years == 1){

      return "one year ago";

    } else {

      return "$years years ago";

    }
  }
}
