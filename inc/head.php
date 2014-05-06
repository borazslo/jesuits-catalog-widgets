<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Jesuit Memorials</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="hu-hu" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	<meta name="revisit-after" content="3 days" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	<style type="text/css">
		body {
			font-size: 12px;
			font-family: arial, helvetica, Tahoma, Verdana, sans-serif ;
			color: #4c4c4c;
			margin: 0px;
			padding: 0px;
		}
		p {
			color:blue;
		}
		.jezsuhir{
<?
	echo "			width: ".($_GET['width'])."px;\n";
	echo "			height: ".($_GET['height'])."px;\n";
?>
			border-radius: 7px;
			border: 0px solid white;
<?
	echo "			background-color: #".$_GET['color'].";\n";
?>
			font-family: arial;
			font-size: 12px;
		}

		.jezsuhir a{
			text-decoration: none;
		}

		.jezsuhirfejl{
			padding: 3px 4px 2px 0px;
			color: white;
			font-weight: bold;
		}
		.jezsuhirtart{
			margin: 0px 1px 0px 1px;
			padding: 10px 0px 10px 10px;
			background: white url('http://konyvjelzo.jezsuita.hu/hirfolyam/share/inc/logo.gif') no-repeat center center;
		}
		#jezsuhirhirek{
			overflow-y: hidden;
			overflow-x: hidden;
<?	echo "			height: ".($_GET['height']-74)."px;\n";?>
		}
		.jezsuhircim{
			margin: 0px 0px 0px 0px;
			font-weight: bold;
		}
		.jezsuhircim a{
			color: darkblue;
		}
		.jezsuhirhead a{
			color: #606060;
		}
		.jezsuhirhead{
			margin: 0px 0px 10px 0px;
		}

		.jezsuhirlabl{
			text-align: center;
			margin: 4px 0px 0px 0px;
			padding: 0px 0px 0px 0px;
			height: 20px;
		}
		.jezsuhirlabl a, .jezsuhirfejl a{
			color: white;
		}
		#jezsuhirfel{
			cursor: pointer;
		}
		#jezsuhirle{
			cursor: pointer;
		}

	.tooltipstyle {
		display:none;
		position:absolute;
		border-radius: 5px;
/*
		background: #9FDAEE;
		border: 1px solid #2BB0D7;
*/
		background: #FFFFAA;
		border: 1px solid #FFAD33;

		color:#666;
		padding:5px;
	}
	</style>
	<script>
		$(function() {
/*			$('span.tooltip').hover(function(e){ // Hover event
				var titleText = $(this).attr('title');
				$(this)
					.data('tiptext', titleText)
					.removeAttr('title');
				$('<p class="tooltipstyle"></p>')
					.text(titleText)
					.appendTo('body')
					.css('top', (e.pageY - 10) + 'px')
					.css('left', (e.pageX + 20) + 'px')
					.fadeIn('slow');
				}, function(){ // Hover off event
				$(this).attr('title', $(this).data('tiptext'));
				$('.tooltipstyle').remove();
			}).mousemove(function(e){ // Mouse move event
				$('.tooltipstyle')
					.css('top', (e.pageY - 10) + 'px')
					.css('left', (e.pageX + 20) + 'px');
			});

*/

			$('.jezsuhirlabl').hover(function() {
					$('.jezsuhirlabl').html('<a href="http://www.sjweb.info/" target="_balnk">.info</a>&nbsp;&nbsp;<a href="https://www.facebook.com/JesuitNetworking" target="_blank">face</a>&nbsp;&nbsp;<a href="https://twitter.com/jesuitnetwork" target="_blank">tweet</a></a>' );
				}, function(){
					$('.jezsuhirlabl').html('&nbsp;<img src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/inc/negyzet.gif" />&nbsp;' );
				});

			var jezsuhirup = false;
			var jezsuhirdown = false;
			var jezsuhiruploop = window.setInterval(function () {if (jezsuhirup) {
				$("#jezsuhirhirek").scrollTop($("#jezsuhirhirek").scrollTop() - 5);
			}},50);
			$('#jezsuhirfel').hover(function() {jezsuhirup = true}, function(){jezsuhirup = false;});
			var jezsuhirdownloop = window.setInterval(function () {if (jezsuhirdown) {
				$("#jezsuhirhirek").scrollTop($("#jezsuhirhirek").scrollTop() + 5);
			}},50);
			$('#jezsuhirle').hover(function() {jezsuhirdown = true}, function(){jezsuhirdown = false;});

		});
/*
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-10397001-13']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

*/
	function trackGAOutboundLink(link, category, action) { 
		try { 
			_gaq.push(['_trackEvent', category , action]); 
		} catch(err){}
		setTimeout(function() {
			window.open(link.href, '_blank');
			//document.location.href = link.href;
		}, 100);
	}

	</script>

</head>
<body>
