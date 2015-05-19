<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
include_once("include/config.php");
require("include/normal_funs.php");
include("include/head1.htm");

$keyword = $_POST['keyword'];

$qr = mysql_query("SELECT * FROM `gb_answer_papers` WHERE `keyword` = '$keyword';");
if (mysql_num_rows($qr) == 0) {
	echo '<script>alert("没有找到与您的KEYWORD对应的考卷！请检查您的KEYWORD是否输入正确");window.location.href="login.php";</script>';
	exit;
}

$uid = mysql_result($qr,0,stu_id);
$pid = mysql_result($qr,0,paper_id);
$qr1 = mysql_query("SELECT * FROM `gb_students_tb` WHERE `stu_id` = '$uid';");
$gid = mysql_result($qr1,0,group);

echo "<body><p>
<table border=1 cellspacing=1 cellpadding=8 width=80%>
<tr>
 <td>ID 号</td><td>";
echo $uid;
echo "</td><td>姓  名</td><td>";
echo mysql_result($qr1,0,cname);
echo "</td></tr><tr><td>性  别</td><td>";
echo mysql_result($qr1,0,gendar);
echo "</td><td>生  日</td><td>";
echo mysql_result($qr1,0,birthday);
echo "</td></tr><tr><td>E-mail</td><td>";
echo mysql_result($qr1,0,email);
echo "</td><td>电  话</td><td>";
echo mysql_result($qr1,0,tel);
echo "</td></tr><tr><td>组  别</td><td>";
$qr4 = mysql_query("SELECT `sgname` FROM `gb_stu_grp` WHERE `id` = '$gid';");
echo mysql_result($qr4,0,0);
echo "</td><td>地  址</td><td>";
echo mysql_result($qr1,0,addr);
echo "</td></tr><tr><td colspan=4>";
$D = getdate(mysql_result($qr,0,4));
$PAPER_ID = mysql_result($qr,0,1);
$answ_id = mysql_result($qr,0,0);
$qr2 = mysql_query("SELECT * FROM `gb_papers_warehouse` WHERE `paper_id` = '$PAPER_ID';");
$TITLE = mysql_result($qr2,0,1);
$FULLSCORE = mysql_result($qr2,0,5);
$qr3 = mysql_query("SELECT `score1`,`score2`,`total`,`score3`,`score4` FROM `gb_answ_score` WHERE `id` = '$answ_id';");
$SCORE = mysql_result($qr3,0,2);
$SCORE1 = mysql_result($qr3,0,0);
$SCORE2 = mysql_result($qr3,0,1);
$SCORE3 = mysql_result($qr3,0,3);
$SCORE4 = mysql_result($qr3,0,4);
echo "<p>".mysql_result($qr1,0,cname)." 于 ".$D[year]."年".$D[mon]."月".$D[mday]."日完成的 ".$TITLE." 测试，得分为 ".$SCORE." 分。（总分".$FULLSCORE."分）</p>";
echo "<p>其中，单选题得分 ".$SCORE1." 分，多选题得分 ".$SCORE2." 分，填空题 ".$SCORE3." 分，简答题 ".$SCORE4." 分。</p>";

echo "</td></tr></table><p>&nbsp;</p>";

$arr = explode(",",mysql_result($qr2,0,3));
view_result($arr,$answ_id);
echo "<a href=login.php>返回</a>";

mysql_close($con);
?>
</body>
</html>