<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
if ((!isset($_SESSION['pid'])) or (!isset($_SESSION['stamp']))) {
	header("location:index.php");
	exit;
}
require_once("include/config.php");
$client_ip = $_SERVER['REMOTE_ADDR'];
$time = $_SERVER['REQUEST_TIME'];
$client_port = $_SERVER['REMOTE_PORT'];
$keyword = md5($time.$client_ip.$client_port);
$_SESSION['keyword'] = $keyword;
$v1 = $_SESSION['pid'];$v2 = $_SESSION['uid'];$v3 = $_SESSION['stamp'];
	
mysql_query("INSERT INTO `gb_answer_papers` (`paper_id`,`stu_id`,`keyword`,`time`) VALUES ('$v1','$v2','$keyword','$v3');");
$answ_id = mysql_insert_id();
$_SESSION['answ_id'] = $answ_id;
$tmp_score_1 = 0;$tmp_score_2 = 0;
for ($i = 1;$i <= $_POST['count_items'];++$i) {
	$s1 = "T".$i;
	$s1 = $_POST["$s1"];
	$decision[] = $s1; 
	$s2 = "ID".$i;
	$s2 = $_POST["$s2"];
	switch ($s1) {
		case 1:
		$s3 = "Q".$i;
		$s3 = $_POST["$s3"];
		mysql_query("INSERT INTO `gb_obj_answ` (`id`,`item_id`,`answ`) VALUES ('$answ_id','$s2','$s3');");
		$std_answ = mysql_result(mysql_query("SELECT `std_answ` FROM `gb_item_std_answ` WHERE `item_id` = '$s2';"),0);
		$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$s2';"),0);
		if ($s3 == $std_answ) {
			$tmp_score_1 = $tmp_score_1 + $cost;
		}
		break;
		
		case 2:
		$s3 = "Q".$i;
		$s3 = $_POST["$s3"];
		$str = "";
		foreach ($s3 as $each) {
			$str .= $each;
		}
		mysql_query("INSERT INTO `gb_obj_answ` (`id`,`item_id`,`answ`) VALUES ('$answ_id','$s2','$str');");
		$std_answ = mysql_result(mysql_query("SELECT `std_answ` FROM `gb_item_std_answ` WHERE `item_id` = '$s2';"),0);
		$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$s2';"),0);
		if ($str == $std_answ) {
			$tmp_score_2 = $tmp_score_2 + $cost;
		}
		$str = ""; 
		break;
		
		case 3:
		$s3 = "Q".$i;
		$s3 = $_POST["$s3"];
		foreach ($s3 as $each) {
			mysql_query("INSERT INTO `gb_sub_answ` (`id`,`item_id`,`answ`) VALUES ('$answ_id','$s2','$each');");
		}
		break;
		
		case 4:
		$s3 = "Q".$i;
		$s3 = $_POST["$s3"];
		mysql_query("INSERT INTO `gb_sub_answ` (`id`,`item_id`,`answ`) VALUES ('$answ_id','$s2','$s3');");
		break;
	}
}
$tmp_total = $tmp_score_1 + $tmp_score_2;
mysql_query("INSERT INTO `gb_answ_score` (`id`,`score1`,`score2`,`total`) VALUES ('$answ_id','$tmp_score_1','$tmp_score_2','$tmp_total');");

$decision = array_unique($decision);
foreach ($decision as $tmp) {
	$he = $he + $tmp;
}
if (intval($he) <= 3) {
	mysql_query("UPDATE `gb_answer_papers` SET `status` = '1' WHERE `id` = '$answ_id';");
	header("location:final.php");
} else {
	header("location:waiting.php");
}
echo "It is unavilible..";

?>