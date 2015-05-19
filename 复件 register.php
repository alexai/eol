<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
include("include/config.php");
include("include/head1.htm");
if ($allow_reg != true) {
	echo "系统目前不允许注册新用户";
	exit;
}
?>
  <!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="cal/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="cal/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="cal/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="cal/calendar-setup.js"></script>
  <script language="Javascript">
  function view_s() {
	document.getElementById("student").style.display = "block";
	document.getElementById("teacher").style.display = "none";
	document.fs.username.focus();
}
  function view_t() {
	document.getElementById("student").style.display = "none";
	document.getElementById("teacher").style.display = "block";
	document.ft.username.focus();
}
</script>
<script type="text/javascript" src="lhgchk.js"></script>
<script type="text/javascript">
lhgchk.rules = [
    { name : 'username', required : true, mid : 'msg1', type : 'limit|eng', min : 4, max : 12, warn : '错误|只能是英文' },
	{ name : 'Name', mid : 'msg2', type : 'limit|ajax', max : 20, warn : '过长|已存在，请换个', url : 'test.asp?val=' },
	{ name : 'Password1', required : true, mid : 'msg3', min : 6, type : 'limit', warn : '最少6字节' },
	{ name : 'Password2', required : true, type : 'match', to : 'Password1', warn : '两次不一样' },
	{ name : 'Email', type : 'email', warn : '请输入正确的Emial格式' },
	{ name : 'IPAddress', type : 'ip', warn : '请输入正确的IP地址' },
	{ name : 'Birthday', type : 'date', warn : '请输入正确的日期格式MMMM-YY-DD' },
	{ name : 'Year', type : 'rang', min : 18, max : 35, warn : '在18-35之间' },
	{ name : 'QQ', type : 'qq', warn : '请输入5-11位的QQ号' },
	{ name : 'Telephone', type : 'phone', warn : '请输入正确的电话格式' },
	{ name : 'Photo', type : 'filter', accept: 'jpg|gif|png', warn : '请选择jpg、gif或png格式的图片' },
	{ name : 'Fav', type : 'group', min : 2, warn : '最少选2项' },
	{ name : 'Good', type : 'group', noselected : '4', warn : '其值不能选a' },
	{ name : 'Year', required : true, type : 'rang', min : 18, max : 35, warn : '在18-35之间' }
];
window.onload = function()
{
    lhgchk.regform( { form : 'demo', mode : 0 } );
}
</script>
</head>
<body>
<div style="margin-left:50px;margin-top:50px">---新 用 户 注 册---<br /><br />
 <label><input type="radio" name="level" onfocus="view_s()" />学生</label>
 <label><input type="radio" name="level" onfocus="view_t()" />教师</label>
</div>
<div id="teacher" style="line-height:180%;margin-left:50px;margin-top:50px;display:none">
<form method="post" id="ft" action="add_user.php">
姓    名：<input type="text" name="username" id="username" onblur="NameRegCheck(this)" /><br />
密    码：<input type="password" name="passwd" id="passwd" /><br />
再次输入：<input type="password" name="retype" id="retype" /><br />
性    别：<input type="radio" name="gendar" value="男" />男 
          <input type="radio" name="gendar" value="女" checked="checked" />女<br />
出生日期： <input type="text" name="birthday" id="birthday" /><button type="reset" id="f_trigger_b">选择</button><br />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "birthday",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
电子邮箱：<input type="text" name="email" id="email"/><br />
电    话：<input type="text" name="tel" id="tel" /><br />
属    组：<select name="group">
<?php
$qr = mysql_query("SELECT * FROM `gb_tea_grp` WHERE `id` > 1;");
while ($op = mysql_fetch_array($qr)) {
	if ($op[id] == 2) {
		echo '<option value="'.$op[id].'" selected>'.$op[tgname].'</option>';
	} else {
		echo '<option value="'.$op[id].'">'.$op[tgname].'</option>';
	}
}
?>
</select>
<input type="hidden" name="level" value="t" /><br />
<input type="submit" value="提交" onclick=chkformt() />
</form>
</div>

<div id="student" style="line-height:180%;margin-left:50px;margin-top:50px;display:block">
<form method="post" id="fs" action="add_user.php">
姓    名：<input type="text" name="username" id="username" /><br />
密    码：<input type="password" name="passwd" id="passwd" /><br />
再次输入：<input type="password" name="retype" id="retype" /><br />
性    别：<input type="radio" name="gendar" value="男" checked="checked" />男 
          <input type="radio" name="gendar" value="女" />女<br />
出生日期： <input type="text" name="birthday" id="birthday1" /><button type="reset" id="f_trigger_b1">选择</button><br />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "birthday1",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    false,            // will display a time selector
        button         :    "f_trigger_b1",   // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
电子邮箱：<input type="text" name="email" id="email"/><br />
家庭地址：<input type="text" name="addr" id="addr" /><br />
家长信箱：<input type="text" name="par" id="par" /><br />
电    话：<input type="text" name="tel" id="tel" /><br />
属    组：<select name="group">
<?php
$qr = mysql_query("SELECT * FROM `gb_stu_grp`;");
while ($op = mysql_fetch_array($qr)) {
	if ($op[id] == 1) {
		echo '<option value="'.$op[id].'" selected>'.$op[sgname].'</option>';
	} else {
		echo '<option value="'.$op[id].'">'.$op[sgname].'</option>';
	}
}
mysql_close();
?>
</select>

<input type="hidden" name="level" value="s" /><br />
<input type="submit" value="提交" onclick=chkforms() />
</form>
</div>
</body>
</html>