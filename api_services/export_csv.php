<?php
$start_service = microtime(true);

header("Content-type: application/json; charset=utf-8");

include_once dirname(__DIR__, 1)."/config/_DEFINE.php";
include_once dirname(__DIR__, 1)."/config/_SUPPORT.php";
include_once dirname(__DIR__, 1)."/config/_DATABASE.php";
include_once dirname(__DIR__, 1)."/config/_CONST.php";

// array_filter($_POST, 'trim_value');    // the data in $_POST is trimmed
global $outputjson, $gh, $db;
$db = new MysqliDB($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
$gh = new SUPPORT();
$const = new ProjectConst();
$outputjson['success'] = 0;

$filter = $gh->read("filter");

$login_not_require_operation = array("login_user", "logout_user", "log_manage", "upload_csv");
$loggedin_user = [];
$md5_user_id = 0;

$operation = $gh->read("op", "");
$user_id = $gh->read("user_id", '');
$from = $gh->read("from", "panel"); // web/panel, ios, android, qbd
// $auth_tkn = $gh->read("auth_token", "");
if (!in_array($operation, $login_not_require_operation)) {
	$auth_token = $_SERVER['HTTP_AUTH_TOKEN'];
	if ($auth_token != "") {
		$isvalidate = $gh->validatejwt($auth_token,$from);
		// print_r($isvalidate);
		if($isvalidate['status'] == 1){
			if(!$isvalidate['temp_user']){
				$gh->current_user = $loggedin_user = getUsersDetails($isvalidate['user_id'], false);
			}
		}
		else {
			// $outputjson['message1'] = $isvalidate;
			$outputjson['message'] = "Token not Found";
			$outputjson['status'] = -2;
			$response_string = json_encode(($outputjson), JSON_PRETTY_PRINT);
			echo $response_string;
			return;
		}
	} else {
		// $outputjson['message1'] = $auth_tkn;
		$outputjson['message'] = "Token not Found.";
		$outputjson['status'] = -2;
		// $outputjson['data'] = (object)[];
		$response_string = json_encode(($outputjson), JSON_PRETTY_PRINT);
		echo $response_string;
		return;
	}
}

$whereData = "";
if($filter != ""){
	$whereData .= " a.status = $filter ";
}
$query_apps = "SELECT DISTINCT a.*,p.name AS playstore_name, adx.name AS adx_name,
	CASE WHEN DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')) = 0 THEN 'Today' ELSE CONCAT(DATEDIFF(CURDATE(),STR_TO_DATE(a.entry_date, '%Y-%m-%d')),' Days') END AS `days`
	FROM tbl_apps as a 
	LEFT JOIN tbl_play_store as p ON p.id = a.playstore
	LEFT JOIN tbl_adx as adx ON adx.id = a.adx
	WHERE " . $whereData;
$rows = $db->execute($query_apps);

if ($rows != null && is_array($rows) && count($rows) > 0) {
	$products= [];
	foreach ($rows as $key => $product){
		$products[$key]['app_name'] = $product['app_name'];
		$products[$key]['app_code'] = $product['app_code'];
		$products[$key]['package_name'] = $product['package_name'];
		$products[$key]['web_url'] = $product['web_url'];
		$products[$key]['playstore_name'] = $product['playstore_name'];
		$products[$key]['adx_name'] = $product['adx_name'];
		$products[$key]['notes'] = $product['notes'];
		$products[$key]['file'] = API_SERVICE_URL.$product['file'];
	}

	return outputCsv($products);
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

function getUsersDetails($id, $is_md5)
{
	global $db;
	if ($is_md5) {
		$query_user = "SELECT usr.*	FROM tbl_users as usr WHERE md5(id) = '$id'";
		$rows = $db->execute($query_user);
	} else {
		$query_user = "SELECT usr.*	FROM tbl_users as usr WHERE id = '$id'";
		$rows = $db->execute($query_user);
	}
	if ($rows != null && is_array($rows) && count($rows) > 0) {
		return $rows[0];
	} else {
		return null;
	}
}