<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
$sql = "SELECT * FROM `gb_teachers_tb` WHERE `tea_id` = $_SESSION[uid];";
$qr1 = mysql_query($sql);
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
<link href="lhgchk.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lhgchk.js"></script>
<script type="text/javascript">
lhgchk.rules = [
	{ name : 'password1', required : false, mid : 'msg2', min : 5, type : 'limit', warn : '最少5字节' },
	{ name : 'password2', required : false, type : 'match', to : 'password1', warn : '两次不一样' },
	{ name : 'birthday', required : false, type : 'date', warn : '请输入正确的日期格式MMMM-YY-DD' },
	{ name : 'email', required : false, type : 'email', warn : '请输入正确的Emial格式' },
	{ name : 'tel', required : false, type : 'phone', warn : '请输入正确的电话格式' }
];
window.onload = function()
{
    lhgchk.regform( { form : 'rt', mode : 0 } );
}

function en_ch_pwd() {
	if (document.getElementById("cp").checked == true) {
		document.getElementById("password1").disabled = false;
		document.getElementById("password2").disabled = false;
	} else {
		document.getElementById("password1").disabled = true;
		document.getElementById("password2").disabled = true;
	}
}
</script>
</head>
<body>
<form method="post" id="rt" action="profile.php">
		<fieldset>
			<legend>个 人 信 息 修 改</legend>
			<dl>
				<dt>姓名：</dt>
				<dd><?php echo $_SESSION['cname']; ?></dd>
			</dl>
			<dl>
				<dt>是否修改密码</dt>
				<dd><input type="checkbox" id="cp" onclick="en_ch_pwd()" />修改</dd>
			</dl>
			<dl>
				<dt><label for="password1">密码：</label></dt>
				<dd><input id="password1" name="password1" id="password1" type="password" disabled><span id="msg2">最少5字节</span></dd>
			</dl>
			<dl>
				<dt><label for="password2">确认：</label></dt>
				<dd><input id="password2" name="password2" id="password2" type="password" disabled></dd>
			</dl>
			<dl>
				<dt><label for="birthday">出生日期：</label></dt>
				<dd>
				<input type="text" name="birthday" id="birthday" value=<?php echo mysql_result($qr1,0,4); ?>><button type="reset" id="f_trigger_b">选择</button>
				<script type="text/javascript">
				    Calendar.setup({
				        inputField     :    "birthday",      // id of the input field
				        ifFormat       :    "%Y-%m-%d",       // format of the input field
				        showsTime      :    false,            // will display a time selector
				        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
				        singleClick    :    true,           // double-click mode
				        step           :    1                // show all years in drop-down boxes 
				    });
				</script>
				</dd>
			</dl>
			<dl>
				<dt><label for="email">电子邮箱：</label></dt>
				<dd><input id="email" name="email" type="text" value=<?php echo mysql_result($qr1,0,5); ?>></dd>
			</dl>
			<dl>
				<dt><label for="tel">联系电话：</label></dt>
				<dd><input id="tel" name="tel" type="text" value=<?php echo mysql_result($qr1,0,6); ?>></dd>
			</dl>
			<dl>
				<dt><label for="group">属组：</label></dt>
				<dd>
				<select name="group">
				<?php
				$qr = mysql_query("SELECT * FROM `gb_tea_grp` WHERE `id` > 1;");
				while ($op = mysql_fetch_array($qr)) {
					if ($op[id] == $_SESSION['gid']) {
						echo '<option value="'.$op[id].'" selected>'.$op[tgname].'</option>';
					} else {
						echo '<option value="'.$op[id].'">'.$op[tgname].'</option>';
					}
				}
				?>
				</select>
				<input type="hidden" name="hooker" value="y" />
				</dd>
			</dl>
			<dl>
				<dt>提交：</dt>
				<dd><input name="Submit" type="submit" value="确定提交" /></dd>
			</dl>
		</fieldset>
</form>
<?php include("include/daohang.htm"); ?>
</body>
</html>