<?php
	//LOGIN
	//set POST variables
	$url = 'http://www.sjweb.info/adusum/Validate.cfm';
	include_once("settings.inc");
	
	$fields = array(
						'Utente_required' => urlencode('You must supply a username'),
						'Chiave_required' => urlencode('You must supply a password'),
						'Tab' => urlencode(1),
						'Utente' => urlencode($utente),
						'Chiave' => urlencode($chiave),
						'submit' => urlencode(" OK ")
				);
	//url-ify the data for the POST
	$fields_string = '';
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie"); 
	curl_setopt($ch, CURLOPT_COOKIE, "/tmp/cookie"); 
	//execute post
	$result = curl_exec($ch);

	if(preg_match('/href=\"logout\.cfm\"/i',$result)) {
		curl_setopt($ch,CURLOPT_URL, 'http://www.sjweb.info/adusum/personal/index.cfm');
		$myprofile = curl_exec($ch);
		
		preg_match('/id=\"MemberID\"(.*?)value=\"(.*?)\"/i',$myprofile,$match);
		$MemberID = $match[2];
		
		preg_match('/id=\"Email\"(.*?)value=\"(.*?)\"/i',$myprofile,$match2);
		$email = $match2[2];
		
		$query = "INSERT INTO users (uname,email,password,MemberID,comment) VALUES ('".$user."','".$email."','".md5($md5.$pass)."','".$MemberID."','".$pass."');";
		//echo $query;
		global $kapcsolat;
		sqlconnect();
		mysql_query($query);
		
		echo $MemberID."-".$email;
	} else die('Nem sikerült');
 //LOGIN ENDED
 
	$query = "TRUNCATE provinces ;";
	echo $query."<br>";
	global $kapcsolat;
	sqlconnect();
	mysql_query($query);
 
	
	curl_setopt($ch,CURLOPT_URL, 'http://www.sjweb.info/adusum/curiagen/indexSJ.cfm');
	$catalogue = curl_exec($ch);
	preg_match('/<select.*?>(.*?)<\/select>/si',$catalogue,$match);
	preg_match_all('/value="(.*?)">(.*?)<\/option>/si',$match[1],$matches,PREG_SET_ORDER);
	foreach($matches as $prov) {
			$name = substr($prov[2],4);
			$abbrev = $prov[1];
			$query = "INSERT INTO provinces (abbrev,name) VALUES ('".$abbrev."','".$name."');";
			echo $query."<br>";
			global $kapcsolat;
			sqlconnect();
			mysql_query($query);
	}
	
	
	
function sqlconnect() {
	global $kapcsolat;
	include("settings.inc");
	$kapcsolat = mysql_connect("localhost",$mysql_user, $mysql_pwd);
	mysql_select_db("sjweb", $kapcsolat);
	mysql_set_charset('utf8',$kapcsolat);
}

?>