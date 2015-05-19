<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("../include/auth_t.php");
require_once("../include/config.php");
require("../include/funs.php");

$paper_id = $_SESSION["pid"];
$array_ids = explode(',',$_SESSION["IDGROUP"]);
$array_ids = trim_last($array_ids);
$array_ids = array_unique($array_ids);
$paper = mysql_query("SELECT * FROM `gb_papers_warehouse` WHERE `paper_id` = '$paper_id';");

$item_ids = implode(",",$array_ids);
$paper_total_score = get_total_score($array_ids);

$qr = mysql_query("UPDATE `gb_papers_warehouse` SET `items_ids` = '$item_ids',`paper_total_score` = '$paper_total_score' WHERE `paper_id` = '$paper_id';");

unset($_SESSION["pid"],$_SESSION["VAR"],$_SESSION["PAGE_SIZE"],$_SESSION["page"],$_SESSION["IDGROUP"]);

echo "试卷已保存，编号为：".$paper_id."<br /><br />";

echo "<a href=index.php>返回管理页面</a>";
?>