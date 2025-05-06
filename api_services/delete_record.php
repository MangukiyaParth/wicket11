<?php

function delete_record()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$type = $gh->read("type");
	$id = $gh->read("id");
	if($type=='manage_play_store')
	{
		if ($id != "") {
			$db->delete('tbl_play_store', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_adx')
	{
		if ($id != "") {
			$db->delete('tbl_adx', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_apps')
	{
		if ($id != "") {
			$db->update('tbl_apps', array("is_deleted" => 1), array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else if($type=='manage_removed_apps')
	{
		if ($id != "") {
			$gh->removeFolder("app", $id);

			$db->delete('tbl_apps', array("id" => $id));
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
			
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	
}
