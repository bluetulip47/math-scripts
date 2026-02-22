<html>
<head>
<title>
Conic Sections Problems Generator
</title>
<link rel="stylesheet" type="text/css" href="discrepancy.css">
<script type="text/javascript">
function checkZit() {
	var woozit = true;
	var errmag = "";
	var awnpos = document.sections.q_type.value;
	//alert(awnpos);
	if (!woozit) {
		alert(errmag);
	}
	return woozit;
}
</script>
</head>
<body>
<?php
include "header.inc.php";
echo "<div class=\"midsxn\">";
include "sidepanel.inc.php";
echo "<div class=\"mainpan\">";?>
<form name="sections" method="post" action="conicsections.php" onsubmit="return checkZit();">
<?php
/*----finding the greatest common factor------*/
function gcd_akd ($no1, $no2) {
	if ($no2 > $no1) {
		$bzhk = $no1;
		$no1 = $no2;
		$no2 = $bzhk;
	}
	elseif ($no2 == $no1) {
		return $no1;
	}
	$r = $no1 - $no2;
	if ($r == 1) {
		return 1;
	}
	$itsk = $no1;
	$ytsk = $no2;
	while ($r > 0) {
		$md = $ytsk;
		while ($md <= $itsk) {
			$md += $ytsk;
		}
		if ($md > $itsk) {
			$md -= $ytsk;
		}
		#md is now the multiple of $no2/ytsk that is just less than $no1/itsk
		#itsk = md + r
		#md is some multiple of ytsk
		$r = $itsk - $md;
		#ytsk = r(n) + rnext
		$itsk = $ytsk;
		$ytsk = $r;
	}
	if ($r == 0) {
		$akd = $itsk;
	}
	else {
		$akd = $ytsk;
	}
	return $akd;
}
/*----------checking the last question--------*/
if ($_POST['q_type']) {
	switch ($_POST['q_type']) {
		case 'circ_cent':
			$given_cc = preg_replace('/\s/','',$_POST['circ_cent']);
			$corr_cc = preg_replace('/\s/','',$_POST['corr_ans']);
			if (preg_match($corr_cc, $given_cc)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the center of the circle " . $_POST['c_eqn'] . " is at " . $corr_cc . ".";
				echo "<br />Notice that";
				if ($_POST['c_eqn_ty'] == "simp") {
					echo ": <br />";
					echo $_POST['c_eqn'] . " ==> <br />";
					echo "(x^2 - " . (2*$_POST['x_ctr']) . "x + " . ($_POST['x_ctr']*$_POST['x_ctr']);
					echo ") + (y^2 - " . (2*$_POST['y_ctr']) . "y + " . ($_POST['y_ctr']*$_POST['y_ctr']) . ") = ";
					echo (($_POST['rad']*$_POST['rad']) - ($_POST['x_ctr']*$_POST['x_ctr']) - ($_POST['y_ctr']*$_POST['y_ctr']));
					echo " + " . ($_POST['x_ctr']*$_POST['x_ctr']) . " + " . ($_POST['y_ctr']*$_POST['y_ctr']) . "<br />";
					echo "==> (x - " . $_POST['x_ctr'] . ")^2 + (y - " . $_POST['y_ctr'] . ")^2 = " . ($_POST['rad']*$_POST['rad']);
					echo "<br />The value subtracted from x is " . $_POST['x_ctr'] . " and the value subtracted from y is " . $_POST['y_ctr'];
					echo ";<br />these two values together give the center of the circle.";
				}
				else {
					echo " the value subtracted from x is " . $_POST['x_ctr'] . " and the value subtracted from y is " . $_POST['y_ctr'];
					echo ".<br /> These two values together give the center of the circle.";
				}
			}
			break;
		case 'circ_rad':
			$given_cr = preg_replace('/\s/','',$_POST['circ_rad']);
			$corr_cr = $_POST['corr_ans'];
			if ($corr_cr == $given_cr) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the radius of the circle " . $_POST['c_eqn'] . " is " . $_POST['rad'];
				echo ".<br />Notice that";
				if ($_POST['c_eqn_ty'] == "simp") {
					echo ": <br />";
					echo $_POST['c_eqn'] . " ==> <br />";
					echo "(x^2 - " . (2*$_POST['x_ctr']) . "x + " . ($_POST['x_ctr']*$_POST['x_ctr']);
					echo ") + (y^2 - " . (2*$_POST['y_ctr']) . "y + " . ($_POST['y_ctr']*$_POST['y_ctr']) . ") = ";
					echo (($_POST['rad']*$_POST['rad']) - ($_POST['x_ctr']*$_POST['x_ctr']) - ($_POST['y_ctr']*$_POST['y_ctr']));
					echo " + " . ($_POST['x_ctr']*$_POST['x_ctr']) . " + " . ($_POST['y_ctr']*$_POST['y_ctr']) . "<br />";
					echo "==> (x - " . $_POST['x_ctr'] . ")^2 + (y - " . $_POST['y_ctr'] . ")^2 = " . ($_POST['rad']*$_POST['rad']);
					echo "<br />The right-hand side of this equation is " . ($_POST['rad']*$_POST['rad']);
					echo ".<br />That value is the square of the radius, so the radius is " . $_POST['rad'] . ".";
				}
				else {
					echo " the right-hand side of the equation is " . ($_POST['rad']*$_POST['rad']);
					echo ".<br />This value is the square of the radius, " . $_POST['rad'] . ".";
				}
				#echo c_eqn_ty, y_ctr, x_ctr, rad
			}
			break;
		case 'circ_area':
			$given_rad = preg_replace('/\s/','',$_POST['circ_area']);
			if ($given_rad == $_POST['corr_ans']) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the area of the circle " . $_POST['c_eqn'] . " is " . $_POST['corr_ans'] . "&pi;.";
				echo "<br />Notice that";
				if ($_POST['c_eqn_ty'] == "simp") {
					echo ": <br />";
					echo $_POST['c_eqn'] . " ==> <br />";
					echo "(x^2 - " . (2*$_POST['x_ctr']) . "x + " . ($_POST['x_ctr']*$_POST['x_ctr']);
					echo ") + (y^2 - " . (2*$_POST['y_ctr']) . "y + " . ($_POST['y_ctr']*$_POST['y_ctr']) . ") = ";
					echo (($_POST['rad']*$_POST['rad']) - ($_POST['x_ctr']*$_POST['x_ctr']) - ($_POST['y_ctr']*$_POST['y_ctr']));
					echo " + " . ($_POST['x_ctr']*$_POST['x_ctr']) . " + " . ($_POST['y_ctr']*$_POST['y_ctr']) . "<br />";
					echo "==> (x - " . $_POST['x_ctr'] . ")^2 + (y - " . $_POST['y_ctr'] . ")^2 = " . ($_POST['rad']*$_POST['rad']);
					echo "<br />The right-hand side of this equation is " . $_POST['corr_ans'];
					echo ".<br />This is the square of the radius, r&sup2;, and<br />since ";
				}
				else {
					echo " the right-hand side of the equation is " . ($_POST['rad']*$_POST['rad']);
					echo ". This is the <br />square of the radius, r&sup2;, and since ";
				}
				echo "the formula for the area of a circle is &pi;r&sup2;,<br />the area of this circle is " . ($_POST['rad']*$_POST['rad']) . "&pi;.";
			}
			break;
		case 'circ_um':
			$given_um = preg_replace('/\s/','',$_POST['circ_um']);
			if ($given_um == $_POST['corr_ans']) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the circumference of the circle " . $_POST['c_eqn'] . " is " . $_POST['corr_ans'] . "&pi;.";
				echo "<br />Notice that";
				if ($_POST['c_eqn_ty'] == "simp") {
					echo ": <br />";
					echo $_POST['c_eqn'] . " ==> <br />";
					echo "(x^2 - " . (2*$_POST['x_ctr']) . "x + " . ($_POST['x_ctr']*$_POST['x_ctr']);
					echo ") + (y^2 - " . (2*$_POST['y_ctr']) . "y + " . ($_POST['y_ctr']*$_POST['y_ctr']) . ") = ";
					echo (($_POST['rad']*$_POST['rad']) - ($_POST['x_ctr']*$_POST['x_ctr']) - ($_POST['y_ctr']*$_POST['y_ctr']));
					echo " + " . ($_POST['x_ctr']*$_POST['x_ctr']) . " + " . ($_POST['y_ctr']*$_POST['y_ctr']) . "<br />";
					echo "==> (x - " . $_POST['x_ctr'] . ")^2 + (y - " . $_POST['y_ctr'] . ")^2 = " . ($_POST['rad']*$_POST['rad']);
					echo "<br />The right-hand side of this equation is " . ($_POST['rad']*$_POST['rad']);
					echo ".<br />That value is the square of the radius, so the radius is " . $_POST['rad'] . ".";
				}
				else {
					echo " the right-hand side of the equation is " . ($_POST['rad']*$_POST['rad']);
					echo ".<br />This value is the square of the radius, " . $_POST['rad'] . ".";
				}
				echo "<br />Since the equation for the circumference of a circle is 2&pi;r,<br />";
				echo "the circumference of this circle is 2*&pi;*" . $_POST['rad'] . ", or " . $_POST['corr_ans'] . "&pi;.";
			}
			break;
		case 'circ_ty':
			$gic_ty = preg_replace('/\s/','',$_POST['circ_ty']);
			if (preg_match('/circle/i',$gic_ty)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the conic section represented by " . $_POST['c_eqn'] . " is a circle.";
			}
			break;
		case 'para_ver':
			$given_ver = preg_replace('/\s/','',$_POST['para_ver']);
			$corr_ver = preg_replace('/\s/','',$_POST['corr_ans']);
			if (preg_match($corr_ver, $given_ver)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the vertex of the parabola " . $_POST['para_gift'] . "<br />";
				echo " is " . $_POST['corr_ans'] . ". Notice that when " . $_POST['corlet'];
				echo " = " . $_POST['corval'] . ", the squared<br />term is zero. This indicates that this is the point of<br />";
				echo "symmetry for the parabola. Since " . $_POST['muse'] . " = " . $_POST['mustard'] . " when ";
				echo $_POST['corlet'] . " = " . $_POST['corval'] . ",<br /> the vertex of ";
				echo $_POST['para_gift'] . " is " . $_POST['corr_ans'] . ".";
			}
			break;
		case 'para_lrlen':
			$given_lrlen = preg_replace('/\s/','',$_POST['para_lrlen']);
			if ($given_lrlen == $_POST['corr_ans']) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the length of the latus rectum of the parabola <br />";
				echo $_POST['para_gift'];
				echo " is " . $_POST['corr_ans'] . ". Notice that the coefficient of<br />";
				echo "the squared term is 1 / (" . (4*$_POST['pease']) . "), and so the length ";
				echo "of the latus<br />rectum is " . abs(4*$_POST['pease']) . ".";
			}
			break;
		case 'para_dir':
			$given_dir = preg_replace('/\s/','',$_POST['para_dir']);
			$given_dir = preg_replace('/[^xy\=\-0-9]/','', $given_dir);
			$corr_dir = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($corr_dir == $given_dir) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the directrix of " . $_POST['para_gift'] . " is ";
				echo $_POST['corr_ans'] . ".<br />";
				#echo "Your answer was " . $given_dir . ".";
				echo "Notice that the coefficient"; 
				echo " of the squared term is 1 / (" . (4*$_POST['pease']) . "), so the distance between ";
				echo "the<br />vertex and the directrix is " . abs($_POST['pease']) . ". Since ";
				echo "the parabola opens<br />" . $_POST['dekkn'] . " and the " . $_POST['muse'] . "-coordinate of the vertex ";
				echo "is " . $_POST['mustard'] . ", the " . $_POST['muse'] . "-coordinate<br /> of the directrix is ";
				echo ($_POST['mustard'] - $_POST['pease']) . ".";
			}
			break;
		case 'para_foc':
			$given_foc = preg_replace('/\s/','',$_POST['para_foc']);
			$corr_foc = preg_replace('/\s/','',$_POST['corr_ans']);
			if (preg_match($corr_foc, $given_foc)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the focus of the parabola " . $_POST['para_gift'];
				echo " is " . $_POST['corr_ans'] . ".<br />";
				echo "Notice that the squared term is zero when " . $_POST['corlet'] . " = " . $_POST['corval'];
				echo ". Thus the<br />" . $_POST['corlet'] . "-coordinate of the focus must be " . $_POST['corval'];
				echo ". Also, since the coefficient of this term is<br />";
				echo "1 / (" . (4*$_POST['pease']) . "), the distance between the vertex and the focus of the parabola is<br />";
				echo abs($_POST['pease']) . ". Since the " . $_POST['muse'] . "-coordinate of the parabola's vertex is at ";
				echo $_POST['mustard'] . ",<br /> and the opening of the parabola is " . $_POST['dekkn'] . ", this gives us a ";
				echo "focus at " . $_POST['corr_ans'] . ".";
				#echo "Your answer was " . $_POST['para_foc'];
			}
			break;
		case 'para_ty':
			$gip_ty = preg_replace('/\s/','',$_POST['para_ty']);
			$gip_ty = preg_replace('/[^a-zA-Z]/','', $gip_ty);
			if (preg_match('/parabola/i',$gip_ty)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, " . $_POST['para_gift'] . " is a parabola. Notice that<br />";
				echo "there is precisely one squared variable; the other variable is linear.<br />";
				echo "All three other conic section types have two quadratic variables.";
			}
			break;
		case 'hyp_ty':
			$hip_ty = preg_replace('/\s/','',$_POST['hyp_ty']);
			$hip_ty = preg_replace('/[^a-zA-Z]/','', $hip_ty);
			if (preg_match('/hyperbola/i',$hip_ty)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, that was a hyperbola.";
			}
			break;
		case 'el_ty':
			$la_ty = preg_replace('/\s/','',$_POST['el_ty']);
			$la_ty = preg_replace('/[^a-zA-Z]/','', $la_ty);
			if (preg_match('/ellipse/i',$la_ty)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, " . $_POST['el_gift'] . " represents an ellipse. Notice that ";
				echo "<br />the equation has quadratic terms for both x and y, and that they have the same";
				echo "<br />sign and different coefficients.";
			}
			break;
		case 'para_lrpt':
			$given_lrpt = preg_replace('/\s/','',$_POST['para_lrpt']);
			$corr_lrpt1 = preg_replace('/\s/','',$_POST['corr_ans1']);
			$corr_lrpt2 = preg_replace('/\s/','',$_POST['corr_ans2']);
			if (preg_match($corr_lrpt1, $given_lrpt) || preg_match($corr_lrpt2, $given_lrpt)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the parabola " . $_POST['para_gift'] . " has ";
				echo "latus rectum<br />endpoints at " . $_POST['corr_ans1'] . " and " . $_POST['corr_ans2'] . ".";
				echo " Notice that the coefficient<br />";
				echo " of the squared term is 1 / (" . (4*$_POST['pease']) . "), so the distance between ";
				echo "the<br />vertex and the latus rectum is " . abs($_POST['pease']) . ". Since ";
				echo "the parabola opens<br />" . $_POST['dekkn'] . " and the " . $_POST['muse'] . "-coordinate of the vertex ";
				echo "is " . $_POST['mustard'] . ", the " . $_POST['muse'] . "-coordinate<br /> of the latus rectum endpoints is ";
				echo ($_POST['pease'] + $_POST['mustard']) . ". Plugging this into <br />" . $_POST['para_gift'];
				echo " gives " . $_POST['corr_ans1'] . " and " . $_POST['corr_ans2'] . " as the<br />endpoints of the latus rectum.";
			}
			break;
		case 'hyper':
			$hypochondriac = preg_replace('/\s/','',$_POST['hyper']);
			#echo $hypochondriac;
			$disease = preg_replace('/[^xy]/i','',$_POST['corr_ans']);
			$flu = $disease . "-axis";
			$ebola = $disease . "axis";
			if (($disease == $hypochondriac) || ($flu == $hypochondriac) || ($ebola == $hypochondriac)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, that hyperbola does not cross the " . $disease . "-axis.";
				if ($disease == "y") {
					echo "<br />The hyperbola " . $_POST['hyrnd'] . " is of the form x^2 - y^2.<br />This makes it a horizontal";
					echo " hyperbola, and so it never crosses the y-axis.";
				}
				else {
					echo "<br />The hyperbola " . $_POST['hyrnd'] . " is of the form y^2 - x^2.<br />This makes it a vertical";
					echo " hyperbola, and so it never crosses the x-axis.";
				}
			}
			break;
		case 'hyfi':
			$given_foki = preg_replace('/\s/','',$_POST['hyfi']);
			$corr_foki = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($given_foki == $corr_foki) {
				echo "Correct!";
			}
			else {
				echo "Sorry, " . $_POST['hyrnd'] . " has foci at a distance of " . $_POST['corr_ans'] . " from<br />";
				echo "the " . $_POST['hyzix'] . "-axis. Notice that " . pow($_POST['hyra'], 2) . " + " . pow($_POST['hyrb'], 2) . " equals ";
				echo pow($_POST['corr_ans'], 2) . ", and since a<sup>2</sup> + b<sup>2</sup> = c<sup>2</sup>,<br />";
				echo pow($_POST['corr_ans'], 2) . "<sup>1/2</sup>, or " . $_POST['corr_ans'] . ", is the distance from the " . $_POST['hyzix'] . "-axis to a focus of the hyperbola.";
			}
			break;
		case 'hyfi2':
			$given_foki2 = preg_replace('/\s/','',$_POST['hyfi2']);
			$corr_foki2 = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($given_foki2 == $corr_foki2) {
				echo "Correct!";
			}
			else {
				echo "Sorry, " . $_POST['hyrnd'] . " has foci at a distance of " . $_POST['corr_ans'] . "<sup>1/2</sup> from<br />";
				echo "the " . $_POST['hyzix'] . "-axis. Notice that " . pow($_POST['hyra'], 2) . " + " . pow($_POST['hyrb'], 2) . " equals ";
				echo $_POST['corr_ans'] . ", and since a<sup>2</sup> + b<sup>2</sup> = c<sup>2</sup>,<br />";
				echo $_POST['corr_ans'] . "<sup>1/2</sup> is the distance from the " . $_POST['hyzix'] . "-axis to a focus of the hyperbola.";
			}
			break;
		case 'venti':
			$over = preg_replace('/\s/','',$_POST['corr_ans1']);
			$under = preg_replace('/\s/','',$_POST['corr_ans2']);
			$measu = preg_replace('/\s/','',$_POST['venti']);
			if (($measu == $over) || ($measu == $under)) {
				echo "Correct!";
			}
			else {
				echo "Sorry! The vertices of the hyperbola " . $_POST['hyrnd'] . "<br />are at " . $over . " and " . $under . ".";
				echo " Notice that the " . $_POST['vertype'] . "<sup>2</sup> term is the positive term,<br />and that";
				echo " its coefficient is (1 / " . pow($_POST['vertval'],2) . "). The square root of this value's<br />multiplicative ";
				echo "inverse gives " . $_POST['vertval'] . "; thus the vertices are at " . $_POST['vertype'] . " = +/- " . $_POST['vertval'] . ".";
			}
			break;
		case 'el_vent':
			$harold = preg_replace('/\s/','',$_POST['corr_ans1']);
			$maude = preg_replace('/\s/','',$_POST['corr_ans2']);
			$guitar = preg_replace('/\s/','',$_POST['el_vent']);
			if (($guitar == $harold) || ($guitar == $maude)) {
				echo "Correct!";
			}
			else {
				echo "Sorry! The vertices of the ellipse " . $_POST['el_gift'] . " are at " . $harold . " and " . $maude . ".";
				if ($_POST['el_gifta']) {
					echo "<br />Notice that:<br />" . $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'];
				}
				echo "<br />Since the ellipse is " . $_POST['el_dire'] . ", the vertices are the extreme points in the ";
				if ($_POST['el_dire'] == "horizontal") {
					echo "x-direction, and so the<br />y-coordinates are both " . $_POST['vertfix'];
					echo ". The x-coordinates are thus " . $_POST['vertvar'] . " +/- " . $_POST['el_aden'];
					echo ", or " . ($_POST['vertvar'] + $_POST['el_aden']) . " and " . ($_POST['vertvar'] - $_POST['el_aden']);
				}
				else {
					echo "y-direction, and so the<br />x-coordinates are both " . $_POST['vertfix'];
					echo ". The y-coordinates are thus " . $_POST['vertvar'] . " +/- " . $_POST['el_bden'];
					echo ", or " . ($_POST['vertvar'] + $_POST['el_bden']) . " and " . ($_POST['vertvar'] - $_POST['el_bden']);
				}
				echo ".";
			}
			break;
		case 'el_maj':
			$given_maj = preg_replace('/\s/','',$_POST['el_maj']);
			$corr_maj = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($corr_maj == $given_maj) {
				echo "Correct!";
			}
			else {
				echo "Sorry! The major axis of " . $_POST['el_gift'] . " has length " . $_POST['corr_ans'] . ".<br />";
				if ($_POST['el_gifta']) {
					echo "Notice that:<br />";
					echo $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'];
					echo "<br />";
				}
				echo "Since the major axis is the distance across the ellipse at its widest point, <br />and ";
				echo "a is " . ($_POST['corr_ans'] / 2) . " (since the larger divisor is " . (($_POST['corr_ans'] / 2) * ($_POST['corr_ans'] / 2));
				echo "), we arrive at " . $_POST['corr_ans'] . " for the major axis length.<br />";
			}
			break;
		case 'el_min':
			$given_min = preg_replace('/\s/','',$_POST['el_min']);
			$corr_min = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($corr_min == $given_min) {
				echo "Correct!";
			}
			else {
				echo "Sorry! The minor axis of " . $_POST['el_gift'] . " has length " . $_POST['corr_ans'] . ".<br />";
				if ($_POST['el_gifta']) {
					echo "Notice that:<br />";
					echo $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'];
					echo "<br />";
				}
				echo "Since the minor axis is the distance across the ellipse in the narrowest direction, <br />and ";
				echo "b is " . ($_POST['corr_ans'] / 2) . " (since the smaller divisor is " . (($_POST['corr_ans'] / 2) * ($_POST['corr_ans'] / 2));
				echo "), we arrive at " . $_POST['corr_ans'] . " for the minor axis length.<br />";
			}
			break;
		case 'el_vh':
			if ($_POST['corr_ans'] == $_POST['el_vh']) {
				echo "Correct!";
			}
			else {
				echo "Sorry, that ellipse is " . $_POST['corr_ans'] . ".<br />";
				if ($_POST['el_gifta']) {
					echo "Notice that:<br />";
					echo $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'];
					echo "<br />";
				}
				echo "Since the larger denominator divides ";
				if ($_POST['corr_ans'] == "vertical") {
					echo "y<sup>2</sup>, the ellipse is vertical.";
				}
				else {
					echo "x<sup>2</sup>, the ellipse is horizontal.";
				}
			}
			break;
		case 'el_duofoc':
			$given_2c = preg_replace('/\s/','',$_POST['el_duofoc']);
			$corr_2c = preg_replace('/\s/','',$_POST['corr_ans']);
			if ($corr_2c == $given_2c) {
				echo "Correct!";
			}
			else {
				echo "Sorry! The distance between the foci of " . $_POST['el_gift'] . " is " . $_POST['corr_ans'] . "^(1/2).<br />";
				if ($_POST['el_gifta']) {
					echo "Notice that:<br />";
					echo $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'];
					echo "<br />";
				}
				if ($_POST['el_aden'] > $_POST['el_bden']) {
					echo "Since " . pow($_POST['el_aden'],2) . " - " . pow($_POST['el_bden'],2);
				}
				else {
					echo "Since " . pow($_POST['el_bden'],2) . " - " . pow($_POST['el_aden'],2);
				}
				echo " = " . ($_POST['corr_ans'] / 4) . ", the value of c is ";
				echo ($_POST['corr_ans'] / 4) . "^(1/2). The distance between the foci is then<br />";
				echo "2*(" . ($_POST['corr_ans'] / 4) . "^(1/2)), or " . $_POST['corr_ans'] . "^(1/2).";
			}
			break;
		case 'el_ecc':
			#eccentricity of an ellipse
			$guacem = explode('o',$_POST['corr_ans']);
			$guadem = $_POST['el_eff'] . "o" . $_POST['el_egg'];
			if (($guacem[0] == $_POST['el_eff']) && ($guacem[1] == $_POST['el_egg'])) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the eccentricity of " . $_POST['el_gift'] . " is<br />";
				echo $guacem[0] . "^(1/2) / " . $guacem[1] . " = " . (pow($guacem[0], .5) / $guacem[1]) . ".<br />";
				echo "You answered " . $_POST['el_eff'] . "^(1/2) / " . $_POST['el_egg'] . " = " . (pow($_POST['el_eff'], .5) / $_POST['el_egg']) . "<br />";
				if ($_POST['el_gifta']) {
					echo "<br />Notice that:<br />";
					echo $_POST['el_gifta'];
					echo $_POST['el_giftb'];
					echo $_POST['el_giftc'] . "<br />";
				}
				echo "Since the larger of the divisors is " . pow($guacem[1],2) . ", and the difference between ";
				echo " the<br />divisors is " . $guacem[0] . ", the eccentricity is (" . $guacem[0];
				echo " / " . pow($guacem[1],2) . ")^(1/2), or " . (pow($guacem[0], .5) / $guacem[1]) . ".";
			}
			break;
		case 'para_ectn':
			#direction of the parabola's opening
			$mulberry = preg_replace('/\s/','',$_POST['corr_ans']);
			$bosenberry = preg_replace('/\s/','',$_POST['para_ectn']);
			$gooseberry = $mulberry . "wards";
			if (($mulberry == $bosenberry) || ($bosenberry == gooseberry)) {
				echo "Correct!";
			}
			else {
				echo "Sorry, the parabola " . $_POST['para_gift'] . " opens ";
				if (($mulberry == "up") || ($mulberry == "down")) {
					echo $mulberry . "wards. ";
				}
				else {
					echo "to the " . $mulberry . ". ";
				}
				echo "Notice<br />that the " . $_POST['corlet'] . "<sup>2</sup> term has a ";
				if (($_POST['dekkn'] == "up") || ($_POST['dekkn'] == "right")) {
					echo "positive";
				}
				else {
					echo "negative";
				}
				echo " coefficient.";
			}
			break;
	}
	echo "<br /><br /><strong>Next Question:</strong><br />";
}


/*----generating the next problem------*/
$conics = array("circle", "parabola", "hyperbola", "ellipse");
if ($_POST['quert'] == "circ") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ' selected>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = 0;
}
elseif ($_POST['quert'] == "parab") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ'>Circles Only</option>
	<option value='parab' selected>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = 1;
}
elseif ($_POST['quert'] == "hypb") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ'>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb' selected>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = 2;
}
elseif ($_POST['quert'] == "elli") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ' selected>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli' selected>Ellipses Only</option></select>";
	$keykon = 3;
}
elseif ($_POST['quert'] == "parahyp") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp' selected>Parabolas and Hyperbolas</option>
	<option value='circ'>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = mt_rand(1,2);
}
elseif ($_POST['quert'] == "cirnell") {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell' selected>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ'>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = mt_rand(0,1);
	if ($keykon == 1) {
		$keykon = 3;
	}
}
else {
	echo "<select name='quert'>
	<option value='all'>All Conics</option>
	<option value='cirnell'>Circles and Ellipses</option>
	<option value='parahyp'>Parabolas and Hyperbolas</option>
	<option value='circ'>Circles Only</option>
	<option value='parab'>Parabolas Only</option>
	<option value='hypb'>Hyperbolas Only</option>
	<option value='elli'>Ellipses Only</option></select>";
	$keykon = mt_rand(0,3);
}
echo "<br />";
/*Circle, Parabola, Ellipse, Hyperbola.
All:
"Which of the following best describes the graph of the equation ... in the xy-plane?"

Circle:
"Let C be the curve in the xy plane described by the equation x^2 + 4y^2 = 16. If every point (x,y) on C is replaced by the point (1/2x, y), what is the area enclosed by the resulting curve?"
*/
if ($conics[$keykon] == "circle") {
	$circ_cx = mt_rand(-12,12);
	$circ_cy = mt_rand(-12,12);
	$circ_r = mt_rand(1,14);
	$circ_r2 = $circ_r*$circ_r;
	$center = "(" . $circ_cx . ", " . $circ_cy . ")";
	#echo "Center: " . $center . "<br />";
	#echo "Radius: " . $circ_r . "<br />";
	if ($circ_cx == 0) {
		$c_parenthetical = "x^2 + ";
		$c_simplified = "x^2 + ";
	}
	elseif ($circ_cx < 0) {
		$c_parenthetical = "(x + " . (-1*$circ_cx) . ")^2 + ";
		$c_simplified = "x^2 + " . (-2*$circ_cx) . "x + ";
	}
	else {
		$c_parenthetical = "(x - " . $circ_cx . ")^2 + ";
		$c_simplified = "x^2 - " . (2*$circ_cx) . "x + ";
	}
	if ($circ_cy == 0) {
		$c_parenthetical .= "y^2 = " . $circ_r2;
		$c_simplified .= "y^2 = ";
	}
	elseif ($circ_cy < 0) {
		$c_parenthetical .= "(y + " . (-1*$circ_cy) . ")^2 = " . $circ_r2;
		$c_simplified .= "y^2 + " . (-2*$circ_cy) . "y = ";
	}
	else {
		$c_parenthetical .= "(y - " . $circ_cy . ")^2 = " . $circ_r2;
		$c_simplified .= "y^2 - " . (2*$circ_cy) . "y = ";
	}
	#echo $c_parenthetical . "<br />";
	$circ_cx2 = $circ_cx*$circ_cx;
	$circ_cy2 = $circ_cy*$circ_cy;
	$c_simplified .= ($circ_r2 - $circ_cx2 - $circ_cy2);
	#echo $c_simplified . "<br />";
	$c_ecty = mt_rand(0,1);
	if ($c_ecty == 1) {
		echo $c_simplified . "<br />";
		echo "<input type='hidden' name='c_eqn' value='" . $c_simplified . "' />";
		echo "<input type='hidden' name='c_eqn_ty' value='simp' />";
	}
	else {
		echo $c_parenthetical . "<br />";
		echo "<input type='hidden' name='c_eqn' value='" . $c_parenthetical . "' />";
		echo "<input type='hidden' name='c_eqn_ty' value='pare' />";
	}
	echo "<input type='hidden' name='y_ctr' value='" . $circ_cy . "' />";
	echo "<input type='hidden' name='x_ctr' value='" . $circ_cx . "' />";
	echo "<input type='hidden' name='rad' value='" . $circ_r . "' />";
	if ($_POST['quert'] == "circ") {
		$circ_qu = mt_rand(0,3);
	}
	else {
		$circ_qu = mt_rand(0,4);
	}
	switch ($circ_qu) {
		case '0':
			echo "What is the center of this circle? <br />";
			echo "<input type='text' name='circ_cent' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='circ_cent' />";
			echo "<input type='hidden' name='corr_ans' value='" . $center . "' />";
			break;
		case '1':
			echo "What is the radius of this circle? <br />";
			echo "<input type='text' name='circ_rad' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='circ_rad' />";
			echo "<input type='hidden' name='corr_ans' value='" . $circ_r . "' />";
			break;
		case '2':
			echo "What is the area of this circle? <br />";
			echo "&pi; * <input type='text' name='circ_area' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='circ_area' />";
			echo "<input type='hidden' name='corr_ans' value='" . $circ_r2 . "' />";
			break;
		case '3':
			echo "What is the circumference of this circle? <br />";
			echo "&pi; * <input type='text' name='circ_um' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='circ_um' />";
			echo "<input type='hidden' name='corr_ans' value='" . 2*$circ_r . "' />";
			break;
		case '4':
			echo "What type of conic section does this equation represent? <br />";
			echo "<input type='text' name='circ_ty' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='circ_ty' />";
			break;
	}
}
/*Parabola:
"Every point on the parabola y=rt(2x-1) is equidistant from the y-axis and which of the following points?"
*/
elseif ($conics[$keykon] == "parabola") {
	$vertex_a = mt_rand(-14,14);
	$vertex_b = mt_rand(-14,14);
	$x_y_neg_pos = mt_rand(0,3); #0 = positive x, #1 = negative x, #2 = positive y, #3 = negative y
	$spacing = mt_rand (1,6);
	switch ($x_y_neg_pos) {
		case 0:
			#y = (1/4p)(x - h)^2 + k
			#opens upwards
			$directn = "up";
			$corlet = "x";
			$muse = "y";
			$mustard = $vertex_b;
			$corval = $vertex_a;
			#echo $directn . "<br />";
			$focus = "(" . $vertex_a . ", " . ($vertex_b + $spacing) . ")";
			$directrix = "y = " . ($vertex_b - $spacing);
			$eqn = "y = (1/" . (4*$spacing) . ")";
			if ($vertex_a < 0) {
				$eqn .= "(x + " . (-1*$vertex_a) . ")^2 ";
			}
			elseif ($vertex_a == 0) {
				$eqn .= "x^2 ";
			}
			else {
				$eqn .= "(x - " . $vertex_a . ")^2 ";
			}
			if ($vertex_b > 0) {
				$eqn .= " + " . $vertex_b;
			}
			elseif ($vertex_b < 0) {
				$eqn .= " - " . ($vertex_b*-1);
			}
			$ltr_1 = "(" . ($vertex_a + (2*$spacing)) . ", " . ($vertex_b + $spacing) . ")";
			$ltr_2 = "(" . ($vertex_a - (2*$spacing)) . ", " . ($vertex_b + $spacing) . ")";
			$ltr_len = (4*$spacing);
			break;
		case 1:
			#y = (1/4p)(x + h)^2 + k
			#opens downwards
			$directn = "down";
			$corlet = "x";
			$muse = "y";
			$mustard = $vertex_b;
			$corval = $vertex_a;
			#echo $directn . "<br />";
			$focus = "(" . $vertex_a . ", " . ($vertex_b - $spacing) . ")";
			$directrix = "y = " . ($vertex_b + $spacing);
			#$eqn = "y = (-1/" . (4*$spacing) . ")(x - " . $vertex_a . ")^2 + " . $vertex_b;
			$eqn = "y = (-1/" . (4*$spacing) . ")";
			if ($vertex_a < 0) {
				$eqn .= "(x + " . (-1*$vertex_a) . ")^2 ";
			}
			elseif ($vertex_a == 0) {
				$eqn .= "x^2 ";
			}
			else {
				$eqn .= "(x - " . $vertex_a . ")^2 ";
			}
			if ($vertex_b > 0) {
				$eqn .= " + " . $vertex_b;
			}
			elseif ($vertex_b < 0) {
				$eqn .= " - " . ($vertex_b*-1);
			}
			$ltr_1 = "(" . ($vertex_a + (2*$spacing)) . ", " . ($vertex_b - $spacing) . ")";
			$ltr_2 = "(" . ($vertex_a - (2*$spacing)) . ", " . ($vertex_b - $spacing) . ")";
			$ltr_len = (4*$spacing);
			break;
		case 2:
			#opens towards the right
			#(y - k)^2 = 4p(x - h)
			$directn = "right";
			$corlet = "y";
			$muse = "x";
			$mustard = $vertex_a;
			$corval = $vertex_b;
			#echo $directn . "<br />";
			$focus = "(" . ($vertex_a + $spacing) . ", " . $vertex_b . ")";
			$directrix = "x = " . ($vertex_a - $spacing);
			#$eqn = "x = (1/" . (4*$spacing) . ")(y - " . $vertex_b . ")^2 + " . $vertex_a;
			$eqn = "x = (1/" . (4*$spacing) . ")";
			if ($vertex_b < 0) {
				$eqn .= "(y + " . (-1*$vertex_b) . ")^2 ";
			}
			elseif ($vertex_b == 0) {
				$eqn .= "y^2 ";
			}
			else {
				$eqn .= "(y - " . $vertex_b . ")^2 ";
			}
			if ($vertex_a > 0) {
				$eqn .= " + " . $vertex_a;
			}
			elseif ($vertex_a < 0) {
				$eqn .= " - " . ($vertex_a*-1);
			}
			$ltr_1 = "(" . ($vertex_a + $spacing) . ", " . ($vertex_b + (2*$spacing)) . ")";
			$ltr_2 = "(" . ($vertex_a + $spacing) . ", " . ($vertex_b - (2*$spacing)) . ")";
			$ltr_len = (4*$spacing);
			break;
		case 3:
			$corlet = "y";
			$muse = "x";
			$mustard = $vertex_a;
			$corval = $vertex_b;
			$focus = "(" . ($vertex_a - $spacing) . ", " . $vertex_b . ")";
			$directrix = "x = " . ($vertex_a + $spacing);
			$directn = "left";
			#echo $directn . "<br />";
			#$eqn = "x = (-1/" . (4*$spacing) . ")(y - " . $vertex_b . ")^2 + " . $vertex_a;
			$eqn = "x = (-1/" . (4*$spacing) . ")";
			if ($vertex_b < 0) {
				$eqn .= "(y + " . (-1*$vertex_b) . ")^2 ";
			}
			elseif ($vertex_b == 0) {
				$eqn .= "y^2 ";
			}
			else {
				$eqn .= "(y - " . $vertex_b . ")^2 ";
			}
			if ($vertex_a > 0) {
				$eqn .= " + " . $vertex_a;
			}
			elseif ($vertex_a < 0) {
				$eqn .= " - " . ($vertex_a*-1);
			}
			$ltr_1 = "(" . ($vertex_a - $spacing) . ", " . ($vertex_b + (2*$spacing)) . ")";
			$ltr_2 = "(" . ($vertex_a - $spacing) . ", " . ($vertex_b - (2*$spacing)) . ")";
			$ltr_len = (4*$spacing);
			break;
	}
	echo $eqn . "<br />";
	#echo "Directrix: " . $directrix . "<br />Focus: " . $focus . "<br />Vertex: (" . $vertex_a . ", " . $vertex_b . ")<br />";
	#echo "Latus Rectum Endpoints: " . $ltr_1 . ", " . $ltr_2 . "<br />";
	#echo "Latus Rectum Length: " . $ltr_len . "<br />";
	echo "<input type='hidden' name='para_gift' value='" . $eqn . "' />";
	echo "<input type='hidden' name='mustard' value='" . $mustard . "' />"; #vertex coordinate
	echo "<input type='hidden' name='muse' value='" . $muse . "' />"; #vertex x or y
	echo "<input type='hidden' name='corval' value='" . $corval . "' />"; #vertex coordinate
	echo "<input type='hidden' name='corlet' value='" . $corlet . "' />"; #vertex x or y
	echo "<input type='hidden' name='dekkn' value='" . $directn . "' />"; #left, right, up or down
	if (($x_y_neg_pos == 0) || ($x_y_neg_pos == 2)) {
		echo "<input type='hidden' name='pease' value='" . $spacing . "' />"; #p
	}
	else {
		echo "<input type='hidden' name='pease' value='" . (-1*$spacing) . "' />"; #p
	}
	if ($_POST['quert'] == "parab") {
		$para_qu = mt_rand(0,5);
	}
	else {
		$para_qu = mt_rand(0,6);
	}
	#$para_qu = 5;
	switch ($para_qu) {
		case '0':
			echo "What is the vertex of this parabola? <br />";
			echo "<input type='text' name='para_ver' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='para_ver' />";
			echo "<input type='hidden' name='corr_ans' value='(" . $vertex_a . ", " . $vertex_b . ")' />";
			break;
		case '1':
			echo "What is the length of the latus rectum of this parabola? <br />";
			echo "<input type='text' name='para_lrlen' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='para_lrlen' />";
			echo "<input type='hidden' name='corr_ans' value='" . $ltr_len . "' />";
			break;
		case '2':
			echo "What is the equation of the directrix of this parabola? <br />";
			echo "<input type='text' name='para_dir' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='para_dir' />";
			echo "<input type='hidden' name='corr_ans' value='" . $directrix . "' />";
			break;
		case '3':
			echo "What is the focus of this parabola? <br />";
			echo "<input type='text' name='para_foc' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='para_foc' />";
			echo "<input type='hidden' name='corr_ans' value='" . $focus . "' />";
			break;
		case '4':
			echo "What is one of the endpoints of the latus rectum of this parabola? <br />";
			echo "<input type='hidden' name='q_type' value='para_lrpt' />";
			echo "<input type='text' name='para_lrpt' /><br /><br />";
			echo "<input type='hidden' name='corr_ans1' value='" . $ltr_1 . "' />";
			echo "<input type='hidden' name='corr_ans2' value='" . $ltr_2 . "' />";
			break;
		case '5':
			echo "Which direction does this parabola open (left, right, up, or down)?<br />";
			echo "<input type='hidden' name='q_type' value='para_ectn' />";
			echo "<input type='hidden' name='corr_ans' value='" . $directn . "' />";
			echo "<input type='text' name='para_ectn' /><br /><br />";
			break;
		case '6':
			echo "What type of conic section does this equation represent? <br />";
			echo "<input type='text' name='para_ty' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='para_ty' />";
			break;
	}
}
/*Ellipse:*/
elseif ($conics[$keykon] == "ellipse") {
	#echo "ELLIPSE!";
	$a = mt_rand(1,12);
	$b = mt_rand(1,12);
	$x_off = mt_rand(-12,12);
	$y_off = mt_rand(-12,12);
	if ($a == $b) {
		$b += 1;
	}
	$asq = pow($a, 2);
	$bsq = pow($b, 2);
	$diff = $asq - $bsq;
	if ($diff > 0) {
		$maj = 2*$a;
		$min = 2*$b;
		$c = pow($diff, .5);
		#echo "Foci: (" . ($c + $x_off) . ", " . $y_off . "), (" . (($c*-1) + $x_off) . ", " . $y_off . ")<br />";
		#echo "Eccentricity: " . $c / $a . "<br />";
		$el_vert1 = "(" . ($x_off - $a) . ", " . $y_off . ")";
		$el_vert2 = "(" . ($x_off + $a) . ", " . $y_off . ")";
		$etype = "horizontal";
		$vertfix = $y_off;
		$vertvar = $x_off;
	}
	elseif ($diff < 0) {
		$maj = 2*$b;
		$min = 2*$a;
		$diff *= -1;
		$c = pow($diff, .5);
		#echo "Foci: (" . $x_off . ", " . ($c + $y_off) . "), (" . $x_off . ", " . (($c*-1) + $y_off) . ")<br />";
		#echo "Eccentricity: " . $c / $b . "<br />";
		$el_vert1 = "(" . $x_off . ", " . ($y_off + $b) . ")";
		$el_vert2 = "(" . $x_off . ", " . ($y_off - $b) . ")";
		$etype = "vertical";
		$vertfix = $x_off;
		$vertvar = $y_off;
	}
	#echo "Vertices: " . $el_vert1 . ", " . $el_vert2 . "<br />";
	#echo "Major axis: " . $maj . "<br />";
	#echo "Minor axis: " . $min . "<br />";
	if ($x_off == 0) {
		$el_paran = "(x^2 / " . ($a*$a) . ")";
	}
	elseif ($x_off < 0) {
		$el_paran = "((x + " . (-1*$x_off) . ")^2 / " . ($a*$a) . ")";
	}
	else {
		$el_paran = "((x - " . $x_off . ")^2 / " . ($a*$a) . ")";
	}
	if ($y_off == 0) {
		$el_paran .= " + (y^2 / " . ($b*$b) . ") = 1";
	}
	elseif ($y_off < 0) {
		$el_paran .= " + ((y + " . (-1*$y_off) . ")^2 / " . ($b*$b) . ") = 1";
	}
	else {
		$el_paran .= " + ((y - " . $y_off . ")^2 / " . ($b*$b) . ") = 1";
	}
	#echo $el_paran;
	$qwald = gcd_akd($a*$a, $b*$b);
	$bynby = $a*$a*$b*$b/$qwald;
	$xin = $b*$b/$qwald;
	$yin = $a*$a/$qwald;
	$el_step_1 = "((x^2 - " . (2*$x_off) . "x + " . ($x_off*$x_off) . ") / " . ($a*$a) . ") + ((y^2 - " . (2*$y_off) . "y + " . ($y_off*$y_off) . ") / " . ($b*$b) . ") = 1<br />";
	$el_step_2 = $xin . "x^2 - " . (2*$x_off*$xin) . "x + " . ($xin*$x_off*$x_off) . " + " . $yin . "y^2 - ";
	$el_step_2 .= ($yin*2*$y_off) . "y + " . ($yin*$y_off*$y_off) . " = " . $bynby . "<br />";
	#echo $el_step_1 . $el_step_2;
	if ($xin != 1) {
		$el_simpo = $xin . "x^2 ";
	}
	else {
		$el_simpo = "x^2 ";
	}
	if ((2*$x_off*$xin) < 0) {
		$el_simpo .= "+ " . (-2*$x_off*$xin) . "x ";
	}
	elseif ((2*$x_off*$xin) > 0) {
		$el_simpo .= "- " . (2*$x_off*$xin) . "x ";
	}
	$el_simpo .= "+ ";
	if ($yin != 1) {
		$el_simpo .= $yin;
	}
	$el_simpo .=  "y^2 ";
	if (($yin*2*$y_off) < 0) {
		$el_simpo .= "+ " . ($yin*-2*$y_off) . "y ";
	}
	elseif (($yin*2*$y_off) > 0) {
		$el_simpo .= "- " . ($yin*2*$y_off) . "y ";
	}
	$el_simpo .= "= " . ($bynby-(($xin*$x_off*$x_off)+($yin*$y_off*$y_off)));
	$vibrate = mt_rand(0,1);
	if ($vibrate == 1) {
		echo $el_simpo . "<br />";
		$el_gift = $el_simpo;
		$el_typo = "si";
	}
	else {
		echo $el_paran . "<br />";
		$el_gift = $el_paran;
		$el_typo = "non";
	}
	if ($_POST['quert'] == "elli") {
		$noise = mt_rand(0,5);
	}
	else {
		$noise = mt_rand(0,6);
	}
	echo "<input type='hidden' name='el_gift' value='" . $el_gift . "' />";
	if ($el_typo == "si") {
		echo "<input type='hidden' name='el_gifta' value='" . $el_step_2 . "' />";
		echo "<input type='hidden' name='el_giftb' value='" . $el_step_1 . "' />";
		echo "<input type='hidden' name='el_giftc' value='" . $el_paran . "' />";
	}
	echo "<input type='hidden' name='el_aden' value='" . $a . "' />";
	echo "<input type='hidden' name='el_bden' value='" . $b . "' />";
	echo "<input type='hidden' name='el_dire' value='" . $etype . "' />";
	switch ($noise) {
		case '0':
			echo "What is one of the vertices of this ellipse?<br />";
			echo "<input type='text' name='el_vent' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='el_vent' />";
			echo "<input type='hidden' name='vertfix' value='" . $vertfix . "'/>";
			echo "<input type='hidden' name='vertvar' value='" . $vertvar . "'/>";
			echo "<input type='hidden' name='corr_ans1' value='" . $el_vert1 . "' />";
			echo "<input type='hidden' name='corr_ans2' value='" . $el_vert2 . "' />";
			break;
		case '1':
			echo "What is the length of the major axis of this ellipse?<br />";
			echo "<input type='text' name='el_maj' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='el_maj' />";
			echo "<input type='hidden' name='corr_ans' value='" . $maj . "' />";
			break;
		case '2':
			echo "What is the length of the minor axis of this ellipse?<br />";
			echo "<input type='text' name='el_min' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='el_min' />";
			echo "<input type='hidden' name='corr_ans' value='" . $min . "' />";
			break;
		case '3':
			echo "What is the eccentricity of this ellipse?<br />";
			#give two boxes for a rational with a "^(1/2)" on the top
			echo "<input type='hidden' name='q_type' value='el_ecc' />";
			echo "<input type='hidden' name='corr_ans' value='";
			if ($a > $b) {
				echo $diff . "o" . $a;
			}
			else {
				echo $diff . "o" . $b;
			}
			echo "' />";
			echo "<input type='text' name='el_eff' size='3'/>^(1/2) / <input type='text' name='el_egg' size='3'/> ";
			echo "(enter as a rational)<br /><br />";
			break;
		case '4':
			echo "What is the distance between the foci of this ellipse?<br />";
			echo "<input type='text' name='el_duofoc' />^(1/2)<br /><br />";
			echo "<input type='hidden' name='q_type' value='el_duofoc' />";
			echo "<input type='hidden' name='corr_ans' value='" . ($diff*4) . "' />";
			#still a square root
			break;
		case '5':
			echo "Is this ellipse vertical or horizontal?<br />";
			echo "<input type='text' name='el_vh' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='el_vh' />";
			echo "<input type='hidden' name='corr_ans' value='" . $etype . "' />";
			break;
		case '6':
			echo "What type of conic section does this equation represent?<br />";
			echo "<input type='text' name='el_ty' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='el_ty' />";
			break;
	}
}
/*Hyperbola:*/
else {
	$hyp_a = mt_rand(1,15);
	$hyp_b = mt_rand(1,15);
	#$hyp_a=5;
	#$hyp_b=12;
	$hyp_a2 = $hyp_a * $hyp_a;
	$hyp_b2 = $hyp_b * $hyp_b;
	$hyp_c = sqrt($hyp_a2 + $hyp_b2);
	$hyp_as = $hyp_b/$hyp_a;
	$dirtype = mt_rand(0,1);
	if ($dirtype == 0) {
		#hyperbola that never crosses y-axis, symmetric over the x-axis
		$axe = "y";
		if ($hyp_c == round($hyp_c)) {
			$fochi = "(" . $hyp_c . ", 0), (-" . $hyp_c . ", 0)";
		}
		else {
			$fochi = "(" . ($hyp_a2 + $hyp_b2) . "^(1/2), 0), (-[" . ($hyp_a2 + $hyp_b2) . "^(1/2)], 0)";
		}
		$vertices = "Vertices: (" . $hyp_a . ", 0), (-" . $hyp_a . ", 0)";
		$vertval = $hyp_a;
		$vertype = "x";
		$vertans1 = "(" . $hyp_a . ", 0)";
		$vertans2 = "(-" . $hyp_a . ", 0)";
		$asymp = "Asymptotes: y = " . $hyp_as . "x, y = -" . $hyp_as . "x";
		$hyp_eqat = "(x^2 / " . $hyp_a2 . ") - (y^2 / " . $hyp_b2 . ") = 1";
	}
	else {
		#hyperbola that never crosses the x-axis, symmetric over the y-axis
		$axe = "x";
		$fochi = "(0, " . $hyp_c . "), (0, -" . $hyp_c . ")";
		$vertices =  "Vertices: (0, " . $hyp_b . "), (0, -" . $hyp_b . ")";
		$vertval = $hyp_b;
		$vertype = "y";
		$vertans1 = "(0, " . $hyp_b . ")";
		$vertans2 = "(0, -" . $hyp_b . ")";
		$asymp = "Asymptotes: y = " . $hyp_as . "x, y = -" . $hyp_as . "x";
		$hyp_eqat = "(y^2 / " . $hyp_b2 . ") - (x^2 / " . $hyp_a2 . ") = 1";
	}
	#echo "Foci: " . $fochi . "<br />" . $vertices . "<br />" . $asymp . "<br />";
	echo $hyp_eqat . "<br />";
	echo "<input type='hidden' name='hyrnd' value='" . $hyp_eqat . "' />";
	echo "<input type='hidden' name='hyra' value='" . $hyp_a . "' />";
	echo "<input type='hidden' name='hyrb' value='" . $hyp_b . "' />";
	#echo "fuck";
	#echo $conics[$keykon];
	if ($_POST['quert'] == "hypb") {
		$hypercube = mt_rand(1,3);
	}
	else {
		$hypercube = mt_rand(0,3);
	}
	#$hypercube = 2;
	switch ($hypercube) {
		case '0':
			echo "What type of conic section does this equation represent?<br />";
			echo "<input type='text' name='hyp_ty' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='hyp_ty' />";
			break;
		case '1':
			echo "What is one of the vertices of this hyperbola?<br />";
			echo "<input type='text' name='venti' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='venti' />";
			echo "<input type='hidden' name='vertval' value='" . $vertval . "' />";
			echo "<input type='hidden' name='vertype' value='" . $vertype . "' />";
			echo "<input type='hidden' name='corr_ans1' value='" . $vertans1 . "' />";
			echo "<input type='hidden' name='corr_ans2' value='" . $vertans2 . "' />";
			break;
		case '2':
			echo "Which axis does this hyperbola never cross?<br />";
			echo "<input type='text' name='hyper' /><br /><br />";
			echo "<input type='hidden' name='q_type' value='hyper' />";
			echo "<input type='hidden' name='corr_ans' value='" . $axe . "' />";
			break;
		case '3':
			echo "What is the distance of one of this hyperbola's foci from the " . $axe . "-axis?<br />";
			echo "<input type='hidden' name='hyzix' value='" . $axe . "' />";
			if ($hyp_c == round($hyp_c)) {
				echo "<input type='text' name='hyfi' /><br /><br />";
				echo "<input type='hidden' name='q_type' value='hyfi' />";
				echo "<input type='hidden' name='corr_ans' value='" . $hyp_c . "' />";
			}
			else {
				echo "<input type='text' name='hyfi2' />^(1/2)<br /><br />";
				echo "<input type='hidden' name='q_type' value='hyfi2' />";
				echo "<input type='hidden' name='corr_ans' value='" . ($hyp_a2 + $hyp_b2) . "' />";
			}
			break;
	}
}
/*Hyperbola:
"One of the foci of the hyperbola y^2 = (x/a)^2 + 1 is the point (0, rt(2)). Find a.
*/
?>
<input type="submit" value="Check Answer" />
</form>
<?php echo "</div></div>";
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
