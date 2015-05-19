<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
require_once("include/config.php");
$p1 = $_POST["username"];
$p2 = md5($_POST["password1"]);
$p3 = $_POST["gendar"];
$p4 = $_POST["birthday"];
$p5 = $_POST["email"];
$p6 = $_POST["addr"];
$p7 = $_POST["paremail"];
$p8 = $_POST["tel"];
$p9 = $_POST["group"];

if (strtoupper($_POST["yzm"]) != $_SESSION["code"]) {
	echo '<script language=javascript>alert("验证码填写错误！");window.history.back();</script>';
	exit;
} else {
	if ($_POST["level"] == 's') {
	$qr = "INSERT INTO `gb_students_tb` (`cname`,`pwd`,`gendar`,`birthday`,`email`,`addr`,`par_email`,`tel`,`group`) VALUES ('$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9');";
	} elseif ($_POST["level"] == 't') {
	$qr = "INSERT INTO `gb_teachers_tb` (`cname`,`pwd`,`gendar`,`birthday`,`email`,`tel`,`group`) VALUES ('$p1','$p2','$p3','$p4','$p5','$p8','$p9');";
	} else {
		echo "Something wrong!";
		exit;
	}
	mysql_query($qr);
	unset($_SESSION["code"]);
	echo '<script language=javascript>alert("您已注册成功！您的唯一编号为：'.mysql_insert_id().' 。请牢记这个编号，当有重复姓名的时候，会用到它。");';
	echo 'window.location.href="login.php";';
	echo '</script>';
}
mysql_close();
?>