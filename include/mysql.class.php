<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
class MySql {
	private $sql_str;
	
	function __construct() {
		require_once("config.php");
		mysql_connect($dbhost,$dbuser,$dbpw);
	}
	
	function select_db($dbname) {
		return mysql_select_db($dbname);
	}
	
	function get_array($sql_str) {
		echo '$sql_str: '.$sql_str.'<br>';
		$query = mysql_query("$sql_str");
		print_r($query);
		$query = mysql_fetch_array("$query");
		echo "next<br>";
		print_r($query);
		return $query;
	}
	
	function get_result($sql_str,$off) {
		$query = mysql_query($sql_str);
		$query = mysql_result($query,0,$off);
		return $query;
	}
	
	function result_num($sql_str) {
		$query = mysql_query($sql_str);
		$query = mysql_num_rows($query);
		return $query;
	}
	
	function insert_id() {
		$inert_id = mysql_insert_id();
		return $inert_id;
	}
	
	function close() {
		mysql_close();
	}
}


?>