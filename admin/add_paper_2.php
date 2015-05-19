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
<?php include("../include/head.htm"); ?>
<body>
<h2>选择多选题</h2>
<form name="select_item" mothod="post" action="add_paper_2.php">
<ol>
<?php 
if (!isset($_REQUEST["hooker"])) {
	if (!isset($_GET["page"])) {
		$page = 1;
		$VAR = $_REQUEST["cat"];
		$PAGE_SIZE = $_REQUEST["page_size"];
		$_SESSION["VAR"] = $VAR;
		$_SESSION["PAGE_SIZE"] = $PAGE_SIZE;
		$_SESSION["page"] = $page;
	} else {
		$page = intval($_GET["page"]);
		$VAR = $_SESSION["VAR"];
		$PAGE_SIZE = $_SESSION["PAGE_SIZE"];
		$_SESSION["page"] = $page;
	}
	$BUTTON = '<input type=submit value="暂时保存您的选择">';
} else {
	$page = $_SESSION["page"];
	$PAGE_SIZE = $_SESSION["PAGE_SIZE"];
	$VAR = $_SESSION["VAR"];
	
	$IDGROUP  = "";
	foreach ($_REQUEST["mutigroup"] as $v) {
		$IDGROUP = $IDGROUP.$v.",";
	}
	$_SESSION["IDGROUP"] = $_SESSION["IDGROUP"].$IDGROUP;
	//echo $_SESSION["IDGROUP"];	
	$num_idgroup = count(explode(",",$_SESSION["IDGROUP"])) - 1;
	$BUTTON = "<input type=button value=\"已经选择了 ".$num_idgroup." 道题\" disabled />";
	//store selected into sesstion
}

if ($VAR == 0) {
	$TOTAL = mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type` = '2';"));
	$PAGES = ceil($TOTAL/$PAGE_SIZE);
	$offset = $PAGE_SIZE*($page - 1);
	$rs = mysql_query("SELECT * from `gb_items_warehouse` WHERE `item_type` = '2' ORDER BY `item_id` DESC LIMIT $offset,$PAGE_SIZE;");
} else {
	$TOTAL = mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type` = '2' AND `item_category` = '$VAR';"));
	$PAGES = ceil($TOTAL/$PAGE_SIZE);
	$offset = $PAGE_SIZE*($page - 1);
	$rs = mysql_query("SELECT * from `gb_items_warehouse` WHERE `item_type` = '2' AND `item_category` = '$VAR' ORDER BY `item_id` DESC LIMIT $offset,$PAGE_SIZE;");
}

//count display rows.
while ($myrow = mysql_fetch_array($rs)) {
	$stem = mysql_query("SELECT `item_stem` FROM `gb_item_type2_stem` WHERE `item_id` = '$myrow[0]';");
	$option = mysql_query("SELECT * FROM `gb_item_type2_options` WHERE `item_id` = '$myrow[0]';");
	$image = mysql_query("SELECT `item_image` FROM `gb_item_image` WHERE `item_id` = '$myrow[0]';");
	$email = mysql_query("SELECT `email` FROM `gb_teachers_tb` WHERE `tea_id` = $myrow[6];");
//display
echo "<li><input type=checkbox name=mutigroup[] value=".$myrow[item_id]." />";
echo "<span class=s14>".mysql_result($stem,0)."</span> <span class=s12>(属 ".get_cat_name($myrow[item_category])." 类别，分值：".$myrow[item_score] ."分。由 <a href=mailto:".mysql_result($email,0,0).">".$myrow[item_creation_user]."</a> 于 ".$myrow[5]." 创建) </span>";

echo"
    <table width=100% border=0 cellspacing=1 cellpadding=5>
      <tr>
        <td width=20%><img src=\"";
if (mysql_result($image,0,0) == "") {
	$image = "../pics/shift.gif";
} else {
	$image = mysql_result($image,0,0);
}
echo $image;
echo "		\" class=pad /></td><td>";
while ($myop = mysql_fetch_array($option)) {
	echo "<p>".$myop[2]." ".$myop[1]."</p>";
}
echo "	</td>
      </tr>
    </table>
    </li>
";
}
?>

<input type=hidden name=hooker value=y />
<?php echo $BUTTON; ?>
</ol>
</form>

<?php
//Page elf code view.
$first = 1;
$prev = $page - 1;
$next = $page + 1;
$last = $PAGES;
echo "<div align=center>总共".$PAGES."页&nbsp;&nbsp;";
if ($page > 1) {
	echo "<a href='add_paper_2.php?page=".$first."'>首页</a>&nbsp;&nbsp;";
	echo "<a href='add_paper_2.php?page=".$prev."'>上一页</a>&nbsp;&nbsp;";
} 

if ($page < $PAGES) {
	echo "<a href='add_paper_2.php?page=".$next."'>下一页</a>&nbsp;&nbsp;";
	echo "<a href='add_paper_2.php?page=".$last."'>末页</a>";
}
echo "</div>";
?>
<input type="button" value="结束多选题的选择" onclick="javascript:self.location='ad_pp_inc.php?t=3'" />
<div class="space30"></div><div class="space30"></div><div class="space30"></div>
</body>
</html>