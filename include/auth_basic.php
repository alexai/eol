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
	echo '<script>alert("��û����Ӧ��Ȩ�ޣ�");window.location.href="/eol/admin/index.php";</script>';
	exit;
}
?>