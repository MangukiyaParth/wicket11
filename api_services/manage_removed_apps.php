<?php

function manage_removed_apps()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data")
	{ 
		$start = $gh->read("start");
		$length = $gh->read("length");
		$searcharr = $gh->read("search");
		$search = $searcharr['value'];
		$orderarr = $gh->read("order");
		$orderindex = $orderarr[0]['column'];
		$orderdir = $orderarr[0]['dir'];
		$columnsarr = $gh->read("columns");
		$ordercolumn = $columnsarr[$orderindex]['name'];
		
		$whereData = " a.is_deleted=1 AND ";
		$whereData .= "(a.playstore LIKE '%" . $search . "%' OR 
					a.adx LIKE '%" . $search . "%' OR 
					a.app_code LIKE '%" . $search . "%' OR 
					a.app_name LIKE '%" . $search . "%' OR 
					a.package_name LIKE '%" . $search . "%' OR 
					a.web_url LIKE '%" . $search . "%' OR 
					a.notes LIKE '%" . $search . "%')";

		$total_count = $db->get_row_count('tbl_apps', "is_deleted=1");
		$filtered_count = 0;
		$count_query = "SELECT count(DISTINCT a.id) as cnt 
			FROM tbl_apps as a 
			LEFT JOIN tbl_play_store as p ON p.id = a.playstore
			LEFT JOIN tbl_adx as adx ON adx.id = a.adx
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "ORDER BY a.entry_date DESC";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT a.*,p.name AS playstore_name, adx.name AS adx_name,
			CASE WHEN DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')) = 0 THEN 'Today' ELSE CONCAT(DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')),' Days') END AS `days`
			FROM tbl_apps as a 
			LEFT JOIN tbl_play_store as p ON p.id = a.playstore
			LEFT JOIN tbl_adx as adx ON adx.id = a.adx
			WHERE " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
		$rows = $db->execute($query_port_rates);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = $filtered_count;
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = 0;
			$outputjson['message'] = "No Products found!";
		}
	}else if($action == "restore")
	{
		$id = $gh->read("id");
		$db->update('tbl_apps', array("is_deleted" => 0), array("id" => $id));
		$outputjson['message'] = 'data restored successfully.';
		$outputjson['success'] = 1;

	}else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
