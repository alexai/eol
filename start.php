<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
require("include/auth_basic.php");
require_once("include/config.php");
require("include/normal_funs.php");
include("include/head1.htm");

if (!isset($_GET['pid'])) {
	echo 'You have not chosen a paper! <a href="index.php">Back</a>';
	exit;
}
$pid = $_GET['pid'];
/*if (mysql_result(mysql_query("SELECT `paper_public` FROM `gb_papers_warehouse` WHERE `paper_id` = '$pid';"),0) == 0) {
	echo 'This paper has not be published! <a href="index.php">Back</a>';
	exit;
}*/
$qr = mysql_query("SELECT `priv_use` FROM `gb_papers_warehouse` WHERE `paper_id` = '$pid';");
$whouse = explode(',',mysql_result($qr,0,0));
if (in_array($_SESSION['gid'],$whouse) == false) {
	echo '<script>alert("You have no privilege to use it");window.location.href="index.php";</script>';
	exit;
}
$_SESSION['pid'] = $pid;
$_SESSION['stamp'] = time();
?>
<?php
$qr = mysql_query("SELECT `paper_title`,`paper_desc`,`items_ids`,`paper_total_score`,`time_limit` FROM `gb_papers_warehouse` WHERE `paper_id` = '$pid';");
echo '<body><input type="hidden" value="'.mysql_result($qr,0,4).'" id="lmt" />';
?>
<div align="center"><h2><?php echo mysql_result($qr,0,0); ?></h2></div>
<p><?php echo mysql_result($qr,0,1); ?>&nbsp;&nbsp;&#x603B;&#x5206;&#xFF1A;<?php echo mysql_result($qr,0,3); ?></p>
<form method="post" action="save_answ.php" name="answ">
<!--Floating begin-->
<div id="FloatDIV" style="position: absolute;top: 0px; border-right: activeborder 1px solid; border-top: activeborder 1px solid; border-left: activeborder 1px solid; border-bottom: activeborder 1px solid;">
<!--Clock begin-->
<script language="JavaScript">
<!-- //
var M = 60000;
var limit = document.getElementById("lmt").value;
limit = limit*M;
var startTime = new Date();
var EndTime=startTime.getTime()+limit;
function GetRTime(){
var NowTime = new Date();
var nMS =EndTime - NowTime.getTime();
//var nD =Math.floor(nMS/(1000 * 60 * 60 * 24));
var nH=Math.floor(nMS/(1000*60*60)) % 24;
var nM=Math.floor(nMS/(1000*60)) % 60;
var nS=Math.floor(nMS/1000) % 60;
 //document.getElementById("RemainD").innerHTML=nD;
 document.getElementById("RemainH").innerHTML=nH;
 document.getElementById("RemainM").innerHTML=nM;
 document.getElementById("RemainS").innerHTML=nS;
if(nMS>1*1000&&nMS<=2*1000)
{
//alert("time out");
//document.getElementById("submit").disabled=true;
document.forms[0].submit();
return false;
}

setTimeout("GetRTime()",1000);
}
window.onload=GetRTime;
// -->
</script>
<div id="CountMsg"><strong id="RemainD"></strong><strong id="RemainH">XX</strong>&#x65F6;<strong 

id="RemainM">XX</strong>&#x5206;<strong id="RemainS">XX</strong>&#x79D2;</div>
<!--Clock End-->
</div>
<!--Floating end-->
<hr />
<?php
$q_arr = explode(",",mysql_result($qr,0,2));
view_paper($q_arr);
mysql_close($con);
?>
<input type="submit" value="&#x4EA4;&#x5377;" id="answform" />
</form>
<div class="space30"></div><div class="space30"></div>
</body>
<script language="javascript" type="text/javascript">
var MarginLeft = 30;   //浮动层离浏览器右侧的距离
var MarginTop = 100;     //浮动层离浏览器顶部的距离
var Width = 100;        //浮动层宽度
var Heigth= 45;        //浮动层高度

//设置浮动层宽、高
function Set()
{
    document.getElementById("FloatDIV").style.width = Width;
    document.getElementById("FloatDIV").style.height = Heigth;
}

//实时设置浮动层的位置
function Move()
{
    document.getElementById("FloatDIV").style.top = document.documentElement.scrollTop + MarginTop;
    document.getElementById("FloatDIV").style.left = document.documentElement.clientWidth - Width - MarginLeft;
    setTimeout("Move();",100);
}

Set();
Move();
</script>
</html>
