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
	$GETID = add_item_type4();
	$repword = "题目已加入题库，题号为: ".$GETID;
}
?>
<?php
include_once("../include/head.htm");
include("/var/www/html/eol/fckeditor/fckeditor.php");
?>
</head>

<body>
<form method="post" action="add_item_type4.php" id="add_item" enctype="multipart/form-data">
<div align="center">
  <h2>增加简答题  </h2>
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
    <input name="item_type4_score" type="text" id="item_type4_score" onkeyup="value=value.replace(/[^\d]/g,'')" />
    <br />
    <br />
  请选择图像文件（可选，大小不超过512K）
  <input type="hidden" name="MAX_FILE_SIZE" value="524288" />，
  <input name="item_image" type="file" id="item_image" />
  <hr />
  编辑题干：<br />
  <br />
  <input name="stem" type="text" class="length" /><br /><br />
  请输入参考答案（可选项）：<br /><br />
  <!--textarea name="reffer" class="length"></textarea-->
<?php

$oFCKeditor = new FCKeditor("reffer");
$oFCKeditor->BasePath = '/eol/fckeditor/';
$oFCKeditor->ToolbarSet = 'Default';
$oFCKeditor->Width = '75%';
$oFCKeditor->Height = '250';
$oFCKeditor->Value = '';
$oFCKeditor->Create();
?>
  <br /><br />
  <div class="space30"></div>
  <input type="hidden" name="hooker" value="y" />
</div>
<div class="space30"></div>
<div><input type="submit" value="保存"></div>
</form>
<div class="space30"></div><div class="space30"></div><div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</body>
</html>
