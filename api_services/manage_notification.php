<?php

function manage_notification()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data"){
		$query_noti = "SELECT *, DATE_FORMAT(entry_date,'%d/%m/%Y %h:%i %p') AS date_formated FROM tbl_notification WHERE is_read = 0";
		$rows = $db->execute($query_noti);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['recordsFiltered'] = 0;
			$outputjson['message'] = "No Notification found!";
		}
	}else if($action == "delete_data"){
		$id = $gh->read("id","");
		$db->update("tbl_notification", array("is_read" => 1), array("id" => $id) );
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'Notification read successfully.';
		$outputjson["data"] = [];
	}else if($action == "delete_all"){
		$db->update("tbl_notification", array("is_read" => 1), array() );
		$outputjson['success'] = 1;
		$outputjson['status'] = 1;
		$outputjson['message'] = 'Notifications clear successfully.';
		$outputjson["data"] = [];
	}else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}