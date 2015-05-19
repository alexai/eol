<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */

session_start();
if (!isset($_SESSION['uid'])) {
	header("location:login.php");
	exit;
}
if ($_SESSION['level'] != 's') {
	echo '<script>alert("您没有相应的权限！");window.location.href="/eol/admin/index.php";</script>';
	exit;
}
?>