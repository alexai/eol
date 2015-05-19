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
<link href="lhgchk.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="lhgchk.js"></script>
<script type="text/javascript">
lhgchk.rules = [
    { name : 'username', required : true, mid : 'msg1', type : 'limit|chinese', min : 2, max : 5, warn : '错误|只能是中文' },
	{ name : 'password1', required : true, mid : 'msg2', min : 5, type : 'limit', warn : '最少5字节' },
	{ name : 'password2', required : true, type : 'match', to : 'password1', warn : '两次不一样' },
	{ name : 'birthday', required : true, type : 'date', warn : '请输入正确的日期格式MMMM-YY-DD' },
	{ name : 'email', required : true, type : 'email', warn : '请输入正确的Emial格式' },
	{ name : 'tel', required : false, type : 'phone', warn : '请输入正确的电话格式' }
];
window.onload = function()
{
    lhgchk.regform( { form : 'rt', mode : 0 } );
}
</script>
</head>
<body>
<div style="margin-left:50px;margin-top:50px">---带*号的为必填项---<br /><br /></div>
<form method="post" id="rt" action="adduser.php">
		<fieldset>
			<legend>教 师 注 册</legend>
			<dl>
				<dt><label for="yzm">验证码</label></dt>
				<dd>
				<input type="text" name="yzm" id="yzm" />
				<?php echo '<img src=a.php border=0 align=absbottom id=yzm onclick=\'this.src="a.php"\'>'; ?> 
				看不清点击图片换一张（不分大小写）
				</dd>
			</dl>
			<dl>
				<dt>* 姓名：</dt>
				<dd><input id="username" type="text" name="username" /><span id="msg1">注册用户名长度限制为2-5个字</span></dd>
			</dl>
			<dl>
				<dt><label for="password1">* 密码：</label></dt>
				<dd><input id="password1" name="password1" type="password" /><span id="msg2">最少5字节</span></dd>
			</dl>
			<dl>
				<dt><label for="password2">确认：</label></dt>
				<dd><input id="password2" name="password2" type="password" /></dd>
			</dl>
			<dl>
				<dt><label for="gendar">* 性别：</label></dt>
				<dd><input id="male" name="gendar" value="男" type="radio" checked="checked" />男 
					<input id="female" name="gendar" value="女" type="radio" />女
				</dd>
			</dl>
			<dl>
				<dt><label for="birthday">* 出生日期：</label></dt>
				<dd>
				<input type="text" name="birthday" id="birthday" /><button type="reset" id="f_trigger_b">选择</button>
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
				<dt><label for="email">*电子邮箱：</label></dt>
				<dd><input id="email" name="email" type="text" /></dd>
			</dl>
			<dl>
				<dt><label for="tel">联系电话：</label></dt>
				<dd><input id="tel" name="tel" type="text" /></dd>
			</dl>
			<dl>
				<dt><label for="group">属组：</label></dt>
				<dd>
				<select name="group">
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
				</dd>
			</dl>
			<dl>
				<dt>提交：</dt>
				<dd><input name="Submit" type="submit" value="确定提交" /></dd>
			</dl>
		</fieldset>
		<input type="hidden" name="level" value="t" />
</form>
</div>
</body>
</html>