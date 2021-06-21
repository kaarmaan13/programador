<?
//require ('functions.php');

	$dbuser = "avlarena_smf1";
	$dbpass = "uTgbKIqWVwCb";
	$dbhost = "localhost";
	$dbname = "avlarena_smf1";

	$dblink = mysql_connect($dbhost, $dbuser, $dbpass);
	if(!$dblink) {echo "ERROR:  Could not make connection to the database."; exit;}
	mysql_select_db($dbname, $dblink);
?>