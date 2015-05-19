<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
 
function get_categories() {
	$query = mysql_query("SELECT * FROM `gb_categories`;");
	return $query;	
}

function get_cat_name($n) {
	$query = mysql_query("SELECT `category_name` FROM `gb_categories` WHERE `category_id` = '$n';");
	$query = mysql_result($query,0);
	return $query;
}

function add_cat() {
	mysql_query("INSERT INTO `gb_categories` (`category_name`) VALUE ('$_REQUEST[newcat]');");
	$cat_id = mysql_insert_id();
	return $cat_id;
}

function edit_cat() {
	$SLT_ARR = explode(",",$_REQUEST["SELT"]);
	$SLT_ARR = trim_last($SLT_ARR);

	foreach ($SLT_ARR as $CAT) {
		$X = str_replace("cat","",$CAT);
		mysql_query("UPDATE `gb_categories` SET `category_name` = '$_REQUEST[$CAT]' WHERE `category_id` = $X;");
		//echo $CAT;
	}
	return count($SLT_ARR);
}

function save_image($stp,$id) {
	if (strlen($_FILES["item_image"]["name"]) == 0) {
		mysql_query("INSERT INTO `gb_item_image` (`item_id`) VALUE ('$id');");
	} else {
		$UP_FILE_URL = "../pics/".$stp."_".$_FILES['item_image']['name'];
		move_uploaded_file($_FILES['item_image']['tmp_name'],$UP_FILE_URL);
		mysql_query("INSERT INTO `gb_item_image` (`item_id`,`item_image`) VALUE ('$id','$UP_FILE_URL');");
	}
}

function add_item_type1() {
	$STAMP = time();
	$ITEM_DATE = date('Y-m-d');
	$ANSW_NUM = $_POST["op_num"];
	
	if ($_POST["RadioGroup1"] == "") {
		$STD_ANSW = "A";
	} else {
		$STD_ANSW = $_POST["RadioGroup1"];
	}
	mysql_query("INSERT INTO `gb_items_warehouse` (`item_type`,`item_category`,`item_score`,`item_creation_user`,`item_creation_date`,`item_creater_uid`) VALUES ('1','$_POST[cat]','$_POST[item_type1_score]','$_SESSION[cname]','$ITEM_DATE','$_SESSION[uid]');");
	$ITEM_ID = mysql_insert_id();
	
	save_image($STAMP,$ITEM_ID);
	
	for ($i = 1; $i <= $ANSW_NUM; $i++) {
		$S_ARR = array("0","A","B","C","D","E","F","G","H","I","J");
		$tmp_op_name = "answ".$i;
		mysql_query("INSERT INTO `gb_item_type1_options` (`item_id`,`item_option`,`item_value`) VALUE ('$ITEM_ID','$_POST[$tmp_op_name]','$S_ARR[$i]');");
	}
		
	mysql_query("INSERT INTO `gb_item_type1_stem` (`item_id`,`item_stem`) VALUE ('$ITEM_ID','$_POST[item_type1_stem]');");
	mysql_query("INSERT INTO `gb_item_std_answ` (`item_id`,`std_answ`) VALUE ('$ITEM_ID','$STD_ANSW');");
				
	return $ITEM_ID;	
}


function add_item_type2() {
	$STAMP = time();
	$ITEM_DATE = date('Y-m-d');
	$ANSW_NUM = $_POST["op_num"];
	
	foreach($_POST["CheckGroup1"] as $CK) {
		$STD_ANSW = $STD_ANSW.$CK;
	}
	
	if (count($_POST["CheckGroup1"]) <= 1) {
		return "Error! The standard answer must be more than one choice!";
	} else {		
		mysql_query("INSERT INTO `gb_items_warehouse` (`item_type`,`item_category`,`item_score`,`item_creation_user`,`item_creation_date`,`item_creater_uid`) VALUE ('2','$_POST[cat]','$_POST[item_type2_score]','$_SESSION[cname]','$ITEM_DATE','$_SESSION[uid]');");
		$ITEM_ID = mysql_insert_id();
		
		save_image($STAMP,$ITEM_ID);
		
		for ($i = 1; $i <= $ANSW_NUM; $i++) {
			$S_ARR = array("0","A","B","C","D","E","F","G","H","I","J");
			$tmp_op_name = "answ".$i;
			mysql_query("INSERT INTO `gb_item_type2_options` (`item_id`,`item_option`,`item_value`) VALUE ('$ITEM_ID','$_POST[$tmp_op_name]','$S_ARR[$i]');");
		}
		
		mysql_query("INSERT INTO `gb_item_type2_stem` (`item_id`,`item_stem`) VALUE ('$ITEM_ID','$_POST[item_type2_stem]');");
		mysql_query("INSERT INTO `gb_item_std_answ` (`item_id`,`std_answ`) VALUE ('$ITEM_ID','$STD_ANSW');");
		
		return $ITEM_ID;
	}
}

function add_item_type3() {
	$STAMP = time();
	$ITEM_DATE = date('Y-m-d');
	$ANSW_NUM = $_POST["op_num"];
	
	mysql_query("INSERT INTO `gb_items_warehouse` (`item_type`,`item_category`,`item_score`,`item_creation_user`,`item_creation_date`,`item_creater_uid`) VALUE ('3','$_POST[cat]','$_POST[item_type3_score]','$_SESSION[cname]','$ITEM_DATE','$_SESSION[uid]');");
	$ITEM_ID = mysql_insert_id();

	save_image($STAMP,$ITEM_ID);
	
	for ($i = 1; $i <= $ANSW_NUM; $i++) {
		if (isset($_POST[words.$i])) {
			$tmp_c = $_POST[words.$i];
			mysql_query("INSERT INTO `gb_item_type3` (`item_id`,`sort_num`,`contents`,`type`) VALUE ('$ITEM_ID','$i','$tmp_c','0');");			
		} else {
			$tmp_r = $_POST[ref.$i];
			mysql_query("INSERT INTO `gb_item_type3` (`item_id`,`sort_num`,`contents`,`type`) VALUE ('$ITEM_ID','$i','','1');");
			mysql_query("INSERT INTO `gb_item_type3_reffer` (`item_id`,`sort_num`,`reffer`) VALUE ('$ITEM_ID','$i','$tmp_r');");
		}
	}
	return $ITEM_ID;
}

function add_item_type4() {
	$STAMP = time();
	$ITEM_DATE = date('Y-m-d');
	
	mysql_query("INSERT INTO `gb_items_warehouse` (`item_type`,`item_category`,`item_score`,`item_creation_user`,`item_creation_date`,`item_creater_uid`) VALUE ('4','$_POST[cat]','$_POST[item_type4_score]','$_SESSION[cname]','$ITEM_DATE','$_SESSION[uid]');");
	$ITEM_ID = mysql_insert_id();

	save_image($STAMP,$ITEM_ID);
	
	mysql_query("INSERT INTO `gb_item_type4` (`item_id`,`item_type4_stem`,`reffer`) VALUE ('$ITEM_ID','$_POST[stem]','$_POST[reffer]');");
	
	return $ITEM_ID;
}

function get_item_total($VAR,$n) {
	/*获得题目的数目
	$var 为搜索的参数值,$n 为确定参数的类型
	$n=1 表示按题型搜索（其中参数为0表示所有题型）
	$n=2 表示按分类搜索
	$n=3 按小于等于VAR分值搜索
	$n=4 按大于等于VAR分值搜索
	$n=5 按创建用户搜索
	$n=6 按VAR日期之前创建的日期搜索
	*/
	switch($n) {
		case 1:
			switch($VAR) {
				case 0:
				return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse`;"));
				break;
				
				case 1:	
				return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type`='1';"));
				break;
				
				case 2:
				return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type`='2';"));
				break;
				
				case 3:
				return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type`='3';"));
				break;
				
				case 4:
				return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_type`='4';"));
				break;							
			}
		break;

		case 2:
		return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_category`='$VAR'"));
		break;
		
		case 3:
		return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_score`<='$VAR'"));
		break;
		
		case 4:
		return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_score`>='$VAR'"));
		break;
		
		case 5:
		return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_creation_user`='$VAR'"));
		break;
		
		case 6:
		return mysql_num_rows(mysql_query("SELECT `item_id` FROM `gb_items_warehouse` WHERE `item_creation_date`<='$VAR'"));
		break;		     
	} 
}

function get_total_score($arr) {
	$score = 0;
	foreach ($arr as $v) {
		$one = mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$v';");
		$score = $score + mysql_result($one,0);
	}
	return $score;
}

function trim_last($arr) {
	end($arr);
	$u = pos($arr);
	unset($arr[key($arr)]);
	reset($arr);
	return $arr;
}

function view_paper($arr) {

	foreach ($arr as $w) {
		$qr = mysql_result(mysql_query("SELECT `item_type` FROM `gb_items_warehouse` WHERE `item_id` = '$w'"),0);
		switch ($qr) {
			case 1:
			$danxuan[] = $w;
			break;
			
			case 2:
			$duoxuan[] = $w;
			break;
			
			case 3:
			$tiankong[] = $w;
			break;
			
			case 4:
			$jianda[] = $w;
			break;
		}
	}
	
	$sort = 0;
	if (!empty($danxuan)) {
		shuffle($danxuan);
		echo "<div class=s14>单选题</div>";
		
		foreach ($danxuan as $vv) {
			$sort = $sort + 1;
			$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$vv';"),0);
			$stem = mysql_result(mysql_query("SELECT `item_stem` FROM `gb_item_type1_stem` WHERE `item_id` = '$vv';"),0);
			$image = mysql_result(mysql_query("SELECT `item_image` FROM `gb_item_image` WHERE `item_id` = '$vv';"),0);
			if ($image == NULL) {
				$image = "../pics/shift.gif";
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type1_options` WHERE `item_id` = '$vv';");
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." 分)";
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			echo "<input type=hidden value=1 name=\"T".$sort."\" />";
			echo "</td></tr>";
			echo "<tr><td width=15%>";
			echo "<img src=\"".$image."\" class=pad />";
			echo "</td><td>";
			while ($myop = mysql_fetch_array($option)) {
				echo "<p><input type=radio name=\"Q".$sort."\" value=\"".$myop[1]."\" />".$myop[1].". ".$myop[0]."</p>";
			}
			echo "</td></tr>";
			echo "</table></p>";
			
		}
	}
	if (!empty($duoxuan)) {
		shuffle($duoxuan);
		echo "<div class=s14>多选题</div>";
		
		foreach ($duoxuan as $vv) {
			$sort = $sort + 1;
			$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$vv';"),0);
			$stem = mysql_result(mysql_query("SELECT `item_stem` FROM `gb_item_type2_stem` WHERE `item_id` = '$vv';"),0);
			$image = mysql_result(mysql_query("SELECT `item_image` FROM `gb_item_image` WHERE `item_id` = '$vv';"),0);
			if ($image == NULL) {
				$image = "../pics/shift.gif";
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type2_options` WHERE `item_id` = '$vv';");
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." 分)";
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			echo "<input type=hidden value=2 name=\"T".$sort."\" />";
			echo "</td></tr>";
			echo "<tr><td width=15%>";
			echo "<img src=\"".$image."\" class=pad />";
			echo "</td><td>";
			while ($myop = mysql_fetch_array($option)) {
				echo "<p><input type=checkbox name=\"Q".$sort."[]\" value=\"".$myop[1]."\" />".$myop[1].". ".$myop[0]."</p>";
			}
			echo "</td></tr>";
			echo "</table></p>";		
		}
	}
	if (!empty($tiankong)) {
		shuffle($tiankong);
		echo "<div class=s14>填空题</div><br /><br />";
		
		foreach ($tiankong as $vv) {
			$sort = $sort + 1;
			$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$vv';"),0);
			$stem = mysql_query("SELECT `sort_num`,`contents`,`type` FROM `gb_item_type3` WHERE `item_id` = '$vv' ORDER BY `sort_num`;");
			$image = mysql_result(mysql_query("SELECT `item_image` FROM `gb_item_image` WHERE `item_id` = '$vv';"),0);
			if ($image == NULL) {
				$image = "../pics/shift.gif";
			}
			echo "<table width=90% border=0>";
			echo "<tr><td>";
			$STEM_STR = $sort.".&nbsp;&nbsp";
			$STEM_STR .= "<input type=hidden name=\"T".$sort."\" value=3 /><input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			while ($ss = mysql_fetch_array($stem)) {
				if ($ss[2] == 0) {
					$STEM_STR .= $ss[1];
				} else {
					$STEM_STR .= "<input type=text name=\"Q".$sort."[]\" class=blank />";
				}		
			}
			echo $STEM_STR."&nbsp;&nbsp;(".$cost." 分)<input type=hidden value=".$vv." name=\"ID-3-".$sort."\" />";
			echo "</td></tr><tr><td>";
			echo "<img src=\"".$image."\" class=pad />";
			echo "</td></tr>";
			echo "</table>";
		}
	}
	if (!empty($jianda)) {
		shuffle($jianda);
		echo "<div class=s14>简答题</div><br /><br />";
		
		foreach ($jianda as $vv) {
			$sort = $sort + 1;
			$cost = mysql_result(mysql_query("SELECT `item_score` FROM `gb_items_warehouse` WHERE `item_id` = '$vv';"),0);
			$stem = mysql_result(mysql_query("SELECT `item_type4_stem` FROM `gb_item_type4` WHERE `item_id` = '$vv';"),0);
			$image = mysql_result(mysql_query("SELECT `item_image` FROM `gb_item_image` WHERE `item_id` = '$vv';"),0);
			if ($image == NULL) {
				$image = "../pics/shift.gif";
			}
			echo "<br /><br />".$sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;(".$cost." 分)<br />";
			echo "<img src=\"".$image."\" class=pad /><br />";
			//echo "<textarea name=\"Q".$sort."\" cols=50 rows=5></textarea><input type=hidden value=".$vv." name=\"ID".$sort."\" /><input type=hidden name=\"T".$sort."\" value=4 /><br /><br />";
			$tn = 'Q'.$sort;
			$oFCKeditor = new FCKeditor($tn);
			$oFCKeditor->BasePath = '/gb/fckeditor/';
			$oFCKeditor->ToolbarSet = 'Default';
			$oFCKeditor->Width = '75%';
			$oFCKeditor->Height = '250';
			$oFCKeditor->Value = '';
			$oFCKeditor->Create();
		}
	}
	echo '<input type="hidden" name="count_items" value="'.$sort.'" />';
}


?>