<html>
<head>
<title>
Polynomial Factoring Practice
</title>
<link rel="stylesheet" type="text/css" href="discrepancy.css">
<script type="text/javascript">
function checkPax() {
	var wazit = true;
	var jobssays = "";
	var klepto = document.digbomb.yoawns.value;
	if (klepto == '' || !klepto.match(/[^\s]/g)) {
		jobssays += "I guarantee the factorization of this polynomial is something.\n";
		document.digbomb.yoawns.focus();
		wazit = false;
	}
	else if (klepto.match(/[^xyXY0-9\s\+\-\(\)\^]/g)) {
		jobssays += "The factorization can be done with just numbers, x, y, spaces, parentheses, subtraction, addition, and exponents...\n";
		document.digbomb.yoawns.focus();
		wazit = false;
	}
	if (!wazit) {
		alert(jobssays);
	}
	return wazit;
}
</script>
</head>
<body>
<form name="digbomb" method="post" action="factorizer.php" onsubmit="return checkPax();">
<?php
include "header.inc.php";
echo "<div class=\"midsxn\">";
include "sidepanel.inc.php";
echo "<div class=\"mainpan\">";?>
<?php
function gen_no ($upperlimit) {
	$malval = mt_rand(1,$upperlimit);
	$coinflip = mt_rand(1,2);
	if ($coinflip == 2) {
		$malval *= -1;
	}
	return $malval;
}
function quad_pretty ($mol1, $mol2) {
	$mos = $mol1 + $mol2;
	$moq = $mol1 * $mol2;
	echo "x^2";
	if ($mos == 0) {
		if ($moq > 0) {
			echo " + " . $moq;
		}
		else {
			echo " - " . ($moq*-1);
		}
	}
	else {
		if ($mos > 1) {
			echo " + " . $mos;
		}
		elseif ($mos == 1) {
			echo " + ";
		}
		elseif ($mos == -1) {
			echo " - ";
		}
		else {
			echo " - " . ($mos*-1);
		}
		if ($moq > 0) {
			echo "x + " . $moq;
		}
		else {
			echo "x - " . ($moq*-1);
		}
	}
}
function quad_ymit ($myl1, $myl2) {
	$mys = $myl1 + $myl2;
	$myq = $myl1 * $myl2;
	echo "x^2";
	if ($mys == 0) {
		if ($myq > 0) {
			echo " + " . $myq . "y^2<br />";
		}
		else {
			echo " - " . ($myq*-1) . "y^2<br />";
		}
	}
	else {
		if ($mys > 1) {
			echo " + " . $mys;
		}
		elseif ($mys == 1) {
			echo " + ";
		}
		elseif ($mys == -1) {
			echo " - ";
		}
		else {
			echo " - " . ($mys*-1);
		}
		if ($myq > 0) {
			echo "xy + " . $myq . "y^2";
		}
		else {
			echo "xy - " . ($myq*-1) . "y^2";
		}
	}
}
function nepoly ($type) {
	switch ($type) {
		case 'initi':
			#echo "initialize";
			$med1 = gen_no(15);
			$med2 = gen_no(15);
			quad_pretty($med1,$med2);
			echo "<br /><input type='hidden' name='aval1' value='" . $med1 . "' />";
			echo "<input type='hidden' name='aval2' value='" . $med2 . "' />";
			break;
		case 'ez' :
			#simple quadratic polynomials that factor into two terms, with no coefficient
			#on the quadratic term, only integers between -12 and +12 for roots
			$med1 = gen_no(12);
			$med2 = gen_no(12);
			quad_pretty($med1,$med2);
			echo "<br /><input type='hidden' name='aval1' value='" . $med1 . "' />";
			echo "<input type='hidden' name='aval2' value='" . $med2 . "' />";
			break;
		case 'med' :
			#same as ez, except with integer roots up to 25.
			$med1 = gen_no(25);
			$cfp = mt_rand(1,15);
			if ($cfp < 13) {
				$med2 = gen_no(25);
			}
			else {
				$med2 = $med1;
				$med2 *= -1;
			}
			quad_pretty($med1,$med2);
			echo "<br /><input type='hidden' name='aval1' value='" . $med1 . "' />";
			echo "<input type='hidden' name='aval2' value='" . $med2 . "' />";
			break;
		case 'upr' :
			#same as med, but adding in factors with "y" (and no over-abundance of difference of squares)
			$med1 = gen_no(25);
			$med2 = gen_no(25);
			$flp = mt_rand(1,3);
			if ($flp == 3) {
				quad_ymit($med1,$med2);
				$med2 .= "y";
			}
			else {
				quad_pretty($med1, $med2);
			}
			echo "<br /><input type='hidden' name='aval1' value='" . $med1 . "' />";
			echo "<input type='hidden' name='aval2' value='" . $med2 . "' />";
			break;
		case 'adv' :
			#up to 40, and including some sum and difference of cubes
			echo "boulders!";
			break;
	}
}
if ($_POST['diff'] && $_POST['aval1']) {
	#runs if there's a menu option, and a first root
		#check on initial post
	$pwn1 = $_POST['aval1'];
	$pwn2 = $_POST['aval2'];
	$necek = $_POST['yoawns'];
	if (preg_match('/y/',$pwn2)) {
		#checking answer, for polynomials with both x and y
		$caliente = "/\(x\+".$pwn1."y\)\(x\+".$pwn2."\)/";
		$calientos = "/\(x\+".$pwn2."\)\(x\+".$pwn1."y\)/";
		$pwn2 = preg_replace('/y/','',$pwn2);
		$pws = $pwn1 + $pwn2;
		$pwq = $pwn1 * $pwn2;
		$necey = preg_replace('/\s/','',$necek);
		$necey = preg_replace('/\+\-/','-',$necey);
		$necey = preg_replace('/\-/','+-',$necey);
		if (preg_match($caliente,$necey) || preg_match($calientos,$necey)) {
			echo "CORRECT! ";
			quad_ymit($pwn1,$pwn2);
			echo " = " . $necek . "<br /><br />";
		}
		else {echo "Sorry! Your answer was " . $_POST['yoawns'] . "<br /><br />";
			echo "To find the correct answer, notice that:<br />";
			echo $pws . "xy = " . $pwn1 . "xy + " . $pwn2 . "xy and " . $pwq . "y^2 = " . $pwn1 . "y * " . $pwn2 . "y<br />";
			echo "<br />Then we have:<br />";
			quad_ymit($pwn1, $pwn2);
			echo " =<br />";
			echo "(x^2 + " . $pwn1 . "xy) + (" . $pwn2 . "xy + " . $pwq . "y^2) =<br />";
			echo "x(x + " . $pwn1 . "y) + " . $pwn2 . "y(x + " . $pwn1 . "y) =<br />";
			echo "(x + " . $pwn2 . "y)(x + " . $pwn1 . "y)<br /><br />";
			#echo "WRONG! x^2 + " . $pws . "xy + ". $pwq . " = ";
			#echo "(x + " . $pwn1 . "y)(x + " . $pwn2 . "y)<br /><br />";
		}
	}
	else {
		#checking correct answer, for single-variable polynomials
		$corrstr = "/\(x\+".$pwn1."\)\(x\+".$pwn2."\)/";
		$cobbstr = "/\(x\+".$pwn2."\)\(x\+".$pwn1."\)/";
		$pws = $pwn1 + $pwn2;
		$pwq = $pwn1 * $pwn2;
		$necek = preg_replace('/\s/','',$necek);
		$necek = preg_replace('/\+\-/','-',$necek);
		$necek = preg_replace('/\-/','+-',$necek);
		if (preg_match($corrstr,$necek) || preg_match($cobbstr,$necek)) {
			#correct answer
			echo "CORRECT! ";
			quad_pretty($pwn1,$pwn2);
			echo " = " . $necek . "<br /><br />";
		}
		else {
			#incorrect answer
			echo "Sorry! Your answer was " . $_POST['yoawns'] . "<br /><br />";
			echo "To find the correct answer, notice that:<br />";
			echo $pws . " = " . $pwn1 . " + " . $pwn2 . " and " . $pwq . " = " . $pwn1 . " * " . $pwn2 . "<br />";
			echo "<br />Then we have:<br />";
			quad_pretty($pwn1, $pwn2);
			echo " =<br />";
			echo "(x^2 + " . $pwn1 . "x) + (" . $pwn2 . "x + " . $pwq . ") =<br />";
			echo "x(x + " . $pwn1 . ") + " . $pwn2 . "(x + " . $pwn1 . ") =<br />";
			echo "(x + " . $pwn2 . ")(x + " . $pwn1 . ")<br /><br />";
		}
	}
	#generate new polynomial
	echo "<strong>Next Problem:</strong><br /><br />";
	nepoly($_POST['diff']);
}
else {
	#initial post
	nepoly('initi');
}
?>
Enter the factored form of the polynomial (ie "(x+a)(x+b)"):<br />
<input type="text" name="yoawns" /><br /><br />
Difficulty:<br />
<?php
if ($_POST['diff'] == "ez") {
	echo "<select name='diff'><option value='ez' selected>Beginner</option>
	<option value='med'>Intermediate-Low</option>
	<option value='upr'>Intermediate-High</option>
	<!--<option value='adv'>Advanced</option>--></select>";
}
elseif ($_POST['diff'] == "upr") {
	echo "<select name='diff'><option value='ez'>Beginner</option>
	<option value='med'>Intermediate-Low</option>
	<option value='upr' selected>Intermediate-High</option>
	<!--<option value='adv'>Advanced</option>--></select>";
}
else {
	echo "<select name='diff'><option value='ez'>Beginner</option>
	<option value='med' selected>Intermediate-Low</option>
	<option value='upr'>Intermediate-High</option>
	<!--<option value='adv'>Advanced</option>--></select>";
}
?>
<br /><br />
<input type="Submit" value="Submit" />
</form>
<?php 
echo "</div></div>";
include "footer.inc.php";
?>
<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

<br />&nbsp;

</body>
</html>
