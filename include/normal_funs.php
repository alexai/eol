<?php

/**
 * @Alex Ai swallow13@163.com
 * @copyright 2009
 */
function view_paper($arr) {
	include("/var/www/html/gb/fckeditor/fckeditor.php");

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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type1_options` WHERE `item_id` = '$vv';");
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." &#x5206;)";
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type2_options` WHERE `item_id` = '$vv';");
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." &#x5206;)";
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			echo "<table width=90% border=0>";
			echo "<tr><td>";
			$STEM_STR = $sort.".&nbsp;&nbsp";
			$STEM_STR .= "<input type=hidden name=\"T".$sort."\" value=3 /><input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			while ($ss = mysql_fetch_array($stem)) {
				if ($ss[2] == 0) {
					$STEM_STR .= $ss[1];
				} else {
					$STEM_STR .= "&nbsp;&nbsp;<input type=text name=\"Q".$sort."[]\" class=blank />&nbsp;&nbsp;";
				}		
			}
			echo $STEM_STR."&nbsp;&nbsp;(".$cost." &#x5206;)";
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;(".$cost." &#x5206;)<br />";
			echo "<img src=\"".$image."\" class=pad /><br />";
			//echo "<textarea name=\"Q".$sort."\" cols=50 rows=5></textarea><input type=hidden value=".$vv." name=\"ID".$sort."\" /><input type=hidden name=\"T".$sort."\" value=4 /><br /><br />";
			$txtbox = 'Q'.$sort;
			$oFCKeditor = new FCKeditor($txtbox);
			$oFCKeditor->BasePath = '/gb/fckeditor/';
			$oFCKeditor->ToolbarSet = 'Default';
			$oFCKeditor->Width = '75%';
			$oFCKeditor->Height = '250';
			$oFCKeditor->Value = '';
			$oFCKeditor->Create();
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" /><input type=hidden name=\"T".$sort."\" value=4 /><br /><br />";
		}
	}
	echo '<input type="hidden" name="count_items" value="'.$sort.'" />';
}

function view_result($arr,$n) {

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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type1_options` WHERE `item_id` = '$vv';");
			$answ = mysql_result(mysql_query("SELECT `answ` FROM `gb_obj_answ` WHERE `id` = '$n' AND `item_id` = '$vv';"),0);
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." &#x5206;)";
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			echo "<input type=hidden value=1 name=\"T".$sort."\" />";
			echo "</td></tr>";
			echo "<tr><td width=15%>";
			echo "<img src=\"".$image."\" class=pad />";
			echo "</td><td>";
			while ($myop = mysql_fetch_array($option)) {
				if ($myop[1] == $answ){
					echo "<p><input type=radio name=\"Q".$sort."\" value=\"".$myop[1]."\" checked=\"checked\" disabled />".$myop[1].". ".$myop[0]."</p>";
				} else {
					echo "<p><input type=radio name=\"Q".$sort."\" value=\"".$myop[1]."\" disabled />".$myop[1].". ".$myop[0]."</p>";
				}				
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			$option = mysql_query("SELECT `item_option`,`item_value` FROM `gb_item_type2_options` WHERE `item_id` = '$vv';");
			$answ = mysql_result(mysql_query("SELECT `answ` FROM `gb_obj_answ` WHERE `id` = '$n' AND `item_id` = '$vv';"),0);			
			echo "<p><table width=90% border=0>";
			echo "<tr><td colspan=2>";
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;&nbsp;&nbsp;(".$cost." &#x5206;)";
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			echo "<input type=hidden value=2 name=\"T".$sort."\" />";
			echo "</td></tr>";
			echo "<tr><td width=15%>";
			echo "<img src=\"".$image."\" class=pad />";
			echo "</td><td>";
			while ($myop = mysql_fetch_array($option)) {
				if (strpos($answ,$myop[1]) === false){
					echo "<p><input type=checkbox name=\"Q".$sort."[]\" value=\"".$myop[1]."\" disabled />".$myop[1].". ".$myop[0]."</p>";
				} else {
					echo "<p><input type=checkbox name=\"Q".$sort."[]\" value=\"".$myop[1]."\" checked=\"checked\" disabled />".$myop[1].". ".$myop[0]."</p>";
				}				
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			echo "<table width=90% border=0>";
			echo "<tr><td>";
			$STEM_STR = $sort.".&nbsp;&nbsp";
			$STEM_STR .= "<input type=hidden name=\"T".$sort."\" value=3 /><input type=hidden value=".$vv." name=\"ID".$sort."\" />";
			while ($ss = mysql_fetch_array($stem)) {
				if ($ss[2] == 0) {
					$STEM_STR .= $ss[1];
				} else {					
					$STEM_STR .= "&nbsp;&nbsp;<input type=text name=\"Q".$sort."[]\" class=blank disabled />&nbsp;&nbsp;";
				}		
			}
			echo $STEM_STR."&nbsp;&nbsp;(".$cost." &#x5206;)<br /><br />";
			$qr = mysql_query("SELECT `answ`,`fen` FROM `gb_sub_answ` WHERE `id` = '$n' AND `item_id` = '$vv';");
			$tk_answ = '';
			while ($tka = mysql_fetch_array($qr)) {
				$tk_answ .= '&nbsp;&nbsp;<input type=text value="'.$tka[0].'" disabled />&nbsp;&nbsp;';
				$fen = $tka[1];
			}
			$tk_answ .= '<b>&#x5F97; '.$fen.' &#x5206;</b>';
			echo $tk_answ;
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
				$image = "pics/shift.gif";
			} else {
				$image = str_replace("../","",$image);
			}
			$qr = mysql_query("SELECT `answ`,`fen` FROM `gb_sub_answ` WHERE `id` = '$n' AND `item_id` = '$vv';");
			echo $sort.".&nbsp;&nbsp;".$stem."&nbsp;&nbsp;(".$cost." &#x5206;)<br />";
			echo "<img src=\"".$image."\" class=pad /><br />";
			/*echo "<textarea name=\"Q".$sort."\" cols=50 rows=5 disabled>";
			echo mysql_result($qr,0,0);
			echo "</textarea><br /><br />";*/
			echo mysql_result($qr,0,0);
			echo "<span class=s12><b>&#x5F97; ".mysql_result($qr,0,1)." &#x5206;</b></span>";
			echo "<input type=hidden value=".$vv." name=\"ID".$sort."\" /><input type=hidden name=\"T".$sort."\" value=4 /><br /><br />";
		}
	}
	echo '<input type="hidden" name="count_items" value="'.$sort.'" />';
}
?>