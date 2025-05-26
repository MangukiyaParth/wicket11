<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
ini_set("pcre.backtrack_limit", "5000000");

date_default_timezone_set('Asia/Kolkata');
$start_service = microtime(true);

include_once dirname(__DIR__, 2)."/config/_DEFINE.php";
include_once dirname(__DIR__, 2)."/config/_SUPPORT.php";
include_once dirname(__DIR__, 2)."/config/_DATABASE.php";
include_once dirname(__DIR__, 2)."/config/_CONST.php";

global $outputjson, $gh, $db;
$db = new MysqliDB($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
$gh = new SUPPORT();
$const = new ProjectConst();


$options = [
    'http' => [
        'method' => 'GET',
        'header' => 'Content-Type: text/html', // Set any desired headers
        'ignore_errors' => true, // Allows us to fetch content even if HTTP status code is not 2xx
    ],
];
$context = stream_context_create($options);

// Check for LIVE apps
$qry_upload_apps = "SELECT id, package_name FROM tbl_apps WHERE status = 2";
$upload_apps = $db->execute($qry_upload_apps);
if ($upload_apps != null && is_array($upload_apps) && count($upload_apps) > 0) {
    foreach($upload_apps as $app){
        $dom = new DOMDocument();
        $html = file_get_contents('https://play.google.com/store/apps/details?id='.$app['package_name'], false, $context);
        $http_response_code = $http_response_header[0];
        if (strpos($http_response_code, '200') !== false) {
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();
            libxml_use_internal_errors(false);
            $xpath = new DOMXPath($dom);

            // $console_div = $xpath->query("//div[contains(@class, 'Vbfug')]");
            // $consolediv = $console_div[0];
            // $nodes = $consolediv->childNodes;
            // $node = $nodes[0];
            // $console_name = $node->nodeValue;
            // echo $console_name.'<br>';

            $app_name_div = $xpath->query("//h1[contains(@itemprop, 'name')]");
            $app_namediv = $app_name_div[0];
            $app_name = $app_namediv->textContent;

            $logo_div = $xpath->query("//div[contains(@class, 'Il7kR')]");
            $logodiv = $logo_div[0];
            $logo_nodes = $logodiv->childNodes;
            $logo_node = $logo_nodes[0];
            $app_logo = $logo_node->attributes[0]->textContent;

            $data = array(
                "status" => 3,
                "app_name" => $app_name,
                "file" => $app_logo,
                "file_data" => ""
            );
            $db->update('tbl_apps', $data, array("id" => $app['id']));
            $noti_id=$gh->generateuuid();
            $noti_data = array(
                "id" => $noti_id,
                "app_id" => $id,
                "app_name" => $app_name,
                "app_logo" => $app_logo,
                "app_package" => $app['package_name'],
                "type" => 1, //Upload To live
                "is_read" => 0,
                "entry_date" => date('Y-m-d H:i:s')
            );
            $db->insert('tbl_notification', $noti_data);

        } else {
            // Handle 404 error
            // echo 'Error: Page not found (404)';
        }
    }
}

// Check for SUSPENDED apps
$qry_live_apps = "SELECT id, app_name, package_name, file FROM tbl_apps WHERE status = 3";
$live_apps = $db->execute($qry_live_apps);
if ($live_apps != null && is_array($live_apps) && count($live_apps) > 0) {
    foreach($live_apps as $app){
        $dom = new DOMDocument();
        $html = file_get_contents('https://play.google.com/store/apps/details?id='.$app['package_name'], false, $context);
        // $html = file_get_contents('https://play.google.com/store/apps/details?id=com.allsocialvideos.multimedia.videodlpro');
        $http_response_code = $http_response_header[0];
        if (strpos($http_response_code, '200') !== false) {
          

        } else {
            $data = array(
                "status" => 4,
            );
            $db->update('tbl_apps', $data, array("id" => $app['id']));
            $noti_id=$gh->generateuuid();
            $noti_data = array(
                "id" => $noti_id,
                "app_id" => $app['id'],
                "app_name" => $app['app_name'],
                "app_logo" => $app['file'],
                "app_package" => $app['package_name'],
                "type" => 2, //live to Suspended
                "is_read" => 0,
                "entry_date" => date('Y-m-d H:i:s')
            );
            $db->insert('tbl_notification', $noti_data);
        }
    }
}


$qry_live_apps = "SELECT id, app_name, package_name, file FROM tbl_apps WHERE is_deleted = 0";
$live_apps = $db->execute($qry_live_apps);
if ($live_apps != null && is_array($live_apps) && count($live_apps) > 0) {
    foreach($live_apps as $app){

        // Update Download Count
        $qry_cnt = "select IFNULL((SELECT count(DISTINCT u.id) FROM tbl_app_users as u WHERE u.app_id = '" . $app['id'] . "'),0) AS total_cnt, 
        IFNULL((SELECT count(DISTINCT u.id) FROM tbl_app_users as u WHERE u.app_id = '" . $app['id'] . "' AND DATE_FORMAT(u.entry_date, '%Y-%m-%d') = '".date('Y-m-d')."' ),0) AS today_cnt, 
        IFNULL((SELECT count(DISTINCT u.id) FROM tbl_app_users as u WHERE u.app_id = '" . $app['id'] . "' AND DATE_FORMAT(u.entry_date, '%Y-%m-%d') = '".date("Y-m-d", strtotime("-1 day"))."' ),0) AS yestarday_cnt";
        $res_cnt = $db->execute($qry_cnt);
        $total_cnt = 0;
        $today_cnt = 0;
        $yestarday_cnt = 0;
        if ($res_cnt != null && is_array($res_cnt) && count($res_cnt) > 0) {
            $cnts = $res_cnt[0];
            $total_cnt = $cnts['total_cnt'];
            $today_cnt = $cnts['today_cnt'];
            $yestarday_cnt = $cnts['yestarday_cnt'];
        }
        $data = array(
            "total_cnt" => $total_cnt,
            "today_cnt" => $today_cnt,
            "yestarday_cnt" => $yestarday_cnt,
        );
        $db->update('tbl_apps', $data, array("id" => $app['id']));

    }
}
?>