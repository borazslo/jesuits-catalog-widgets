function logorefresh() {
	var codetext = '<script type="text/javascript" src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/jh_altalanos_'+$("#width").val()+'_'+$("#height").val()+'_'+$("#color").val()+'.js\"><\/script>';
	$('#code').val(codetext);
	var iframe = '<IFRAME name="NewsIFrame" src="http://konyvjelzo.jezsuita.hu/hirfolyam/share/newsfeed.php?theme=altalanos&width='+$("#width").val()+'&height='+$("#height").val()+'&color='+$("#color").val()+'" width="'+$("#width").val()+'" height="'+$("#height").val()+'" frameborder="0" scrolling="no"></IFRAME>';
	$('#example').html(iframe);
}
$(document).ready(function() {
	//only number
	$("#width, #height").keydown(function(event) {
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || // Allow: backspace, delete, tab, escape, and enter
		   (event.keyCode == 65 && event.ctrlKey === true) || // Allow: Ctrl+A
		   (event.keyCode >= 35 && event.keyCode <= 39)) { // Allow: home, end, left, right
			return;// let it happen, don't do anything
		} else {
			// Ensure that it is a number and stop the keypress
			if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault(); 
			}
		}
	});
	//only number
	$("#width").keyup(function(event) {
		if ($("#width").val() > 500) {
			$("#width").val(500);
		}
		if ($("#width").val() <= 0) {
			$("#width").val(50);
		}
 		logorefresh();
	});
	$("#height").keyup(function(event) {
 		if ($("#height").val() > 1000) {
			$("#height").val(1000);
		}
		if ($("#height").val() <= 0) {
			$("#height").val(150);
		} 
		logorefresh();
	});
	$("#color").keyup(function(event) {
		logorefresh();
	});
	$("#width").val(200);
	$("#height").val(300);
	$("#color").val('BB0022');
	logorefresh();
});
