<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
require_once("include/config.php");
$id = $_POST["chooseid"];
if ($_POST["level"] == 's') {
	$qr = "SELECT * FROM `gb_students_tb` WHERE `stu_id` = $id;";
} elseif ($_POST["level"] == 't') {
	$qr = "SELECT * FROM `gb_teachers_tb` WHERE `tea_id` = $id;";
} else {
	echo "Some strange thing happened!";
	exit;
}
$res = mysql_query($qr);
if (mysql_result($res,0,disabled) == 'yes') {
	echo '<script>alert("您的帐号已经被禁止使用，请联系管理员");location.href="login.php";</script>';
} else {
	if (mysql_result($res,0,pwd) == $_POST["pwd"]) {
		$_SESSION['uid'] = $id;
		$_SESSION['cname'] = $_POST['cname'];
		$_SESSION['gid'] = mysql_result($res,0,group);
		$_SESSION['level'] = $_POST['level'];
		if ($_POST['level'] == 's') {
			header("location:index.php");
		} else {
			header("location:admin/index.php");
		}
	} else {
		header("location:login.php");
	}
}
mysql_close();
?>