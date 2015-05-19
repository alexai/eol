<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
include("include/class.phpmailer.php");
require_once("include/config.php");
$answ_id = $_SESSION['answ_id'];
$id = $_SESSION['uid'];

echo "<p>您的考卷已保存。您可在登录后的首页里看到答过的考卷。考试结果将寄往您的家长信箱。</p>";

$SCORE = mysql_result(mysql_query("SELECT `score1`,`score2`,`total` FROM `gb_answ_score` WHERE `id` = '$answ_id';"),0,2);
$SCORE1 = mysql_result(mysql_query("SELECT `score1`,`score2`,`total` FROM `gb_answ_score` WHERE `id` = '$answ_id';"),0,0);
$SCORE2 = mysql_result(mysql_query("SELECT `score1`,`score2`,`total` FROM `gb_answ_score` WHERE `id` = '$answ_id';"),0,1);
echo "<p>您已完成的测试，得分为 ".$SCORE." 分。</p>";
echo "<p>其中，单选题得分 ".$SCORE1." 分，多选题得分 ".$SCORE2." 分。</p>";

echo "</td></tr></table><p>&nbsp;</p>";
echo "<a href=index.php>返回首页</a>";

$qr = mysql_query("SELECT * FROM `gb_students_tb` WHERE `stu_id` = '$id';");
$pmail = mysql_result($qr,0,par_email);

$mail = new PHPMailer();
$mail->CharSet="utf-8";
$mail->IsSMTP();
$mail->Host="10.11.22.25";
$mail->Port=25;
$mail->From = $admin_email;
$mail->FromName = "Admin";
$mail->SMTPAuth = false;
//$mail->Username = "aai";
//$mail->Password = "ayzfp";
$mail->Subject = "考试成绩通知书";
$t = getdate($_SESSION['stamp']);
$html = mysql_result($qr,0,cname)." 于 ".$t[year]."年".$t[mon]."月".$t[mday]."日进行的考试，得分为 ".$SCORE." 分。您可以使用以下密码：<br /><br />".$_SESSION['keyword']."<br /><br />到这个地址去查询：<br /><br /><a href=".$domain.">".$domain."</a>.";
$mail->Body = $html;
$mail->IsHTML(true);
$mail->WordWrap = 50;
$mail->AddReplyTo($admin_email);
$mail->AddAddress($pmail);
$mail->Send();

unset($_SESSION['pid'],$_SESSION['stamp'],$_SESSION['keyword'],$_SESSION['answ_id']);
mysql_close($con);
?>
