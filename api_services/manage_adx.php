<?php

function manage_adx()
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
		
		$whereData = "";
		$whereData .= "(p.name LIKE '%" . $search . "%')";

		$total_count = $db->get_row_count('tbl_adx', "1=1");
		$count_query = "SELECT count(DISTINCT p.id) as cnt FROM tbl_adx as p WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "ORDER BY p.entry_date DESC";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_port_rates = "SELECT DISTINCT p.*,p.id AS md5_id
			FROM tbl_adx as p 
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
	}else if($action == "add_data")
	{
		$id = $gh->read("id");
		$user_id = $gh->read("user_id", 0);
		$name = $gh->read("name");
		$date = date('Y-m-d H:i:s');
		$formevent = $gh->read("formevent");

		if($formevent =='submit'){
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"name" => $name,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$db->insert("tbl_adx", $data);

			$outputjson['result'] = [];
			$outputjson['success'] = 1;
			$outputjson['message'] = "Data added successfully";
		}else{																						//update
			if ($id != "") {
				$data = array(
					"name" => $name,
					"update_uid" => $user_id,
					"update_date" => $date,
				);
				$rows = $db->update('tbl_adx', $data, array("id" => $id));

				$outputjson['success'] = 1;
				$outputjson['message'] = 'Data updated successfully.';
				$outputjson["data"] = $rows;
			} 
		} 
	}else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}
