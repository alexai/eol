<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("include/auth.php");
require_once("include/config.php");
include("include/head1.htm");

if (!isset($_SESSION['uid'])) {
	header("location:login.php");
	exit;
}
?>
<link href="lhgchk.css" rel="stylesheet" type="text/css" />
</head>
<body>
<fieldset style="padding:10px">
	<legend>您已参加过的测试</legend>
	<table width="90%" border="1" cellspacing="0" cellpadding="8" bordercolor="#ffffff"   bordercolorlight="#000000">		<tr class="row">
		<td>试卷名称</td>
		<td>总分</td>
		<td>考试时间</td>
		<td>得分</td>
		<td>阅卷教师</td>
	</tr>
	<?php
	$qr = mysql_query("SELECT `paper_id`,`time`,`status`,`whomarked`,`id` FROM `gb_answer_papers` WHERE `stu_id` = '$_SESSION[uid]' AND `status` = '1' ORDER BY `id` DESC;");
	while($e = mysql_fetch_array($qr)) {
		$qr1 = mysql_query("SELECT `paper_title`,`paper_total_score` FROM `gb_papers_warehouse` WHERE `paper_id` = '$e[0]';");
		$qr2 = mysql_query("SELECT `total` FROM `gb_answ_score` WHERE `id` = '$e[4]';");
		
		echo '<tr class="row"><td><a href="query_answ_paper.php?id='.$e[4].'">'.mysql_result($qr1,0,0).'</a></td>';
		echo '<td>'.mysql_result($qr1,0,1).'</td>';
		echo '<td>'.date('Y-m-d',$e[1]).'</td>';
		echo '<td>'.mysql_result($qr2,0,0).'</td>';
		echo '<td>'.$e[3].'&nbsp;</td>';
		echo '</tr>';		
	}
	?>
	</table>
</fieldset>
<br /><br />
<fieldset style="padding:10px">
	<legend>当前开放的测试</legend>
	<table width="90%" border="1" cellspacing="0" cellpadding="8" bordercolor="#ffffff"   bordercolorlight="#000000">
	 <tr class="row">
		<td>试卷名称</td>
		<td>简单描述</td>
		<td>使用对象</td>
		<td>总分</td>
		<td>限时</td>
	</tr>
	<?php
	$qr = mysql_query("SELECT `paper_id`,`paper_title`,`paper_desc`,`priv_use`,`paper_total_score`,`time_limit` FROM `gb_papers_warehouse` WHERE `paper_public` = '1';");
	while ($e = mysql_fetch_array($qr)) {
		echo '<tr class="row">';
		echo '<td><a href="start.php?pid='.$e[0].'">'.$e[1].'</a></td>';
		echo '<td>'.$e[2].'</td>';
		echo '<td>';
		$whouse = explode(',',$e[3]);
		foreach ($whouse as $w) {
			$qr2 = mysql_query("SELECT `sgname` FROM `gb_stu_grp` WHERE `id` = '$w';");
			echo mysql_result($qr2,0,0).'<br />';
		}
		echo '</td>';
		echo '<td>'.$e[4].'</td>';
		echo '<td>'.$e[5].' 分钟</td>';
		echo '</tr>';
	}
	?>
	</table>
</fieldset>
<?php include_once("include/daohang.htm"); ?>
<br /><br /><br /><br /><br /><br />
</body>
</html>