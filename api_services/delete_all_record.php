<?php

function delete_all_record()
{
	global $outputjson, $gh, $db;
	
	$type = $gh->read("type");
	$outputjson['success'] = 0;

	if($type=='manage_play_store')
	{
		$db->execute_query('TRUNCATE TABLE tbl_play_store');
	}
	else if($type=='manage_adx')
	{
		$db->execute_query('TRUNCATE TABLE tbl_adx');
	}
	else if($type=='manage_testimonial')
	{
		$gh->removeFolder("testimonial", 0);
		$db->execute_query('TRUNCATE TABLE tbl_testimonialmaster');
	}

	$outputjson['message'] = 'all data deleted successfully.';
	$outputjson['success'] = 1;
}
