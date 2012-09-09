
<?php

// function list
function dbQuery($sql,$connect) {
	global $_GET;
	if( $_GET['sqlshow']==1 ) echo "$sql<br>";
	return mysql_query($sql,$connect);
}
function dbFetch($query) {
	return @mysql_fetch_array($query);
}

// Main server-side source
$reAction = $_GET['reAction'];

$link = mysql_connect("localhost", "root", "root") or die("Could not connect");
mysql_select_db("SenchaDB") or die("Could not select database");
mysql_query("SET NAMES utf8");

// corrected login logic
if ( $reAction == 'login' ) {
	$sql = "SELECT * FROM login";
	$query = dbQuery($sql, $link);

	$loginId = false;
	$inputId = $_GET['userid'];
	$inputPw = $_GET['userpw'];

	while($rs = dbFetch($query)) {
		if( $rs['userid'] == $inputId && $rs['userpw'] == $inputPw ) {
			$loginId = true;
		}
	}

	$obj = array( "loginNumber" => urlencode($loginId) );

	$callback = $_REQUEST['callback'];
	if($callback) {
		header('Content-Type: text/javascript');
		echo $callback . '(' . urldecode(json_encode($obj)) . ');';
	}
	else {
		header('Content-Type: application/x-json');
        echo urldecode(json_encode($obj));
	}
}
