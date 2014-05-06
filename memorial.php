<?

	include('./inc/head.php');

	include "./inc/lastRSS.php"; 





function trim_text($string, $length, $replacer = '...') { 

	$string = preg_replace('/^(.*)<!--more-->.*$/su','\1',$string);

	$string = html_entity_decode($string);

	$string = strip_tags($string);

	$string = preg_replace('/\s+/u', ' ', $string);



	if(mb_strlen($string, 'UTF-8') > $length) {

		if (preg_match('/^(.*)\W.*$/u', mb_substr($string, 0, $length+1), $matches)) {

			return $matches[1]."...";

		} else {

			return (mb_substr($string, 0, $length, 'UTF-8') . $replacer);

		}

	}

	return $string; 

}
	$query = "SELECT * FROM provinces";	
	global $kapcsolat;
	sqlconnect(); $provinces = array();
	$result = 	mysql_query($query);
	while ($tmp = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$provinces[$tmp['abbrev']] = $tmp;
	}


if ($_GET['theme'] == 'birthday') {
	$title = 'Jesuit Birthdays Today';
	$count = true;
	$maxitem = 100;
	$query = "SELECT * FROM jesuits WHERE dateobirth LIKE '%".date('m-d')."' ";
	if($_GET['filter'] != 'all') $query .= 'AND ( province = "'.$_GET['filter'].'" OR appliedto = "a'.$_GET['filter'].'" ) ';
	$query .= "ORDER BY dateobirth ASC, province LIMIT ".$maxitem.";";
} elseif ($_GET['theme'] == 'birthdays') {
	$title = 'Jesuit Birthdays';
	$count = false;
	$maxitem = 100; $tmp = '';
	if($_GET['filter'] == 'all') $max = 1; else $max = 30;
	for($i=1;$i<$max;$i++) {
		$tmp .= " OR dateobirth LIKE '%".date('m-d',strtotime(date('Y-m-d').' +'.$i.' days'))."' ";
	}
	$query = "SELECT * FROM jesuits WHERE ( dateobirth LIKE '%".date('m-d')."' ".$tmp.' ) ';
	if($_GET['filter'] != 'all') $query .= 'AND ( province = "'.$_GET['filter'].'" OR appliedto = "a'.$_GET['filter'].'" ) ';
	$query .= "ORDER BY dateobirth ASC, province LIMIT ".$maxitem.";";
}elseif ($_GET['theme'] == 'oldest') {
	$title = 'Oldest Jesuits';
	$count = false;
	$query = "SELECT * FROM jesuits  ";
	if($_GET['filter'] != 'all') $query .= 'WHERE province = "'.$_GET['filter'].'" OR appliedto = "a'.$_GET['filter'].'" ';
	$query .= "ORDER BY dateobirth ASC, province LIMIT 20;";	
} elseif ($_GET['theme'] == 'youngest') {
	$title = 'Youngest Jesuits';
	$count = false;
	$query = "SELECT * FROM jesuits  ";
	if($_GET['filter'] != 'all') $query .= 'WHERE province = "'.$_GET['filter'].'" OR appliedto = "a'.$_GET['filter'].'" ';
	$query .= "ORDER BY dateobirth DESC, province LIMIT 20;";	
}



	global $kapcsolat;
	sqlconnect(); $jesuits = array();
	$result = 	mysql_query($query);
	while ($tmp = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$jesuits[] = $tmp;
	}
	$maxitem = count($jesuits);
	
	if($_GET['theme']=='birthdays') {
		foreach($jesuits as $key=>$value) {
			$jesuits[$key]['dayobirth'] = substr($value['dateobirth'],5,2).substr($value['dateobirth'],8,2);
			
		}
		aasort($jesuits,"dayobirth");
	}
?>



<div class="jezsuhir">

	<div class="jezsuhirfejl"><a href=""><div style="font-size: 13px; margin: 3px 0px 2px 0px;">&nbsp;<a href="http://www.jezsuita.hu/" target="_balnk"><?php
		echo $title;
		if($_GET['filter'] != 'all') echo " in <a title='".$provinces[$_GET['filter']]['name']."'>".$_GET['filter']."</a> ";
		if($count == true) echo " (".count($jesuits).")"; 
		
		?></a></div></div>

		<div class="jezsuhirtart">

			<img id="jezsuhirfel" src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/inc/fel.png" style="position: relative; right: 4px; float: right;"/>

			<img id="jezsuhirle" src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/inc/le.png" style="position: relative; right: -10px; top: <?echo ($_GET['height']-80)?>px; float: right;">

			<div id="jezsuhirhirek">



<?



if ($_GET['theme'] == 'XXXbirthday') {
	foreach($jesuits as $item) {
		//print_r($item['items']);
		echo '<div class="jezsuhircim"><a href="'.$item['link'].'" onclick="trackGAOutboundLink(this, \'hirfolyam linkek katt\', \''.$item['link'].'\');return false;" target="_blank">'.$item['name'].'</a></div>'."\n";
		$text = preg_replace('/^<\!\[CDATA\[/','', $item['dateobirth']);
		$text = preg_replace('/\]\]>$/','', $text);
		$text_short = trim_text($text, 70);
		//tooltip: <span class="tooltip" title="'.$text.'">
		echo '<div class="jezsuhirhead">'.$item['province'].', '.date('Y',strtotime($item['dateobirth'])).'</div>'."\n";
		if (++$item_counter >= $maxitem) {
			break;
		}
	} 
}
elseif ($_GET['theme'] == 'oldest' OR $_GET['theme'] == 'youngest' OR $_GET['theme'] == 'birthday' OR $_GET['theme'] == 'birthdays') {
	foreach($jesuits as $item) {
		//print_r($item['items']);
		echo '<div class="jezsuhircim"><a href="'.$item['link'].'" onclick="trackGAOutboundLink(this, \'hirfolyam linkek katt\', \''.$item['link'].'\');return false;" target="_blank">'.$item['name'].'</a></div>'."\n";
		$text = preg_replace('/^<\!\[CDATA\[/','', $item['dateobirth']);
		$text = preg_replace('/\]\]>$/','', $text);
		$text_short = trim_text($text, 70);
		//tooltip: <span class="tooltip" title="'.$text.'">
		echo '<div class="jezsuhirhead"><a title="'.$provinces[$item['province']]['name'].'">'.$item['province'].'</a>, ';
			$birthDate = date('m/d/Y',strtotime($item['dateobirth']));
			//explode the date to get month, day and year
			$birthDate = explode("/", $birthDate);
			//get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
		echo " ".$age." years old";
		if($_GET['theme'] == 'birthdays') echo " on ".date('d/m',strtotime($item['dateobirth']));
		echo '</div>'."\n";
		if (++$item_counter >= $maxitem) {
			break;
		}
	} 
}
?>

			</div>

		</div>

	<div class="jezsuhirlabl">&nbsp;<img src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/inc/negyzet.gif" />&nbsp;</div>

</div>



<?

	include('./inc/foot.php');

	
	
function sqlconnect() {
	global $kapcsolat;
	include("settings.inc");
	$kapcsolat = mysql_connect("localhost",$mysql_user, $mysql_pwd);
	mysql_select_db("sjweb", $kapcsolat);
	mysql_set_charset('utf8',$kapcsolat);
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

	
?>

