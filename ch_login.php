<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
require_once("include/config.php");
include_once("include/head1.htm");

$name = $_POST["username"];
$pwd = $_POST["passwd"];
?>
</head>
<body>
<?php
if ($_POST["level"] == 's') {
	$qr = "SELECT * FROM `gb_students_tb` WHERE `cname`='$name';";
} elseif ($_POST["level"] == 't') {
	$qr = "SELECT * FROM `gb_teachers_tb` WHERE `cname`='$name';";
} else {
	echo "Some strange thing happened!";
	exit;
}
$res = mysql_query($qr);
if (mysql_num_rows($res) == 0) {
	header("location:login.php");
} elseif (mysql_num_rows($res) > 1) {
	echo '<form method="post" action="ch_login_1.php">';
	echo '<div style="margin-left:30px">姓名重复冲突，请在列表里选择您注册帐号的ID号<br /><br />';
	echo '<select name=chooseid size=5>';
	while ($rst = mysql_fetch_array($res)) {
		echo '<option value="'.$rst[0].'">'.$rst[0].'</option>';
	}
	echo '</select>';
	echo '<input type="hidden" name="pwd" value="'.md5($pwd).'" />';
	echo '<input type="hidden" name="cname" value="'.$name.'" />';
	echo '<input type="hidden" name="level" value="'.$_POST["level"].'" />';
	echo '<input type="submit" value="重新验证">';
	echo '</div></form>';
} elseif (mysql_result($res,0,disabled) == 'yes') {
	echo '<script>alert("您的帐号已经被禁止使用，请联系管理员");location.href="login.php";</script>';
} else {
	if (mysql_result($res,0,pwd) == md5($pwd)) {
		$_SESSION['uid'] = mysql_result($res,0,0);
		$_SESSION['cname'] = $name;
		$_SESSION['gid'] = mysql_result($res,0,group);
		$_SESSION['level'] = $_POST['level'];
		if ($_POST['level'] == 's') {
			header("location:index.php");
		} else {
			header("location:admin/index.php");
		}
		echo "You are logged!";
	} else {
		header("location:login.php");
	}	
}
mysql_close();
?>
</body>
</html>