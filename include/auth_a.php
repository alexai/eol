<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */

session_start();
if (!isset($_SESSION['uid'])) {
	header("location:../login.php");
	exit;
}

if ($_SESSION['gid'] != 1) {
	echo '<script>alert("您没有管理员权限！");window.location.href="index.php";</script>';
	exit;
}

?>