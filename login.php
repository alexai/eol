<?

session_start();

include "../include/config.php";

include "../include/mysql.class.php";

include "../include/functions.php";

$sqlStr="select ".$prefix."gs_ygb.edid,";

$sqlStr.="".$prefix."gs_ygb.name,";

$sqlStr.="".$prefix."rh_auth.lanmu"; 

$sqlStr.=" from ";

$sqlStr.=" ".$prefix."gs_ygb,";

$sqlStr.=" ".$prefix."rh_auth";

$sqlStr.=" where";

$sqlStr.=" ".$prefix."gs_ygb.auth_xh=".$prefix."rh_auth.xh";

$sqlStr.=" and ".$prefix."gs_ygb.yongfu='$name'";

$sqlStr.=" and ".$prefix."gs_ygb.pw='$pwd'";

$result=$db->query($sqlStr);

$row=$db->fetch_array($result);

$sum=$db->num_rows($result);

if($sum>0){

   if($row[lanmu]!=""){

      $selanmu=$row[lanmu];

   }

    if(!empty($row[name])){

      $sename=$row[name];      

   }

   session_register('selanmu');

   session_register('sename'); 

   include "../include/myheader.php";

   messageTEXT("The system is logging in, please wait...");

   jumpURLTime("menu/index_2.php",2);

}

else{

  echo"Sorry,user's name or password mistake！";  

   jumpURL("index.htm");

}

?>