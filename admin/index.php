<?php

/**
 * @Alex Ai swallow13@163.com 
 * @copyright 2009
 */
require_once("../include/auth_t.php");
?>
<?php include_once("../include/head.htm"); ?>
</head>

<body>
<div align="center">
  <h1>在线测试管理</h1>
</div>
<div>
  <h2>考卷管理
  </h2>
  <div >
    <div>
      <table width="90%" border="0" cellspacing="1" cellpadding="5">
        <tr>
          <td><a href="add_paper.php">增加试卷</a></td>
          <td>搜索试卷</td>
          <td>修改试卷</td>
        </tr>
      </table>
      <div class="space30" ></div>
    </div>
  </div>
</div>
<div>
  <h2>试题管理
  </h2>
  <table width="90%" border="0" cellspacing="1" cellpadding="5">
    <tr>
      <td><a href="add_item_type1.php">增加单选题</a></td>
      <td><a href="add_item_type2.php">增加多选题</a></td>
      <td><a href="add_item_type3.php">增加填空题</a></td>
      <td><a href="add_item_type4.php">增加简答题</a></td>
    </tr>
    <tr>
      <td>试题搜索</td>
      <td>最常用试题TOP10</td>
      <td>最难试题TOP10</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div class="space30" ></div>
<div>
  <h2>阅卷</h2>
  <table width="90%" border="0" cellspacing="1" cellpadding="5">
    <tr>
      <td><a href="list_unmark_papers.php">当前未阅的考卷</a></td>
      <td>查询已阅的考卷</td>
      <td>得分最高的考卷TOP10（按得分的百分比）</td>
    </tr>
  </table>
</div>
<div class="space30" ></div>
<div>
  <h2>类别管理</h2>
  <table width="90%" border="0" cellspacing="1" cellpadding="5">
    <tr>
      <td><a href="add_cat.php">增加类别</a></td>
      <td><a href="edit_cat.php">编辑类别</a></td>
    </tr>
  </table>
</div>
<?php include_once("../include/daohang.htm"); ?>
</body>
</html>
