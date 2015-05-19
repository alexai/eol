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
	$GETID = add_item_type3();
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
<form method="post" action="add_item_type3.php" id="add_item" enctype="multipart/form-data">
<div align="center">
  <h2>增加填空题  </h2>
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
    请输入本题的分值
    <input name="item_type3_score" type="text" id="item_type1_score" onkeyup="value=value.replace(/[^\d]/g,'')" />
    <br />
    <br />
  请选择图像文件（可选，大小不超过512K）
  <input type="hidden" name="MAX_FILE_SIZE" value="524288" />，
  <input name="item_image" type="file" id="item_image" />
  <hr />
  编辑题干：请先确定好了描述和空格的位置，再填写内容。例如：<br />
  <br />
  <input name="textfield" type="text" class="blank" />
  <input name="textfield2" type="text" class="xuxian" value="第一段文字内容" />
  <input name="textfield3" type="text" class="blank" />
  <input name="textfield4" type="text" class="xuxian" value="第二段文字内容" />
  。。。。<br /><br />
  <input name="textfield5" type="text" class="xuxian" value="第一段文字内容" />
  <input name="textfield6" type="text" class="blank" />
  <input name="textfield7" type="text" class="xuxian" value="第二段文字内容" />
  <input name="textfield8" type="text" class="blank" />
  。。。。<hr />
  <div id="a1"></div>
  <div class="space30"></div>
  <div id="a2">参考答案（可选项）：</div>
  <div class="space30"></div>
  <input type="hidden" name="op_num" id="op_num" value="" />
  <input type="hidden" name="hooker" value="y" />
  <input type="button" value="添加文字段" onclick=add_input("a1",0) />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="button" value="添加空格段" onclick=add_input("a1",1) />
</div>
<div class="space30"></div>
<!--div>请不要忘记选择正确的答案！如不选则默认为A。<br /><br /></div-->
<div><input type="submit" value="保存"></div>
</form>
<div class="space30"></div><div class="space30"></div><div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</body>
</html>
