function get_sort(N) {
	var LETTER = new Array("A","B","C","D","E","F","G","H","I","J");
	var ZIMU = LETTER[N];
	var strZIMU = ZIMU.toString();
	return strZIMU;
}

function add_option(area) {
	var SORT = get_sort(num);
	num = num+1;
	var str = "<input type=radio name=RadioGroup1 value=" + SORT + " />" + SORT + ". <input type=text class=length name=answ" + num +" /><br /><br />";
	document.getElementById(area).innerHTML = document.getElementById(area).innerHTML + str;
	document.getElementById("op_num").value = num;
	/*
	alert(document.getElementById(area).innerHTML);
	alert(document.getElementById("op_num").value);
	*/
}

function add_muti_option(area) {
	var SORT = get_sort(num);
	num = num+1;
	var str = "<input type=checkbox name=CheckGroup1[] value=" + SORT + " />" + SORT + ". <input type=text class=length name=answ" + num +" /><br /><br />";
	document.getElementById(area).innerHTML = document.getElementById(area).innerHTML + str;
	document.getElementById("op_num").value = num;
	/*
	alert(document.getElementById(area).innerHTML);
	alert(document.getElementById("op_num").value);
	*/
}

function add_input(area,T) {
	num = num+1;
	if (T == 0) {
		var str = "<input type=text class=xuxian name=words" + num + " />";
	} else {
		var str = "<input type=text class=blank name=noword" + num + " value=blank" + num + " onfocus=this.select() />";
		var ref_str = "<input type=text class=reffer name=ref" + num + " value=reffer-for-blank" + num + " onfocus=this.select() />";
		document.getElementById("a2").innerHTML = document.getElementById("a2").innerHTML + ref_str;
	}
	document.getElementById(area).innerHTML = document.getElementById(area).innerHTML + str;
	document.getElementById("op_num").value = num;
	/*
	alert(document.getElementById(area).innerHTML); 
	alert(document.getElementById("op_num").value);
	alert(document.getElementById("a2").innerHTML);
	*/
}

function enable(CHARS) {
	M_ITEM += CHARS + ",";
	var chars = document.getElementById(CHARS);
	chars.disabled = false;
	chars.focus();
	chars.onfocus = function(){this.select();}
	document.getElementById("SELT").value = M_ITEM;
	/*var MI += CHARS + ",";
	document.getElementById(CHARS).disabled = false;
	document.getElementById(CHARS).focus();
	onfocus=document.getElementById(CHARS).select();
	document.getElementById("SELT").value = MI;
	alert(M_ITEM);*/
}