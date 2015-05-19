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
	$GETID = add_cat();
	$repword = "添加分类成功！编号为：".$GETID;
}
?>
<?php include_once("../include/head.htm"); ?>
</head>

<body>
<div>
<?php echo $repword; ?>
</div>
<div class="space30"></div>

<table width="300" border="1" cellspacing="1" cellpadding="5">
  <tr>
    <td colspan="2">当前分类列表</td>
  </tr>
	<?php
		$cat = get_categories();
		while ($row = mysql_fetch_array($cat)) {
			echo "<tr><td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td></tr>";
	}
	?>
</table>
<div class="space30"></div>
<form method="post" action="add_cat.php">
<input type="text" name="newcat" /><br /><br />
<input type="hidden" name="hooker" value="y" />
<input type="submit" value="增加分类" />
</form>
<div class="space30"></div><div class="space30"></div>
<?php include_once("../include/daohang.htm"); mysql_close($con); ?>
</body>
</html>