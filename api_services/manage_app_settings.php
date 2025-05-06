<?php

function manage_app_settings()
{
	global $outputjson, $gh, $db;
	$outputjson['success'] = 0;
	$action = $gh->read("action");
	if($action == "get_data")
	{ 
		$id = $gh->read("id");
		$query_apps = "SELECT DISTINCT a.*,p.name AS playstore_name, adx.name AS adx_name,
			CASE WHEN DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')) = 0 THEN 'Today' ELSE CONCAT(DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')),' Days') END AS `days`
			FROM tbl_apps as a 
			LEFT JOIN tbl_play_store as p ON p.id = a.playstore
			LEFT JOIN tbl_adx as adx ON adx.id = a.adx
			WHERE a.id = '$id'";
		$rows = $db->execute($query_apps);

		if ($rows != null && is_array($rows) && count($rows) > 0) {

			get_all_setting_data($id);

			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows[0];
		} else {
			$outputjson["data"] = [];
			$outputjson['message'] = "No Products found!";
		}
	}
	else if($action == "get_user_data")
	{
		$start = $gh->read("start");
		$length = $gh->read("length");
		$searcharr = $gh->read("search");
		$search = $searcharr['value'];
		$orderarr = $gh->read("order");
		$orderindex = $orderarr[0]['column'];
		$orderdir = $orderarr[0]['dir'];
		$columnsarr = $gh->read("columns");
		$extra_option = $_POST["extra_option"];
		$ordercolumn = $columnsarr[$orderindex]['name'];
		$filt_data = json_decode($extra_option, true);
		$time_filter = $filt_data['time_filter'];
		$sub_view = $filt_data['sub_view'];
		$app_id = $filt_data['app_id'];

		$main_where = " a.id = '$app_id' ";
		$whereData = $main_where;
		$cntWhereData = "";

		$today_con = " AND DATE_FORMAT(u.entry_date, '%Y-%m-%d') = '".date('Y-m-d')."' ";
		$yestarday_con = " AND DATE_FORMAT(u.entry_date, '%Y-%m-%d') = '".date("Y-m-d", strtotime("-1 day"))."' ";
		$org_con = " AND INSTR(installerurl,'gclid') = 0 ";
		$mrk_con = " AND INSTR(installerurl,'gclid') > 0 ";

		// if($time_filter == 1)
		// {
		// 	$whereData .= $today_con;
		// 	$cntWhereData .= $today_con;
		// }
		// else if($time_filter == 2) {
		// 	$whereData .= $yestarday_con;
		// 	$cntWhereData .= $yestarday_con;
		// }
		if($time_filter != ""){
			$exp_time_filter = explode(' - ', $time_filter);
			$startDate = $exp_time_filter[0]; 
			$endDate = $exp_time_filter[1]; 
			$time_con = " AND DATE_FORMAT(u.entry_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('$startDate','%d/%m/%Y') AND STR_TO_DATE('$endDate','%d/%m/%Y') ";
			$whereData .= $time_con;
			$cntWhereData .= $time_con;
		}
		if($sub_view != ""){
			$retansion = ($sub_view == "1") ? "false" : "true"; 
			$retansion_con = " AND u.retention = '$retansion' ";
			$whereData .= $retansion_con;
			$cntWhereData .= $retansion_con;
		}
		$whereData .= " AND (u.package LIKE '%" . $search . "%' OR 
						u.as LIKE '%" . $search . "%' OR
						u.asname LIKE '%" . $search . "%' OR
						u.city LIKE '%" . $search . "%' OR
						u.continent LIKE '%" . $search . "%' OR
						u.country LIKE '%" . $search . "%' OR
						u.countryCode LIKE '%" . $search . "%' OR
						u.hosting LIKE '%" . $search . "%' OR
						u.isp LIKE '%" . $search . "%' OR
						u.mobile LIKE '%" . $search . "%' OR
						u.org LIKE '%" . $search . "%' OR
						u.proxy LIKE '%" . $search . "%' OR
						u.query LIKE '%" . $search . "%' OR
						u.regionName LIKE '%" . $search . "%' OR
						u.installerinfo LIKE '%" . $search . "%' OR
						u.installerurl LIKE '%" . $search . "%'
						)";

		$total_count_query = "SELECT count(DISTINCT u.id) as cnt 
			FROM tbl_app_users as u 
			INNER JOIN tbl_apps as a ON a.package_name = u.package  
			WHERE " . $main_where;
		$total_count = $db->execute_scalar($total_count_query);
		$count_query = "SELECT count(DISTINCT u.id) as cnt FROM 
			tbl_app_users as u 
			INNER JOIN tbl_apps as a ON a.package_name = u.package
			WHERE " . $whereData;
		$filtered_count = $db->execute_scalar($count_query);

		$orderby = "";
		if ($orderindex >0) {
			$orderby = " ORDER BY ".$ordercolumn . " " . $orderdir;
		}
		$query_users = "SELECT DISTINCT u.* FROM tbl_app_users as u
			INNER JOIN tbl_apps as a ON a.package_name = u.package
			WHERE " . $whereData . " " . $orderby . " LIMIT " . $start . "," . $length . "";
		$rows = $db->execute($query_users);

		/***** extra cnt *****/
		$all_count_query = "SELECT count(DISTINCT u.id) as cnt 
			FROM tbl_app_users as u 
			INNER JOIN tbl_apps as a ON a.package_name = u.package  
			WHERE " . $main_where . $cntWhereData;
		$all_count = $db->execute_scalar($all_count_query);
		$org_count_query = "SELECT count(DISTINCT u.id) as cnt 
			FROM tbl_app_users as u 
			INNER JOIN tbl_apps as a ON a.package_name = u.package  
			WHERE " . $main_where . $org_con . $cntWhereData;
		$org_count = $db->execute_scalar($org_count_query);
		$mrkt_count_query = "SELECT count(DISTINCT u.id) as cnt 
			FROM tbl_app_users as u 
			INNER JOIN tbl_apps as a ON a.package_name = u.package  
			WHERE " . $main_where . $mrk_con .  $cntWhereData;
		$mrkt_count = $db->execute_scalar($mrkt_count_query);

		if ($rows != null && is_array($rows) && count($rows) > 0) {
			
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = $filtered_count;
			$outputjson['all_count'] = $all_count;
			$outputjson['org_count'] = $org_count;
			$outputjson['mrkt_count'] = $mrkt_count;
			$outputjson['success'] = 1;
			$outputjson['status'] = 1;
			$outputjson['message'] = 'success.';
			$outputjson["data"] = $rows;
		} else {
			$outputjson["data"] = [];
			$outputjson['recordsTotal'] = $total_count;
			$outputjson['recordsFiltered'] = 0;
			$outputjson['all_count'] = $all_count;
			$outputjson['org_count'] = $org_count;
			$outputjson['mrkt_count'] = $mrkt_count;
			$outputjson['message'] = "No Products found!";
		}
	}
	else if($action == "save_google_data")
	{
		$app_id = $gh->read("id");
		$type = $gh->read("type");
		$user_id = $gh->read("user_id", 0);
		$g1_percentage = $gh->read("g1_percentage", "");
		$g2_percentage = $gh->read("g2_percentage", "");
		$g3_percentage = $gh->read("g3_percentage", "");
		$g1_account_name = $gh->read("g1_account_name", "");
		$g2_account_name = $gh->read("g2_account_name", "");
		$g3_account_name = $gh->read("g3_account_name", "");
		$g1_banner = $gh->read("g1_banner", "");
		$g2_banner = $gh->read("g2_banner", "");
		$g3_banner = $gh->read("g3_banner", "");
		$g1_inter = $gh->read("g1_inter", "");
		$g2_inter = $gh->read("g2_inter", "");
		$g3_inter = $gh->read("g3_inter", "");
		$g1_native = $gh->read("g1_native", "");
		$g2_native = $gh->read("g2_native", "");
		$g3_native = $gh->read("g3_native", "");
		$g1_native2 = $gh->read("g1_native2", "");
		$g2_native2 = $gh->read("g2_native2", "");
		$g3_native2 = $gh->read("g3_native2", "");
		$g1_appopen = $gh->read("g1_appopen", "");
		$g2_appopen = $gh->read("g2_appopen", "");
		$g3_appopen = $gh->read("g3_appopen", "");
		$g1_appid = $gh->read("g1_appid", "");
		$g2_appid = $gh->read("g2_appid", "");
		$g3_appid = $gh->read("g3_appid", "");
		$date = date('Y-m-d H:i:s');
			
		$count_query = "SELECT id from tbl_apps_settings WHERE app_id = '$app_id' AND `type` = $type";
		$id = $db->execute_scalar($count_query);
		if($id > 0){
			$data = array(
				"g1_percentage" => $g1_percentage,
				"g2_percentage" => $g2_percentage,
				"g3_percentage" => $g3_percentage,
				"g1_account_name" => $g1_account_name,
				"g2_account_name" => $g2_account_name,
				"g3_account_name" => $g3_account_name,
				"g1_banner" => $g1_banner,
				"g2_banner" => $g2_banner,
				"g3_banner" => $g3_banner,
				"g1_inter" => $g1_inter,
				"g2_inter" => $g2_inter,
				"g3_inter" => $g3_inter,
				"g1_native" => $g1_native,
				"g2_native" => $g2_native,
				"g3_native" => $g3_native,
				"g1_native2" => $g1_native2,
				"g2_native2" => $g2_native2,
				"g3_native2" => $g3_native2,
				"g1_appopen" => $g1_appopen,
				"g2_appopen" => $g2_appopen,
				"g3_appopen" => $g3_appopen,
				"g1_appid" => $g1_appid,
				"g2_appid" => $g2_appid,
				"g3_appid" => $g3_appid,
				"update_uid" => $user_id,
				"update_date" => $date,
			);
			$res = $db->update("tbl_apps_settings", $data, array("id"=>$id));
		}
		else{
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"app_id" => $app_id,
				"type" => $type,
				"g1_percentage" => $g1_percentage,
				"g2_percentage" => $g2_percentage,
				"g3_percentage" => $g3_percentage,
				"g1_account_name" => $g1_account_name,
				"g2_account_name" => $g2_account_name,
				"g3_account_name" => $g3_account_name,
				"g1_banner" => $g1_banner,
				"g2_banner" => $g2_banner,
				"g3_banner" => $g3_banner,
				"g1_inter" => $g1_inter,
				"g2_inter" => $g2_inter,
				"g3_inter" => $g3_inter,
				"g1_native" => $g1_native,
				"g2_native" => $g2_native,
				"g3_native" => $g3_native,
				"g1_native2" => $g1_native2,
				"g2_native2" => $g2_native2,
				"g3_native2" => $g3_native2,
				"g1_appopen" => $g1_appopen,
				"g2_appopen" => $g2_appopen,
				"g3_appopen" => $g3_appopen,
				"g1_appid" => $g1_appid,
				"g2_appid" => $g2_appid,
				"g3_appid" => $g3_appid,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$res = $db->insert("tbl_apps_settings", $data);
		}

		get_all_setting_data($app_id);
		$outputjson['result'] = $res;
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data updated successfully";
	}
	else if($action == "save_oher_settings")
	{
		$app_id = $gh->read("id");
		$type = $gh->read("type");
		$user_id = $gh->read("user_id", 0);
		$all_ads = $gh->read("all_ads", "false");
		$fullscreen = $gh->read("fullscreen", "false");
		$adblock_version = $gh->read("adblock_version", "");
		$continue_screen = $gh->read("continue_screen", "false");
		$lets_start_screen = $gh->read("lets_start_screen", "false");
		$age_screen = $gh->read("age_screen", "false");
		$next_screen = $gh->read("next_screen", "false");
		$next_inner_screen = $gh->read("next_inner_screen", "false");
		$contact_screen = $gh->read("contact_screen", "false");
		$start_screen = $gh->read("start_screen", "false");
		$real_casting_flow = $gh->read("real_casting_flow", "false");
		$app_stop = $gh->read("app_stop", "false");
		$additional_fields = $_POST['additional_fields'];
		$date = date('Y-m-d H:i:s');
			
		$count_query = "SELECT id from tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = $type AND is_bifurcate = 0";
		$id = $db->execute_scalar($count_query);
		if($id > 0){
			$data = array(
				"all_ads" => $all_ads,
				"fullscreen" => $fullscreen,
				"adblock_version" => $adblock_version,
				"continue_screen" => $continue_screen,
				"lets_start_screen" => $lets_start_screen,
				"age_screen" => $age_screen,
				"next_screen" => $next_screen,
				"next_inner_screen" => $next_inner_screen,
				"contact_screen" => $contact_screen,
				"start_screen" => $start_screen,
				"real_casting_flow" => $real_casting_flow,
				"app_stop" => $app_stop,
				"additional_fields" => $additional_fields,
				"update_uid" => $user_id,
				"update_date" => $date,
			);
			if($additional_fields != ""){
				$af = json_decode($additional_fields, true);
				foreach($af as $fields){
					
					$query_bif = "SELECT * FROM tbl_app_ad_settings
						WHERE app_id = '$app_id' AND `type` = $type AND is_bifurcate = 1 AND additional_fields != '' AND additional_fields != NULL AND additional_fields != '[]'";
					$row_bif = $db->execute($query_bif);
					foreach($row_bif as $bifData){
						$bif_af = json_decode($bifData['additional_fields'], true);
						$search_val = $fields['field_name'];
						$outputjson['search_val'] = $search_val;

						$serach_res = $gh->findArrayByValue($bif_af, 'field_name', $search_val);
						if(empty($serach_res) || $serach_res == null){
							array_push($bif_af, $fields);
							$db->update("tbl_app_ad_settings", array("additional_fields" => json_encode($bif_af, true)), array("id"=>$bifData['id']));
						}
					}
				}
			}
			$res = $db->update("tbl_app_ad_settings", $data, array("id"=>$id));
		}
		else{
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"app_id" => $app_id,
				"type" => $type,
				"all_ads" => $all_ads,
				"fullscreen" => $fullscreen,
				"adblock_version" => $adblock_version,
				"continue_screen" => $continue_screen,
				"lets_start_screen" => $lets_start_screen,
				"age_screen" => $age_screen,
				"next_screen" => $next_screen,
				"next_inner_screen" => $next_inner_screen,
				"contact_screen" => $contact_screen,
				"start_screen" => $start_screen,
				"real_casting_flow" => $real_casting_flow,
				"app_stop" => $app_stop,
				"additional_fields" => $additional_fields,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$res = $db->insert("tbl_app_ad_settings", $data);
		}
		get_all_setting_data($app_id);
		$outputjson['result'] = $res;
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data updated successfully";
	}
	else if($action == "save_vpn_settings")
	{
		$app_id = $gh->read("id");
		$type = $gh->read("type");
		$user_id = $gh->read("user_id", 0);
		$vpn = $gh->read("vpn", "false");
		$vpn_dialog = $gh->read("vpn_dialog", "false");
		$vpn_dialog_open = $gh->read("vpn_dialog_open", "false");
		$vpn_country = $_POST["vpn_country"];
		$vpn_url = $gh->read("vpn_url", "");
		$vpn_carrier_id = $gh->read("vpn_carrier_id", "");
		$date = date('Y-m-d H:i:s');
			
		$count_query = "SELECT id from tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = $type AND is_bifurcate = 0";
		$id = $db->execute_scalar($count_query);
		if($id > 0){
			$data = array(
				"vpn" => $vpn,
				"vpn_dialog" => $vpn_dialog,
				"vpn_dialog_open" => $vpn_dialog_open,
				"vpn_country" => $vpn_country,
				"vpn_url" => $vpn_url,
				"vpn_carrier_id" => $vpn_carrier_id,
				"update_uid" => $user_id,
				"update_date" => $date,
			);
			$res = $db->update("tbl_app_ad_settings", $data, array("id"=>$id));
		}
		else{
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"app_id" => $app_id,
				"type" => $type,
				"vpn" => $vpn,
				"vpn_dialog" => $vpn_dialog,
				"vpn_dialog_open" => $vpn_dialog_open,
				"vpn_country" => $vpn_country,
				"vpn_url" => $vpn_url,
				"vpn_carrier_id" => $vpn_carrier_id,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$res = $db->insert("tbl_app_ad_settings", $data);
		}
		get_all_setting_data($app_id);
		$outputjson['result'] = $res;
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data updated successfully";
	}
	else if($action == "save_app_remove_settings")
	{
		$app_id = $gh->read("id");
		$type = $gh->read("type");
		$user_id = $gh->read("user_id", 0);
		$app_remove_flag = $gh -> read("app_remove_flag", "normal");
		$app_version = $gh -> read("app_version", "");
		$app_remove_title = $gh -> read("app_remove_title", "");
		$app_remove_description = $gh -> read("app_remove_description", "");
		$app_remove_url = $gh -> read("app_remove_url", "");
		$app_remove_button_name = $gh -> read("app_remove_button_name", "");
		$app_remove_skip_button_name = $gh -> read("app_remove_skip_button_name", "");
		$date = date('Y-m-d H:i:s');
			
		$count_query = "SELECT id from tbl_apps_settings WHERE app_id = '$app_id' AND `type` = $type";
		$id = $db->execute_scalar($count_query);
		if($id > 0){
			$data = array(
				"app_remove_flag" => $app_remove_flag,
				"app_version" => $app_version,
				"app_remove_title" => $app_remove_title,
				"app_remove_description" => $app_remove_description,
				"app_remove_url" => $app_remove_url,
				"app_remove_button_name" => $app_remove_button_name,
				"app_remove_skip_button_name" => $app_remove_skip_button_name,
				"update_uid" => $user_id,
				"update_date" => $date,
			);
			$res = $db->update("tbl_apps_settings", $data, array("id"=>$id));
		}
		else{
			$id=$gh->generateuuid();
			$data = array(
				"id" => $id,
				"app_id" => $app_id,
				"type" => $type,
				"app_remove_flag" => $app_remove_flag,
				"app_version" => $app_version,
				"app_remove_title" => $app_remove_title,
				"app_remove_description" => $app_remove_description,
				"app_remove_url" => $app_remove_url,
				"app_remove_button_name" => $app_remove_button_name,
				"app_remove_skip_button_name" => $app_remove_skip_button_name,
				"entry_uid" => $user_id,
				"entry_date" => $date,
			);
			$res = $db->insert("tbl_apps_settings", $data);
		}
		get_all_setting_data($app_id);
		$outputjson['result'] = $res;
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data updated successfully";
	}
	else if($action == "save_ad_settings")
	{
		$app_id = $gh->read("id");
		$type = $gh->read("type");
		$is_bifurcate = $gh->read("is_bifurcate", 0);
		$user_id = $gh->read("user_id", 0);
		$bifurcate_location = $gh->read("bifurcate_location","");
		$app_color = $gh->read("app_color","");
		$app_background_color = $gh->read("app_background_color","");
		$native_loading = $gh->read("native_loading","");
		$bottom_banner = $gh->read("bottom_banner","");
		$all_screen_native = $gh->read("all_screen_native","");
		$list_native = $gh->read("list_native","");
		$list_native_cnt = $gh->read("list_native_cnt","");
		$list_native_cnt = ($list_native_cnt != "") ? $list_native_cnt : 0;
		$exit_dialoge_native = $gh->read("exit_dialoge_native","");
		$native_btn = $gh->read("native_btn","");
		$native_btn_text = $gh->read("native_btn_text","");
		$native_background_color = $gh->read("native_background_color","");
		$native_text_color = $gh->read("native_text_color","");
		$native_button_background_color = $gh->read("native_button_background_color","");
		$native_button_text_color = $gh->read("native_button_text_color","");
		$alternate_with_appopen = $gh->read("alternate_with_appopen","");
		$inter_loading = $gh->read("inter_loading","");
		$inter_interval = $gh->read("inter_interval","");
		$inter_interval = ($inter_interval != "") ? $inter_interval : 0;
		$back_click_inter = $gh->read("back_click_inter","");
		$back_click_inter = ($back_click_inter != "") ? $back_click_inter : 0;
		$app_open_loading = $gh->read("app_open_loading","");
		$splash_ads = $gh->read("splash_ads","");
		$app_open = $gh->read("app_open","");

		$all_ads = $gh->read("all_ads", "false");
		$fullscreen = $gh->read("fullscreen", "false");
		$adblock_version = $gh->read("adblock_version", "");
		$continue_screen = $gh->read("continue_screen", "false");
		$lets_start_screen = $gh->read("lets_start_screen", "false");
		$age_screen = $gh->read("age_screen", "false");
		$next_screen = $gh->read("next_screen", "false");
		$next_inner_screen = $gh->read("next_inner_screen", "false");
		$contact_screen = $gh->read("contact_screen", "false");
		$start_screen = $gh->read("start_screen", "false");
		$real_casting_flow = $gh->read("real_casting_flow", "false");
		$app_stop = $gh->read("app_stop", "false");
		$additional_fields = $_POST['additional_fields'];
		$vpn = $gh->read("vpn", "false");
		$vpn_dialog = $gh->read("vpn_dialog", "false");
		$vpn_dialog_open = $gh->read("vpn_dialog_open", "false");
		$vpn_country = $_POST["vpn_country"];
		$vpn_url = $gh->read("vpn_url", "");
		$vpn_carrier_id = $gh->read("vpn_carrier_id", "");

		$date = date('Y-m-d H:i:s');
			
		$count_query = "SELECT id from tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = $type AND is_bifurcate = $is_bifurcate";
		$id = $db->execute_scalar($count_query);
		$data = array(
			"bifurcate_location" => $bifurcate_location,
			"app_color" => $app_color,
			"app_background_color" => $app_background_color,
			"native_loading" => $native_loading,
			"bottom_banner" => $bottom_banner,
			"all_screen_native" => $all_screen_native,
			"list_native" => $list_native,
			"list_native_cnt" => $list_native_cnt,
			"exit_dialoge_native" => $exit_dialoge_native,
			"native_btn" => $native_btn,
			"native_btn_text" => $native_btn_text,
			"native_background_color" => $native_background_color,
			"native_text_color" => $native_text_color,
			"native_button_background_color" => $native_button_background_color,
			"native_button_text_color" => $native_button_text_color,
			"alternate_with_appopen" => $alternate_with_appopen,
			"inter_loading" => $inter_loading,
			"inter_interval" => $inter_interval,
			"back_click_inter" => $back_click_inter,
			"app_open_loading" => $app_open_loading,
			"splash_ads" => $splash_ads,
			"app_open" => $app_open
		);

		if($is_bifurcate){
			$data['all_ads'] = $all_ads;
			$data['fullscreen'] = $fullscreen;
			$data['adblock_version'] = $adblock_version;
			$data['continue_screen'] = $continue_screen;
			$data['lets_start_screen'] = $lets_start_screen;
			$data['age_screen'] = $age_screen;
			$data['next_screen'] = $next_screen;
			$data['next_inner_screen'] = $next_inner_screen;
			$data['contact_screen'] = $contact_screen;
			$data['start_screen'] = $start_screen;
			$data['real_casting_flow'] = $real_casting_flow;
			$data['app_stop'] = $app_stop;
			$data['additional_fields'] = $additional_fields;

			$data['vpn'] = $vpn;
			$data['vpn_dialog'] = $vpn_dialog;
			$data['vpn_dialog_open'] = $vpn_dialog_open;
			$data['vpn_country'] = $vpn_country;
			$data['vpn_url'] = $vpn_url;
			$data['vpn_carrier_id'] = $vpn_carrier_id;

			$id = $gh->read("bifurcate_id");
		}

		if($id){
			$data["update_uid"] = $user_id;
			$data["update_date"] = $date;
			$res = $db->update("tbl_app_ad_settings", $data, array("id"=>$id));
		}
		else{
			$id=$gh->generateuuid();
			$data["id"] = $id;
			$data["app_id"] = $app_id;
			$data["type"] = $type;
			$data["is_bifurcate"] = $is_bifurcate;
			$data["entry_uid"] = $user_id;
			$data["entry_date"] = $date;
			$res = $db->insert("tbl_app_ad_settings", $data);
		}

		get_all_setting_data($app_id);
		$outputjson['result'] = $res;
		$outputjson['data_ref'] = $id;
		$outputjson['success'] = 1;
		$outputjson['message'] = "Data updated successfully";
	}
	else if($action == "delete_bifurcate_data"){
		$id = $gh->read("id");
		if ($id != "") {
			$app_id_query = "SELECT app_id from tbl_app_ad_settings WHERE id = '$id'";
			$app_id = $db->execute_scalar($app_id_query);
			$db->delete('tbl_app_ad_settings', array("id" => $id));
			get_all_setting_data($app_id);
			$outputjson['message'] = 'data deleted successfully.';
			$outputjson['success'] = 1;
		} else {
			$outputjson['message'] = "Sorry, somthing went wrong!";
		}
	}
	else {
		$outputjson["data"] = [];
		$outputjson['message'] = "Error!";
	}
		
}

function get_all_setting_data($app_id){
	global $outputjson, $db;

	$qry_org = "SELECT * FROM tbl_apps_settings WHERE app_id = '$app_id' AND `type` = 1";
	$rows_org = $db->execute($qry_org);
	
	$qry_mrkt = "SELECT * FROM tbl_apps_settings WHERE app_id = '$app_id' AND `type` = 2";
	$rows_mrkt = $db->execute($qry_mrkt);
	
	$qry_org_ad = "SELECT * FROM tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = 1 AND is_bifurcate = 0";
	$rows_org_ad = $db->execute($qry_org_ad);
	
	$qry_org_bifurcate_ad = "SELECT * FROM tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = 1 AND is_bifurcate = 1";
	$rows_org_bifurcate_ad = $db->execute($qry_org_bifurcate_ad);
	
	$qry_mrkt_ad = "SELECT * FROM tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = 2 AND is_bifurcate = 0";
	$rows_mrkt_ad = $db->execute($qry_mrkt_ad);
	
	$qry_mrkt_bifurcate_ad = "SELECT * FROM tbl_app_ad_settings WHERE app_id = '$app_id' AND `type` = 2 AND is_bifurcate = 1";
	$rows_mrkt_bifurcate_ad = $db->execute($qry_mrkt_bifurcate_ad);

	$outputjson["org_data"] = $rows_org[0];
	$outputjson["mrkt_data"] = $rows_mrkt[0];
	$outputjson["org_ad"] = $rows_org_ad[0];
	$outputjson["org_bifurcate_ad"] = $rows_org_bifurcate_ad;
	$outputjson["mrkt_ad"] = $rows_mrkt_ad[0];
	$outputjson["mrkt_bifurcate_ad"] = $rows_mrkt_bifurcate_ad;
}

function outputCsv( $assocDataArray ) {
	if ( !empty( $assocDataArray ) ){
		$fp = fopen( 'php://output', 'w' );
		fputcsv( $fp, array_keys( reset($assocDataArray) ) );
		foreach ( $assocDataArray AS $values ){
			fputcsv( $fp, $values );
		}
		fclose( $fp );
	}
	exit();
}
