<?

header("Content-type: text/javascript");

echo "document.write('<IFRAME name=\"NewsIFrame\" src=\"http://api.jezsuita.hu/jesuits-catalog-widgets/memorial.php?theme=$_GET[theme]&width=".$_GET['width']."&height=".$_GET['height']."&color=".$_GET['color']."&filter=".$_GET['filter']."\" width=\"".$_GET['width']."\" height=\"".$_GET['height']."\" frameborder=\"0\" scrolling=\"no\"></IFRAME>');";

?>

