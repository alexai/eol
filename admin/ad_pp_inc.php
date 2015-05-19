<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("../include/auth_t.php");
require_once("../include/config.php");
require("../include/funs.php");

if (!isset($_SESSION["pid"])) {
	header("location:add_paper.php");
}
?>
<?php include_once("../include/head.htm"); ?>
<?php 
switch ($_GET["t"]) {
	case 1:
	echo '<h2>选择单选题</h2>
<form name="view" method="post" action="add_paper_1.php">
<div>第一步，选择单选题（目前共有 '.get_item_total(1,1).'  道单选题）。<select name="cat"><option value=0>所有类别</option>';
	$cat = get_categories();
	while ($row = mysql_fetch_array($cat)) {
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	echo '</select>一页显示<input name="page_size" type="text" class="short" value="10" onkeyup="value=value.replace(/[^\d]/g,\'\')" />道题， <input type="submit" name="Submit" value="显示" /></div></form>';
	mysql_close($con);
	break;
	
	case 2:
	unset($_SESSION["VAR"],$_SESSION["PAGE_SIZE"],$_SESSION["page"]);
	echo '<h2>选择多选题</h2>
<form name="view" method="post" action="add_paper_2.php">
<div>第二步，选择多选题（目前共有 '.get_item_total(2,1).'  道多选题）。<select name="cat"><option value=0>所有类别</option>';
	$cat = get_categories();
	while ($row = mysql_fetch_array($cat)) {
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	echo '</select>一页显示<input name="page_size" type="text" class="short" value="10" onkeyup="value=value.replace(/[^\d]/g,\'\')" />道题， <input type="submit" name="Submit" value="显示" /></div></form>';
	mysql_close($con);
	break;
	
	case 3:
	unset($_SESSION["VAR"],$_SESSION["PAGE_SIZE"],$_SESSION["page"]);
	echo '<h2>选择填空题</h2>
<form name="view" method="post" action="add_paper_3.php">
<div>第三步，选择填空题（目前共有 '.get_item_total(3,1).'  道填空题）。<select name="cat"><option value=0>所有类别</option>';
	$cat = get_categories();
	while ($row = mysql_fetch_array($cat)) {
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	echo '</select>一页显示<input name="page_size" type="text" class="short" value="10" onkeyup="value=value.replace(/[^\d]/g,\'\')" />道题， <input type="submit" name="Submit" value="显示" /></div></form>';
	mysql_close($con);
	break;
	
	case 4:
	unset($_SESSION["VAR"],$_SESSION["PAGE_SIZE"],$_SESSION["page"]);
	echo '<h2>&#x9009;&#x62E9;&#x7B80;&#x7B54;&#x9898;</h2>
<form name="view" method="post" action="add_paper_4.php">
<div>第四步，选择简答题（目前共有 '.get_item_total(4,1).'  道简答题）。<select name="cat"><option value=0>所有类别</option>';
	$cat = get_categories();
	while ($row = mysql_fetch_array($cat)) {
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	echo '</select>一页显示<input name="page_size" type="text" class="short" value="10" onkeyup="value=value.replace(/[^\d]/g,\'\')" />道题， <input type="submit" name="Submit" value="显示" /></div></form>';
	mysql_close($con);
	break;
}
?>
</body>
</html>
