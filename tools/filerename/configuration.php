<?php
//nome do host
$host = 'localhost';
//nome do usuario mysql
$user = 'root';
//password do usuario mysql
//$password = '@nTi#HosTs_';
$password = '';
//nome do banco de dados
$database = 'site_novo';

//connectando ao banco de dados
$db_link = mysql_connect($host, $user, $password);

if (!$db_link) {
    die('Could not connect: ' . mysql_error());
    exit;
}
//selecionando o database
$db = mysql_select_db($database, $db_link);
if( !$db ){
	die('could not connect to database: '.$database);
}

function loadObjectList($query)
{
	global $db_link;
	$rows = array();
	
	$result = mysql_query($query,$db_link);
	while ($row = mysql_fetch_object($result)) {
	    $rows[] = $row;
	}
	mysql_free_result($result);
	
	return $rows;
}

function loadObject($query)
{
	global $db_link;
	$result = mysql_query($query,$db_link);
        $row = mysql_fetch_object($result);

        return $row;
}


function getList($id){
    $query = "SELECT CONCAT('http://www.isgh.org.br/site/phocadownload/', f.filename) AS path, f.filename as filename, f.title as title FROM ugbu6_phocadownload AS f"
            ." LEFT JOIN ugbu6_phocadownload_categories AS c ON f.catid = c.id"
            ." WHERE"
            ." c.id = " . (int)$id . " AND"
            ." f.published = 1"
            ;
    return loadObjectList($query);
}

function getTitle($id){
    $query = "SELECT c.title FROM ugbu6_phocadownload_categories as c WHERE id = " . (int)$id;
    return loadObject($query);
}