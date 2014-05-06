		<header class="entry-header">
			<h1 class="entry-title">Embed the widget</h1>
		</header>

	<div class="entry-content">
		<p>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<script src="share.js"></script>
			Type: <select id="type" />
					<option value="birthday">Birthdays Today</option>	
					<option value="birthdays">Birthdays on the next days</option>	
					<option value="oldest">Oldest jesuits</option>	
					<option value="youngest">Youngest jesuits</option>	
					</select><br />
			Size: <input id="width" style="width: 30px;" type="text" />x<input id="height" style="width: 30px;" type="text" />px<br />
			Border colour: <input id="color" style="width: 50px;" type="text" />html color<br />
			
			Filter:<select id="filter" />
					<option value="all">all</option>
					<?php
					$query = "SELECT * FROM provinces";	
					global $kapcsolat;
					sqlconnect(); $provinces = array();
					$result = 	mysql_query($query);
					while ($tmp = mysql_fetch_array($result, MYSQL_ASSOC)) {
						echo '<option value="'.$tmp['abbrev'].'">'.$tmp['name'].'</option>	';
						$provinces[$tmp['abbrev']] = $tmp;
					}

					?>
					</select><br />
			
			
			The code:<br /><textarea id="code" cols="78"></textarea><br/>
			<br />
			It looks like this:
		</p>
		<div id="example"></div>
	</div>
					
<br/><br/>
					
<script type="text/javascript" src="memorial_birthday_200_500_BB0022_all.js"></script>
<script type="text/javascript" src="memorial_oldest_200_500_BB0022_all.js"></script>
<script type="text/javascript" src="memorial_youngest_200_500_BB0022_all.js"></script>

<?php
function sqlconnect() {
	global $kapcsolat;
	include("settings.inc");
	$kapcsolat = mysql_connect("localhost",$mysql_user, $mysql_pwd);
	mysql_select_db("sjweb", $kapcsolat);
	mysql_set_charset('utf8',$kapcsolat);
}

?>