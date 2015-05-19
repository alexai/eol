<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require_once("../include/auth_a.php");
require_once("../include/config.php");
require("../include/funs.php");

if (!isset($_REQUEST["hooker"])) {
	$repword = "";
} else {
	$GETID = edit_cat();
	$repword = "修改保存成功，共有 ".$GETID." 项改动。";
}
?>
<?php include_once("../include/head.htm"); ?>
<script language="Javascript">
<!--
M_ITEM = "";
-->
</script>
</head>

<body>
<div>
<?php echo $repword; ?>
</div>
<h2>编辑分类</h2>
<div class="space30"></div>
<form method="post" action="edit_cat.php">
<table width="300" border="1" cellspacing="1" cellpadding="5">
  <tr>    
    <td>编号</td>
    <td>名称</td>
    <td>&nbsp;</td>
  </tr>
	<?php
		$cat = get_categories();
		while ($row = mysql_fetch_array($cat)) {
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td><input name=\"cat".$row[0]."\" id=\"cat".$row[0]."\" value=\"".$row[1]."\" disabled/></td>";
			echo "<td><input type=button value=修改 onclick=enable(\"cat".$row[0]."\")></td>";
			echo "</tr>";
		}
	?>
</table><br /><br />
<input type="hidden" id="SELT" name="SELT" value="" />
<input type="hidden" name="hooker" value="y" />
<input type="submit" value="保存修改" />
</form>
<div class="space30"></div>
<div class="space30"></div><div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</body>
</html>