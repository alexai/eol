<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
session_start();
echo "<p>您的考卷已保存，等待教师批阅主观题部分。</p>";
echo "<p>您可在登录后的首页里看到批改完成的考卷。考试结果将寄往您的家长信箱。</p>";
echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
echo "<a href=index.php>返回首页</a>";
unset($_SESSION['pid'],$_SESSION['stamp'],$_SESSION['keyword'],$_SESSION['answ_id']);
?>