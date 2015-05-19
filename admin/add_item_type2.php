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
	$GETID = add_item_type2();
	$repword = "题目已加入题库，题号为: ".$GETID;
}
?>
<?php include_once("../include/head.htm"); ?>
<script language="javascript">
<!--
var num = 0;
-->
</script>
</head>

<body>
<form method="post" action="add_item_type2.php" id="add_item" enctype="multipart/form-data">
<div align="center">
  <h2>增加多选题  </h2>
</div>
<div>
<?php echo $repword; ?>
</div>
<div class="space30"></div>
<div>请选择所属类别<br /><br />
	<select name="cat">
	<?php
	$cat = get_categories();
	while ($row = mysql_fetch_array($cat)) {
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
	?>
	</select><br /><br />
	请输入题干的文字<br /><br />
    <input name="item_type2_stem" type="text" class="length" id="item_type2_stem" class="length"/>
    <br />
    <br />
    请输入本题的分值
    <input name="item_type2_score" type="text" id="item_type2_score" onkeyup="value=value.replace(/[^\d]/g,'')" />
    <br />
    <br />
  请选择图像文件（可选，大小不超过512K）
  <input type="hidden" name="MAX_FILE_SIZE" value="524288" />，
  <input name="item_image" type="file" id="item_image" />
  <br />
  <br />
  以下编辑答案选项：（请先确定了选项数目，再填写内容）<br />
  <br />
  <br />
  <div id="a1"></div>
  <input type="hidden" name="op_num" id="op_num" value="" />
  <input type="hidden" name="hooker" value="y" />
  <input name="add_op" type="button" value="增加答案选项" onclick=add_muti_option("a1") />
</div>
<div class="space30"></div>
<div>请不要忘记选择正确的答案！<br /><br />
</div>
<div><input type="submit" value="保存"></div>
</form>
<div class="space30"></div><div class="space30"></div><div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</body>
</html>
