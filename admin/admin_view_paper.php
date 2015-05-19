<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("../include/auth_t.php");
require_once("../include/config.php");
require("../include/funs.php");
include("/var/www/html/gb/fckeditor/fckeditor.php");

if (!isset($_SESSION["pid"])) {
	header("location:add_paper.php");
}

$paper_id = $_SESSION["pid"];
$array_ids = explode(',',$_SESSION["IDGROUP"]);
$array_ids = trim_last($array_ids);
$array_ids = array_unique($array_ids);

$paper = mysql_query("SELECT * FROM `gb_papers_warehouse` WHERE `paper_id` = '$paper_id';");

?>
<?php include("../include/head.htm"); ?>
<body>
<div class="s12">本卷共 <?php echo count($array_ids); ?>  道题，总分为 <?php echo get_total_score($array_ids); ?> 分。</div>
<div align="center"><h2><?php echo mysql_result($paper,0,paper_title); ?></h2></div>
<div class="s12"><?php echo mysql_result($paper,0,paper_desc); ?><br /><br />限时 <?php echo mysql_result($paper,0,time_limit); ?> 分钟。 由 <?php echo mysql_result($paper,0,papers_creation_user) ?> 于 <?php echo mysql_result($paper,0,papers_creation_date) ?> 创建。</div>
<div class="space30"></div>

<?php
echo '<form method=post action="save_paper.php">';
view_paper($array_ids);
echo "<input type=submit value=保存试卷 />";
echo "</form>";
?>
</body>
</html>
