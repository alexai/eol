<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("include/auth.php");
require_once("include/config.php");
include("include/head1.htm");

if ($_SESSION['level'] == 's') {
	if (isset($_POST['hooker'])) {
		$uid = $_SESSION['uid'];
		$u2 = $_POST['birthday'];
		$u3 = $_POST['email'];
		$u4 = $_POST['addr'];
		$u5 = $_POST['paremail'];
		$u6 = $_POST['tel'];
		$u7 = $_POST['group'];
		if (isset($_POST['password1'])) {
			$u1 = md5($_POST['password1']);
			mysql_query("UPDATE `gb_students_tb` SET `pwd` = '$u1', `birthday` = '$u2', `email` = '$u3', `addr` = '$u4', `par_email` = '$u5', `tel` = '$u6', `group` = '$u7' WHERE `stu_id` = '$uid';");
		} else {
			mysql_query("UPDATE `gb_students_tb` SET `birthday` = '$u2', `email` = '$u3', `addr` = '$u4', `par_email` = '$u5', `tel` = '$u6', `group` = '$u7' WHERE `stu_id` = '$uid';");
		}		
	}
	include_once("change_s.php");
} elseif ($_SESSION['level'] == 't') {
	if (isset($_POST['hooker'])) {
		$uid = $_SESSION['uid'];
		$u2 = $_POST['birthday'];
		$u3 = $_POST['email'];
		$u4 = $_POST['tel'];
		$u5 = $_POST['group'];
		if (isset($_POST['password1'])) {
			$u1 = md5($_POST['password1']);
			mysql_query("UPDATE `gb_teachers_tb` SET `pwd` = '$u1', `birthday` = '$u2', `email` = '$u3', `tel` = '$u4', `group` = '$u5' WHERE `tea_id` = '$uid';");
		} else {
			mysql_query("UPDATE `gb_teachers_tb` SET `birthday` = '$u2', `email` = '$u3', `tel` = '$u4', `group` = '$u5' WHERE `tea_id` = '$uid';");
		}
	}
	include_once("change_t.php");
} else {
	echo "Unbeliveable!";
}
?>