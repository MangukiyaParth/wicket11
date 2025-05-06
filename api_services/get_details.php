<?php

function get_details()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data")
	{
		$query_playstore = "SELECT id, name FROM tbl_play_store WHERE status = 3";
		$playstore_rows = $db->execute($query_playstore);
		$query_adx = "SELECT id, name FROM tbl_adx";
		$adx_rows = $db->execute($query_adx);


		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'success.';
		$outputjson["playstore"] = $playstore_rows;
		$outputjson["adx"] = $adx_rows;
	}
	else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
