<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

function setOutput($success, $rtnMsg, $data){
	$data['success'] = $success;
	if($rtnMsg!=""){
		if($success==1){
			$data['rtnMsg']	 = "<strong>Success:</strong> ".$rtnMsg;	
		}else{
			$data['rtnMsg']	 = "<strong>Error:</strong> ".$rtnMsg;	
		}	
	}
	else{
		$data['rtnMsg']	 = $rtnMsg;	
	}
	return $data;
}

function getPriviledges(){
	$CI = & get_instance();
	$userId = $CI->session->userdata('id');
	$data = $CI->db->get_where('privilege', array('userId'=>$userId))->row();
	return $data;
}

function getUTC(){
	return gmdate("Y-m-d H:i:s.").intval(gettimeofday()["usec"]/1000);
}

/* 
Returns localtime
function getLocalTime(){
	$myDateTime = new DateTime();
	//$myDateTime->setTimezone( new DateTimeZone( '+0530' ) );
	$myDateTime->setTimezone( new DateTimeZone( LOCAL_TIME ) );
	return $myDateTime->format("Y-m-d H:i:s");
} */

// Returns localtime using LOCAL_TIME defined in constants.php
function getLocalTime($date, $format){
	$cmtDate = DateTime::createFromFormat('Y-m-d H:i:s.u', $date);
	$cmtDate->setTimeZone(new DateTimeZone(LOCAL_TIME));
	return $cmtDate->format($format);
}

?>