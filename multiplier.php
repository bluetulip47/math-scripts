<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Multiplication Practice</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<script type="text/javascript" src="food.js">
</script>-->
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body OnLoad="document.ffForm.answer.focus();" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#52918C">
<p>
<?php include 'header.inc.php'; ?>
<table align="center" bgcolor="#52918C" cellpadding="0" cellspacing="0" border="0">
<tr><td><center>
<b><font size=+2>Multiplication Practice</font></b>
</center>
<p>
<form name="ffForm" action="multiplier.php" method="post">
<?php
$posschoice = array();
$posschoice[0] = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
$prod1 = $posschoice[0][array_rand($posschoice[0])];
$prod2 = $posschoice[0][array_rand($posschoice[0])];
#$prod1 = 1;
#$prod2 = 2;
echo $prod1 . " x " . $prod2 . " = ";
?>
<input type="text" name="answer" size="5"/><br>
<input type="submit" value="Check"/><p>
<?php
echo "<input type=\"hidden\" name=\"fprod1\" value=\"$prod1\">";
echo "<input type=\"hidden\" name=\"fprod2\" value=\"$prod2\">";
?>
<p>
<?php
$lastans = $_POST['answer'];
$lastprod1 = $_POST['fprod1'];
$lastprod2 = $_POST['fprod2'];
if (($lastans != NULL) && ($lastans == ($lastprod1 * $lastprod2))) {
	echo "Correct. " . $lastprod1 . " x " . $lastprod2 . " = " . $lastans;
}
#echo $posschoice[5][6];
?>
<p>
<table>
<tr><td>&nbsp;
<?php
$q = 15;
if ($_POST['poskch'] == NULL) {
	for ($jp = 1; $jp <= $q; $jp++) {
		for ($ip = 1; $ip <= $q; $ip++) {
			$posschoice[$jp] = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
			foreach($posschoice[$jp] as $keyk => $valuke) {
				$posschoice[$jp][$keyk] = $valuke*$jp;
			}
		}
	}
}
else {
	#echo $_POST['poskch'];
	$posschoicek = explode(";",$_POST['poskch']);
	foreach ($posschoicek as $label => $score) {
		$posschoice[$label] = explode(",",$posschoicek[$label]);
	}
	#echo "&nbsp;kkk&nbsp;" . $posschoice[$lastprod2][$lastprod1-1];
}
foreach($posschoice[0] as $key => $value) {
	echo "<td>" . $value;
}
foreach($posschoice[0] as $key2 => $value2) {
	echo "<tr><td>" . $value2;
	for ($j = 0; $j < $q; $j++) {
		if ((($value2 * ($j+1)) == $lastans) && 
			(($value2 == $lastprod1) || ($value2 == $lastprod2)) &&
			($value2 <= ($j+1))) {
			#echo "<td>--";
			echo "<td><b>" . $lastans . "</b>";
			$posschoice[$value2][$j] = 0;
		}
		elseif (($posschoice[$value2][$j] == 0) && ($value2 <= ($j+1))) {
			echo "<td>" . ($value2*($j+1));
		}
		elseif (($j+1) < $value2) {
			echo "<td>--";
		}
		else {
			echo "<td>&nbsp;";
			#echo "<td>" . $posschoice[$value2][$j];
		}
	}
}
foreach($posschoice as $arzk => $arzv) {
	$raik[$arzk] = implode(",", $arzv);
}
$aaaaarg = implode(";", $raik);
echo "<input type=\"hidden\" name=\"poskch\" value=\"$aaaaarg\">";
?>
</table>
</form></table></center>
<p>
<?php include 'footer.inc.php'; ?>
</body>
</html>
