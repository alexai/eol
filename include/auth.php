<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */

session_start();
if ((!isset($_SESSION['uid'])) OR (!isset($_SESSION['level'])) OR (!isset($_SESSION['gid']))) {
	header("location:login.php");
	exit;
}
?>