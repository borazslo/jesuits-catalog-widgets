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
 
	$query = "TRUNCATE jesuits ;";
	echo $query."<br>";
	global $kapcsolat;
	sqlconnect();
	mysql_query($query);
 
	
	curl_setopt($ch,CURLOPT_URL, 'http://www.sjweb.info/adusum/curiagen/indexSJ.cfm');
	$catalogue = curl_exec($ch);
	preg_match('/<select.*?>(.*?)<\/select>/si',$catalogue,$match);
	preg_match_all('/value="(.*?)"/si',$match[1],$matches);
	foreach($matches[1] as $prov) {
		//ONE PROVINCE LIST
		set_time_limit(200);
		$url = 'http://www.sjweb.info/adusum/curiagen/provinceListSJ.cfm';
		$fields = array(
						'SortFactor' => urlencode('Nome'),
						'Arrival' => urlencode(1),
						'Prov' => urlencode($prov),
						'submit' => urlencode(" OK ")
				);
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie"); 
		curl_setopt($ch, CURLOPT_COOKIE, "/tmp/cookie"); 
		//execute post
		$provinceListSJ = curl_exec($ch);
		
		preg_match('/<table cellspacing="2".*?%">(.*?)<\/table>/si',$provinceListSJ ,$match);
		preg_match_all('/<tr.*?>(.*?)<\/tr>/si',$match[1] ,$rows);
		unset($rows[1][0]);
		foreach($rows[1] as $row) {
			preg_match_all('/<td.*?>(.*?)<\/td>/si',$row ,$cells);
			$jesuit = $cells[1];
			for($i=1;$i<=4;$i++) {
				$text = $jesuit[$i];
				$jesuit[$i] = $text{6}.$text{7}.$text{8}.$text{9}.'-'.$text{3}.$text{4}.'-'.$text{0}.$text{1};
				if($jesuit[$i] == '--') $jesuit[$i] = '0000-00-00';
				//echo $jesuit[$i]."+";
			}
			
			$query = "INSERT INTO jesuits (name,dateobirth,dateoentrance,dateoordination,dateofvow,appliedfrom,appliedto,province) VALUES ('".$jesuit[0]."','".$jesuit[1]."','".$jesuit[2]."','".$jesuit[3]."','".$jesuit[4]."','".$jesuit[5]."','".$jesuit[6]."','".$prov."');";
			echo $query."<br>";
			global $kapcsolat;
			sqlconnect();
			mysql_query($query);
			//print_r($cells[1]);		echo "<br><br>";
		}
		
		
		//exit;
	}
	
	
	
function sqlconnect() {
	global $kapcsolat;
	include("settings.inc");
	$kapcsolat = mysql_connect("localhost",$mysql_user, $mysql_pwd);
	mysql_select_db("sjweb", $kapcsolat);
	mysql_set_charset('utf8',$kapcsolat);
}

?>