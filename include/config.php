<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
$dbhost = "localhost";
$dbname = "eol";
$dbuser = "eol";
$dbpw = "greenbrook";
$allow_reg = true;
$admin_email = "admin@domain.com";
$domain = "http://219.239.215.21/eol";

$con = mysql_connect($dbhost,$dbuser,$dbpw);
mysql_query("set names 'utf8'");
mysql_select_db($dbname,$con);
?>