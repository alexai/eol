<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("../include/auth_t.php");
require_once("../include/config.php");
require("../include/funs.php");

if (!isset($_REQUEST["hooker"])) {
	$repword = "";
} else {
	$STAMP = time();
	$PAPER_DATE = date('Ymd');
	$f1 = $_POST['paper_title'];
	$f2 = $_POST['paper_desc'];
	$f3 = $_POST['publish'];
	$f4 = $_POST['time_limit'];
	$f5 = implode(',',$_POST['priv_use']);
	$f6 = implode(',',$_POST['priv_mark']);

	if (!isset($_SESSION["pid"])) {
		mysql_query("INSERT INTO `gb_papers_warehouse` (`paper_title`,`paper_desc`,`paper_public`,`time_limit`,`priv_use`,`priv_mark`,`papers_creation_user`,`papers_creation_date`,`papers_creater_uid`,`papers_creater_gid`) VALUES ('$f1','$f2','$f3','$f4','$f5','$f6','$_SESSION[cname]','$PAPER_DATE','$_SESSION[uid]','$_SESSION[gid]');");
		$PAPER_ID = mysql_insert_id();
		$_SESSION["pid"] = $PAPER_ID;
	} else {
		mysql_query("UPDATE `gb_papers_warehouse` SET `paper_title` = '$f1',`paper_desc` = '$f2',`paper_public` = '$f3',`time_limit` = '$f4',`priv_use` = '$f5',`priv_mark` = '$f6',`papers_creation_user` = '$_SESSION[cname]',`papers_creation_date` = '$PAPER_DATE',`papers_creater_uid` = '$_SESSION[uid]',`papers_creater_gid` = '$_SESSION[gid]' WHERE `paper_id` = '$_SESSION[pid]';");
	}
	header("location:ad_pp_inc.php?t=1");
}
?>
<?php include("../include/head.htm"); ?>
</head>

<body>
<h2>生成考卷</h2>
<form method="post" action="add_paper.php" name="add_paper">
<div>请输入试卷的TITLE：
  <input type="text" class="length" name="paper_title" />
</div>
<div class="space30"></div>
<div>请输入试卷简单的描述：（可选）
  <textarea name="paper_desc" class="length"></textarea>
</div>
<div class="space30"></div>
<div>请输入考试限时：
  <input name="time_limit" type="text" class="short" onkeyup="value=value.replace(/[^\d]/g,'')" />分钟
</div>
<div class="space30"></div>
<div>是否公开试卷：
  <select name="publish">
    <option value="0">否</option>
    <option value="1">是</option>
  </select>
</div>
<div class="space30"></div>
<div>请选择可以使用本卷的组（可多选）：
<select name="priv_use[]" size="5" multiple="multiple" id="priv_use">
<?php
$res = mysql_query("SELECT * FROM `gb_stu_grp`");
while ($u = mysql_fetch_array($res)) {
	echo '<option value="'.$u[id].'">'.$u[sgname].'</option>';
}
?>
</select>
</div>
<div class="space30"></div>
<div>请选择可以阅卷的组（可多选）：
<select name="priv_mark[]" size="5" multiple="multiple" id="priv_mark">
<?php
$res = mysql_query("SELECT * FROM `gb_tea_grp` WHERE `id` > 1");
while ($u = mysql_fetch_array($res)) {
	echo '<option value="'.$u[id].'">'.$u[tgname].'</option>';
}
?>
</select>
</div>
<div class="space30"></div>
<input type="hidden" name="hooker" value="y" />
<div><input type="submit" value="暂存以上信息" /></div>
</form>
<div class="space30"></div>
<div class="space30"></div>
<?php echo $repword; ?>
<div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</html>
