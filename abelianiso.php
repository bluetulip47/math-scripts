<html>
<head>
<title>
Nonisomorphic Abelian Groups Lister
</title>
<link rel="stylesheet" type="text/css" href="discrepancy.css">
<script type="text/javascript">
function checkIst() {
	var woocht = true;
	var errmig = "";
	var awnoz = document.abelinot.checksum.value;
	//alert(awnpos);
	if (awnoz.match(/[^0-9]/g)) {
		errmig += "Please enter only numbers.";
		document.abelinot.checksum.focus();
		woocht = false;
	}
	else if (awnoz >= 240) {
		errmig += "Can currently only handle 2-239, sorry!";
		document.abelinot.checksum.focus();
		woocht = false;
	}
	if (!woocht) {
		alert(errmig);
	}
	return woocht;
}
</script>
</head>
<body>
<?php
include "header.inc.php";
echo "<div class=\"midsxn\">";
include "sidepanel.inc.php";
echo "<div class=\"mainpan\">";?>
Please enter a number between 2 and 239 [inclusive].<br />
The isomorphism classes of your number will then be listed.<br />
(You can also simply hit "Find Groups" to have a number chosen at random.)<br /><br />
<form name="abelinot" method="post" action="abelianiso.php" onsubmit="return checkIst();">
<?php
/*----PRIMEIT: generating prime factors------*/
#
#     When extending the range of numbers it can do, change:
#	  (1) extend the list of primes
#     (2) the check within primeit for what are numbers it's willing to factor
#     (3) the javascript check
#     (4) the random number generator when there isn't a given number
#     (5) labels on box and in javascript
#
function primeit ($funkin) {
	//add in a check for funkin bein' non-numerical or non-integer
	$jazzin = array(2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71,73,79,83,89,97,101,103,107,109,113,127,131,137,139,149,151,157,163,167,173,179,181,191,193,197,199,211,223,227,229,233,239,241);
	//add in capability to generate own prime list instead of checking against premade array
	if (($funkin >= 240) || ($funkin <= 1)) {
		$ponzi = $funkin;
	}
	elseif (in_array($funkin, $jazzin)) {
		//funkin is prime within allowable range
		$ponzi = $funkin;
	}
	else {
		//funkin is 2-239 and composite
		$ponzi = array();
		$mullz = count($jazzin);
		for ($i = 0; ($i <= $mullz) && ($jazzin[$i] <= $funkin); $i++) {
			if (round($funkin / $jazzin[$i]) == ($funkin / $jazzin[$i])) {
				$newkid = 1;
				while (($funkin / pow($jazzin[$i], $newkid)) == (round($funkin / pow($jazzin[$i], $newkid)))) {
					$newkid += 1;
				}
				$newkid -= 1;
				$ponzi[$jazzin[$i]] = $newkid;
				#$ponzi .= " " . $jazzin[$i] . "^" . $newkid . " *";
			}
		}
	}
	return $ponzi;
}
if (is_numeric($_POST['checksum']) && ($_POST['checksum'] >= 2) && ($_POST['checksum'] <= 239)) {
	$boontown = $_POST['checksum'];
}
else {
	$boontown = mt_rand(2,239);
}
#$boontown = 56;
$badonkadonk = primeit($boontown);
//partition functions
if (is_array($badonkadonk)) {
	echo $boontown . " = ";
	if (count($badonkadonk) == 1) {
		//all powers of a single prime
		if (in_array(2, $badonkadonk)) {
			$honky = array_search(2, $badonkadonk);
			echo $honky . " * " . $honky . "<br />";
			echo "Thus there are two nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $honky . "</sub> &#8853; Z<sub>" . $honky . "</sub><br />";
			echo "(2) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (in_array(3, $badonkadonk)) {
			$tonk = array_search(3, $badonkadonk);
			echo $tonk . " * " . $tonk . " * " . $tonk . "<br />";
			echo "Thus there are three nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $tonk . "</sub> &#8853; Z<sub>" . $tonk . "</sub> &#8853; Z<sub>" . $tonk . "</sub><br />";
			echo "(2) Z<sub>" . $tonk . "</sub> &#8853; Z<sub>" . pow($tonk, 2) . "</sub><br />";
			echo "(3) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (in_array(4, $badonkadonk)) {
			$whit = array_search(4, $badonkadonk);
			echo $whit . " * " . $whit . " * " . $whit . " * " . $whit . "<br />";
			echo "Thus there are five nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . $whit . "</sub><br />";
			echo "(2) Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . pow($whit,2) . "</sub><br />";
			echo "(3) Z<sub>" . pow($whit,2) . "</sub> &#8853; Z<sub>" . pow($whit,2) . "</sub><br />";
			echo "(4) Z<sub>" . $whit . "</sub> &#8853; Z<sub>" . pow($whit,3) . "</sub><br />";
			echo "(5) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (in_array(5, $badonkadonk)) {
			$orange = array_search(5, $badonkadonk);
			echo $orange . " * " . $orange . " * " . $orange . " * " . $orange . " * " . $orange . "<br />";
			echo "Thus there are seven nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub><br />";
			echo "(2) Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . pow($orange,2) . "</sub><br />";
			echo "(3) Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . pow($orange,2) . "</sub> &#8853; Z<sub>" . pow($orange,2) . "</sub><br />";
			echo "(4) Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . pow($orange,3) . "</sub><br />";
			echo "(5) Z<sub>" . pow($orange,2) . "</sub> &#8853; Z<sub>" . pow($orange,3) . "</sub><br />";
			echo "(6) Z<sub>" . $orange . "</sub> &#8853; Z<sub>" . pow($orange,4) . "</sub><br />";
			echo "(7) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (in_array(6, $badonkadonk)) {
			$purple = array_search(6, $badonkadonk);
			echo $purple . " * " . $purple . " * " . $purple . " * " . $purple . " * " . $purple . " * " . $purple . "<br />";
			echo "Thus there are eleven nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub><br />";
			echo "(2) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub><br />";
			echo "(3) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub><br />";
			echo "(4) Z<sub>" . pow($purple,2) . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub><br />";
			echo "(5) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,3) . "</sub><br />";
			echo "(6) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,2) . "</sub> &#8853; Z<sub>" . pow($purple,3) . "</sub><br />";
			echo "(7) Z<sub>" . pow($purple,3) . "</sub> &#8853; Z<sub>" . pow($purple,3) . "</sub><br />";
			echo "(8) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,4) . "</sub><br />";
			echo "(9) Z<sub>" . pow($purple,2) . "</sub> &#8853; Z<sub>" . pow($purple,4) . "</sub><br />";
			echo "(10) Z<sub>" . $purple . "</sub> &#8853; Z<sub>" . pow($purple,5) . "</sub><br />";
			echo "(11) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (in_array(7, $badonkadonk)) {
			$pink = array_search(7, $badonkadonk);
			echo $pink . "<sup>7</sup><br />";
			echo "Thus there are fifteen nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub><br />";
			echo "(2) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,2) ."</sub><br />";
			echo "(3) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,2) ."</sub> &#8853; Z<sub>" . pow($pink,2) . "</sub><br />";
			echo "(4) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,2) . "</sub> &#8853; Z<sub>" . pow($pink,2) . "</sub> &#8853; Z<sub>" . pow($pink,2) . "</sub><br />";
			echo "(5) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,3) ."</sub><br />";
			echo "(6) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,2) ."</sub> &#8853; Z<sub>" . pow($pink,3) ."</sub><br />";
			echo "(7) Z<sub>" . pow($pink,2) ."</sub> &#8853; Z<sub>" . pow($pink,2) ."</sub> &#8853; Z<sub>" . pow($pink,3) ."</sub><br />";
			echo "(8) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,3) ."</sub> &#8853; Z<sub>" . pow($pink,3) ."</sub><br />";
			echo "(9) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,4) ."</sub><br />";
			echo "(10) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,2) ."</sub> &#8853; Z<sub>" . pow($pink,4) ."</sub><br />";
			echo "(11) Z<sub>" . pow($pink,3) ."</sub> &#8853; Z<sub>" . pow($pink,4) ."</sub><br />";
			echo "(12) Z<sub>" . $pink . "</sub> &#8853;  Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,5) . "</sub><br />";
			echo "(13) Z<sub>" . pow($pink,2) . "</sub> &#8853; Z<sub>" . pow($pink,5) . "</sub><br />";
			echo "(14) Z<sub>" . $pink . "</sub> &#8853; Z<sub>" . pow($pink,6) . "</sub><br />";
			echo "(15) Z<sub>" . $boontown . "</sub><br />";
		}
		else {
			echo "IS SINGUHL VAHLUU.";
		}
	}
	elseif (count($badonkadonk) == 2) {
		//all composite numbers with exactly two unique prime factors
		$pandq = array_keys($badonkadonk);
		$p = $pandq[0];
		$q = $pandq[1];
		if (max($badonkadonk) == 1) {
			//is a composite number with exactly two unique prime factors, each to the first power
			echo $p . " * " . $q . "<br />";
			echo "Thus there is precisely one abelian group of order " . $boontown . "<br />";
			echo "up to isomorphism: Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 2 && !in_array(1,$badonkadonk)) {
			//square of two primes
			echo $p . "<sup>2</sup> * " . $q . "<sup>2</sup><br />";
			echo "Thus there are four nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . ($p*$q) . "</sub> &#8853; Z<sub>" . ($p*$q) . "</sub><br />";
			echo "(2) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$q*$q) . "</sub><br />";
			echo "(3) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$p*$q) . "</sub><br />";
			echo "(4) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 2) {
			//one prime is squared, one prime is solo
			$loner = array_search(1, $badonkadonk);
			$square = array_search(2, $badonkadonk);
			if ($loner == $p) {
				echo $loner . " * " . $square . "<sup>2</sup><br />";
			}
			else {
				echo $square . "<sup>2</sup> * " . $loner . "<br />";
			}
			echo "Thus there are two nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $square . "</sub> &#8853; Z<sub>" . ($loner*$square) . "</sub><br />";
			echo "(2) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 3 && in_array(1,$badonkadonk)) {
			//one prime is cubed, one prime is solo
			$lonz = array_search(1, $badonkadonk);
			$kyoob = array_search(3, $badonkadonk);
			if ($lonz == $p) {
				echo $lonz . " * " . $kyoob . "<sup>3</sup><br />";
			}
			else {
				echo $kyoob . "<sup>3</sup> * " . $lonz . "<br />";
			}
			echo "Thus there are three nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $kyoob . "</sub> &#8853; Z<sub>" . $kyoob . "</sub> &#8853; Z<sub>" . ($lonz*$kyoob) . "</sub><br />";
			echo "(2) Z<sub>" . $kyoob . "</sub> &#8853; Z<sub>" . ($lonz*$kyoob*$kyoob) . "</sub><br />";
			echo "(3) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 4 && in_array(1,$badonkadonk)) {
			//one prime is quarted, one prime is solo
			$lolz = array_search(1, $badonkadonk);
			$quart = array_search(4, $badonkadonk);
			if ($lolz == $p) {
				echo $lolz . " * " . $quart . "<sup>4</sup><br />";
			}
			else {
				echo $quart . "<sup>4</sup> * " . $lolz . "<br />";
			}
			echo "Thus there are five nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . ($quart*$lolz). "</sub><br />";
			echo "(2) Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . ($quart*$quart*$lolz) . "</sub><br />";
			echo "(3) Z<sub>" . pow($quart,2) . "</sub> &#8853; Z<sub>" . (pow($quart,2)*$lolz) . "</sub><br />";
			echo "(4) Z<sub>" . $quart . "</sub> &#8853; Z<sub>" . (pow($quart,3)*$lolz) . "</sub><br />";
			echo "(5) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 5 && in_array(1,$badonkadonk)) {
			//one prime is to the fifth, other prime is solo
			$lanz = array_search(1, $badonkadonk);
			$quint = array_search(5, $badonkadonk);
			if ($lanz == $p) {
				echo $lanz . " * " . $quint . "<sup>5</sup><br />";
			}
			else {
				echo $quint . "<sup>5</sup> * " . $lanz . "<br />";
			}
			echo "Thus there are seven nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . ($quint*$lanz) . "</sub><br />";
			echo "(2) Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . (pow($quint,2)*$lanz) . "</sub><br />";
			echo "(3) Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . pow($quint,2) . "</sub> &#8853; Z<sub>" . (pow($quint,2)*$lanz) . "</sub><br />";
			echo "(4) Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . (pow($quint,3)*$lanz) . "</sub><br />";
			echo "(5) Z<sub>" . pow($quint,2) . "</sub> &#8853; Z<sub>" . (pow($quint,3)*$lanz) . "</sub><br />";
			echo "(6) Z<sub>" . $quint . "</sub> &#8853; Z<sub>" . (pow($quint,4)*$lanz) . "</sub><br />";
			echo "(7) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ($boontown == pow($p,3)*pow($q,2)) {
			//of the form p^3q^2
			echo $p . "<sup>3</sup> * " . $q . "<sup>2</sup><br />";
			echo "Thus there are six nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$q) . "</sub> &#8853; Z<sub>" . ($p*$q). "</sub><br />";
			echo "(2) Z<sub>" . ($p*$q) . "</sub> &#8853; Z<sub>" . ($p*$p*$q) . "</sub><br />";
			echo "(3) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$q*$q). "</sub><br />";
			echo "(4) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$p*$p*$q) . "</sub><br />";
			echo "(5) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$p*$q*$q) . "</sub><br />";
			echo "(6) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ($boontown == pow($q,3)*pow($p,2)) {
			//of the form p^2q^3
			echo $p . "<sup>2</sup> * " . $q . "<sup>3</sup><br />";
			echo "Thus there are six nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$q) . "</sub> &#8853; Z<sub>" . ($p*$q). "</sub><br />";
			echo "(2) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$p*$q). "</sub><br />";
			echo "(3) Z<sub>" . ($p*$q) . "</sub> &#8853; Z<sub>" . ($q*$q*$p) . "</sub><br />";
			echo "(4) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$p*$q*$q) . "</sub><br />";
			echo "(5) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$q*$q*$q) . "</sub><br />";
			echo "(6) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ($boontown == pow($p,4)*pow($q,2)) {
			//of the form p^4q^2
			echo $p . "<sup>4</sup> * " . $q . "<sup>2</sup><br />";
			echo "Thus there are ten nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $p*$q . "</sub><br />";
			echo "(2) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*$q*$q . "</sub><br />";
			echo "(3) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $p*$p*$q . "</sub><br />";
			echo "(4) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*$p*$q*$q . "</sub><br />";
			echo "(5) Z<sub>" . $p*$p*$q . "</sub> &#8853; Z<sub>" . ($p*$p*$q) . "</sub><br />";
			echo "(6) Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . ($p*$p*$p*$q) . "</sub><br />";
			echo "(7) Z<sub>" . $p*$p . "</sub> &#8853; Z<sub>" . ($p*$p*$q*$q) . "</sub><br />";
			echo "(8) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . ($p*$p*$p*$p*$q) . "</sub><br />";
			echo "(9) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . ($p*$p*$p*$q*$q) . "</sub><br />";
			echo "(10) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif (max($badonkadonk) == 6 && in_array(1,$badonkadonk)) {
			//one prime is to the sixth, other prime is solo
			$loin = array_search(1, $badonkadonk);
			$sarx = array_search(6, $badonkadonk);
			if ($loin == $p) {
				echo $loin . " * " . $sarx . "<sup>6</sup><br />";
			}
			else {
				echo $sarx . "<sup>6</sup> * " . $loin . "<br />";
			}
			echo "Thus there are eleven nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx*$loin . "</sub><br />";
			echo "(2) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,2)*$loin . "</sub><br />";
			echo "(3) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,2) . "</sub> &#8853; Z<sub>" . pow($sarx,2)*$loin . "</sub><br />";
			echo "(4) Z<sub>" . pow($sarx,2) . "</sub> &#8853; Z<sub>" . pow($sarx,2) . "</sub> &#8853; Z<sub>" . pow($sarx,2)*$loin . "</sub><br />";
			echo "(5) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,3)*$loin . "</sub><br />";
			echo "(6) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,2) . "</sub> &#8853; Z<sub>" . pow($sarx,3)*$loin . "</sub><br />";
			echo "(7) Z<sub>" . pow($sarx,3) . "</sub> &#8853; Z<sub>" . pow($sarx,3)*$loin . "</sub><br />";
			echo "(8) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,4)*$loin . "</sub><br />";
			echo "(9) Z<sub>" . pow($sarx,2) . "</sub> &#8853; Z<sub>" . pow($sarx,4)*$loin . "</sub><br />";
			echo "(10) Z<sub>" . $sarx . "</sub> &#8853; Z<sub>" . pow($sarx,5)*$loin . "</sub><br />";
			echo "(11) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ($boontown == pow($p,3)*pow($q,3)) {
			//composite number of the form p^3*q^3, ie (pq)^3
			echo $p . "<sup>3</sup> * " . $q . "<sup>3</sup><br />";
			echo "Thus there are nine nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $p*$q . "</sub><br />";
			echo "(2) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $q*pow($p,2) . "</sub><br />";
			echo "(3) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . $p*pow($q,2) . "</sub><br />";
			echo "(4) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . $q . "</sub> &#8853; Z<sub>" . $q*pow($p,3) . "</sub><br />";
			echo "(5) Z<sub>" . $p*$q . "</sub> &#8853; Z<sub>" . pow($p,2)*pow($q,2) . "</sub><br />";
			echo "(6) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p . "</sub> &#8853; Z<sub>" . $p*pow($q,3) . "</sub><br />";
			echo "(7) Z<sub>" . $q . "</sub> &#8853; Z<sub>" . pow($p,3)*pow($q,2) . "</sub><br />";
			echo "(8) Z<sub>" . $p . "</sub> &#8853; Z<sub>" . pow($p,2)*pow($q,3) . "</sub><br />";
			echo "(9) Z<sub>" . $boontown . "</sub><br />";
		}
		else {
			echo "IZ TOO PRIMZ.";
		}
	}
	elseif (count($badonkadonk) == 3) {
		//all composite numbers with exactly three unique prime factors
		$mno = array_keys($badonkadonk);
		$m = $mno[0];
		$n = $mno[1];
		$o = $mno[2];
		if (max($badonkadonk) == 1) {
			//is a composite number with exactly three unique prime factors, each to the first power
			echo $m . " * " . $n . " * " . $o . "<br />";
			echo "Thus there is precisely one abelian group of order " . $boontown . "<br />";
			echo "up to isomorphism: Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ((max($badonkadonk) == 2) && ($boontown == ($m*$m*$n*$o))) {
			//is of the form m^2no
			echo $m . "<sup>2</sup> * " . $n . " * " . $o . "<br />";
			echo "Thus there are precisely two nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $m . "</sub> &#8853; Z<sub>" . ($m*$n*$o) . "</sub><br />";
			echo "(2) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ((max($badonkadonk) == 2) && ($boontown == ($m*$n*$n*$o))) {
			//is of the form mn^2o
			echo $m . " * " . $n . "<sup>2</sup> * " . $o . "<br />";
			echo "Thus there are precisely two nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $n . "</sub> &#8853; Z<sub>" . ($m*$n*$o) . "</sub><br />";
			echo "(2) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ((max($badonkadonk) == 2) && ($boontown == ($m*$n*$o*$o))) {
			//is of the form mno^2
			echo $m . " * " . $n . " * " . $o . "<sup>2</sup><br />";
			echo "Thus there are precisely two nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $o . "</sub> &#8853; Z<sub>" . ($m*$n*$o) . "</sub><br />";
			echo "(2) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ((max($badonkadonk) == 3) && ($boontown == ($m*$m*$m*$n*$o))) {
			echo $m . "<sup>3</sup> * " . $n . " * " . $o . "<br />";
			echo "Thus there are precisely three nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $m . "</sub> &#8853; Z<sub>" . $m . "</sub> &#8853; Z<sub>" . ($m*$n*$o) . "</sub><br />";
			echo "(2) Z<sub>" . $m . "</sub> &#8853; Z<sub>" . ($m*$m*$n*$o) . "</sub><br />";
			echo "(3) Z<sub>" . $boontown . "</sub><br />";
		}
		elseif ((max($badonkadonk) == 2) && ($boontown == ($m*$m*$n*$n*$o))) {
			echo $m . "<sup>2</sup> * " . $n . "<sup>2</sup> * " . $o . "<br />";
			echo "Thus there are precisely four distinct nonisomorphic abelian groups of order " . $boontown . ",<br />";
			echo "(1) Z<sub>" . $m*$n . "</sub> &#8853; Z<sub>" . $m*$n*$o . "</sub></br>";
			echo "(2) Z<sub>" . $n . "</sub> &#8853; Z<sub>" . $m*$m*$n*$o . "</sub></br>";
			echo "(3) Z<sub>" . $m . "</sub> &#8853; Z<sub>" . $m*$n*$n*$o . "</sub></br>";
			echo "(4) Z<sub>" . $boontown . "</sub><br />";
		}
		else {
			echo "IZ TREE PRIMZ.";
		}
	}
	elseif (count($badonkadonk) == 4) {
		//all composite numbers with exactly four unique prime factors
		$wxyz = array_keys($badonkadonk);
		$w = $wxyz[0];
		$x = $wxyz[1];
		$y = $wxyz[2];
		$z = $wxyz[3];
		if (max($badonkadonk) == 1) {
			echo $w . " * " . $x . " * " . $y . " * " . $z . "<br />";
			echo "Thus there is precisely one abelian group of order " . $boontown . " up to isomorphism, Z<sub>" . $boontown . "</sub>.<br />";
		}
		else {
			echo "IZ PHOOR PRIMZ.";
		}
	}
	else {
		foreach($badonkadonk as $base => $expon) {
			echo $base . "^" . $expon . " * ";
		}
	}
}
else {
	echo $boontown . " is prime. Thus, the unique abelian group of order " . $boontown . " is Z<sub>" . $boontown . "</sub>.<br />";
	#echo primeit($boontown);
}
?>
<input type='text' name='checksum' />
<input type="submit" value="Find Groups" />
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
