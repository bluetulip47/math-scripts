function esp(form) {
	var k = parseInt(form.inputboxorder.value);
	if (form.resultbox.value.indexOf("?") >= 0) {
		var q = form.inputboxanswer.value;
	}
	else {
		form.inputboxanswer.value = "";
		var q = "";
	}
	//alert(k);
	if (k == 1) {
		form.resultbox.value = ("Your group is the group with a single element, the identity.");
	}
	else if (isprime(k)) {
		form.resultbox.value = ("Your group is the cyclic group Z_" + k + ". It is abelian and contains no subgroups. It is a simple group.");
	}
	else if (ispq(k) == 2) {
		if (form.inputboxanswer.value == "") {
			form.resultbox.value = ("Your group is abelian. Is it cyclic? Alternately, does it contain an element of order greater than " + sqrt(k) + "?");
		}
		else if (q.indexOf('y') >= 0) {
			form.resultbox.value = ("Your group is the cyclic group Z_" + k + ".");
		}
		else {
			form.resultbox.value = ("Your group is the group Z_" + sqrt(k) + " * Z_" + sqrt(k) + ".");
		}
	}
	else if (ispq(k) == 1) {
		var p = fakdurA(k);
		var q = (k / fakdurA(k));
		var qm1 = (q - 1);
		if ((qm1 % p) == 0) {
			if (p == 2) {
				form.resultbox.value = ("Your group is the dihedral group of order " + k + ", which is also ");
			}
			else {
				form.resultbox.value = ("Your group is ");
			}
			form.resultbox.value += ("isomorphic to the group Z_" + p + " * Z_" + q + ". It contains two normal subgroups, isomorphic to Z_" + p + " and Z_" + q + ".");
		}
		else {
			form.resultbox.value = ("Your group is the cyclic group of order " + k + ".");
		}
	}
	else if (k == 15) {
		form.resultbox.value = ("Your group is isomorphic to Z_15, the cyclic group of order 15. It has two normal subgroups, one isomorphic to Z_3 and one isomorphic to Z_5.");
	}
	else if (k > 20) {
		form.resultbox.value = ("Sorry, the classifier cannot currently handle groups of orders greater than 20 that are not prime or the product of two primes.");
	}
	else {
		var abel = [1, 1, 1, 2, 1, 1, 1, 3, 2, 1, 1, 2, 1, 1, 1, 5, 1, 2, 1, 2];
		var nab = [0, 0, 0, 0, 0, 1, 0, 2, 0, 1, 0, 3, 0, 1, 0, 9, 0, 3, 0, 3];
		if (q == "") {
			form.resultbox.value = ("There are " + abel[k-1] + " abelian groups of order " + k + " and " + nab[k-1] + " non-abelian groups. ");
		}
	
		if ((k == 4) && (form.inputboxanswer.value == "")) {
			form.resultbox.value += ("Does your group have more than one proper subgroup?");
		}
		else if (k == 4) {
			if (form.inputboxanswer.value.match('y')) {
				form.resultbox.value = ("Your group is isomorphic to Z_2 x Z_2, the Klein Four-Group (or Vierergruppe, thus often designated by V instead of Z_2 x Z_2). It has three proper normal subgroups, all isomorphic to Z_2.");
			}
			else {
				form.resultbox.value = ("Your group is isomorphic to Z_4, the cyclic group of order 4. It contains one normal subgroup, isomorphic to Z_2.");
			}
		}
		else if (k == 9) {
			if (form.inputboxanswer.value == "") {
				form.resultbox.value += ("Is your group cyclic? Alternately, does it contain fewer than three subgroups?");
			}
			else if (q.indexOf('y') >= 0) {
				form.resultbox.value = ("Your group is isomorphic to Z_9. It contains one subgroup, isomorphic to Z_3.");
			}
			else {
				form.resultbox.value = ("Your group is isomorphic to the direct product Z_3 x Z_3. It contains four subgroups, all isomorphic to Z_3.");
			}
		}
		else if (form.inputboxanswer.value == "") {
			//handles groups of order 6, 8, 10, 12, 14, 16 18 and 20.
			form.resultbox.value += ("Is your group abelian?");
		}
		else {
			if (k == 6) {
				if (q.indexOf('y') >= 0) {
					form.resultbox.value = ("Your group is isomorphic to Z_6, the cyclic group of order 6, which is also isomorphic to the direct product of Z_2 and Z_3, Z_2 x Z_3. It contains two subgroups, one isomorphic to Z_2 and the other isomorphic to Z_3.");
				}
				else {
					form.resultbox.value = ("Your group is isomorphic to the symmetry group S_3, which is also the dihedral group D_6. It contains four subgroups, three isomorphic to Z_2, and one isomorphic to Z_3.");
				}
			}
			else if (k == 10) {
				if (q.indexOf('y') >= 0) {
					form.resultbox.value = ("Your group is isomorphic to Z_10, the cyclic group of order 10, which is also isomorphic to Z_2 x Z_5 (the direct product of Z_2 and Z_5). It contains two subgroups, one isomorphic to Z_2 and the other isomorphic to Z_5.");
				}
				else {
					form.resultbox.value = ("Your group is isomorphic to the dihedral group D_10. It contains six subgroups, one of which is isomorphic to Z_5. The other five subgroups are all isomorphic to Z_2.");
				}
			}
			else if (k == 14) {
				if (q.indexOf('y') >= 0) {
					form.resultbox.value = ("Your group is isomorphic to the cyclic group of order 14, which is also isomorphic to Z_2 x Z_7 (the direct product of Z_2 and Z_7). It contains two subgroups, one isomorphic to Z_2 and one isomorphic to Z_7.");
				}
				else {
					form.resultbox.value = ("Your group is isomorphic to the dihedral group D_14. It contains eight subgroups, one of which is isomorphic to the cyclic group of order 7, and is normal. The other seven subgroups are all non-normal, and isomorphic to the cyclic group of order 2.");
				}
			}
			else {
				//handles groups of order 8, 12, 16, 18 and 20
				//16, 18 and 20 are handled entirely by their subroutines
				//the non-abelian groups of 12 are handled by a distinct subroutine, though some of the classification happens within this mess.
				//the abelian groups of 8 are handled by a distinct subroutine, though again, some of the classification happens within the main routine.
				var prevQ = form.resultbox.value;
				//alert(prevQ);
				if (k == 16) {
					form.resultbox.value = sixteen(prevQ, q);
				}
				else if (k == 18) {
					form.resultbox.value = eighteen(prevQ, q);
				}
				else if (k == 20) {
					form.resultbox.value = twenni(prevQ, q);
				}
				else if ((prevQ.indexOf("abelian") >= 0) && (!(prevQ.indexOf('Klein') >= 0)) && (!(prevQ.indexOf('alternating') >= 0)) && (q.indexOf('y') == -1)) {
					//this should only call non-abelian 8 and 12
					//for the answer to the second question
					form.resultbox.value = ("Your group is non-abelian. There are " + nab[k-1] + " such groups of order " + k + ". ");
					if (k == 8) {
						form.resultbox.value += ("Is your group dihedral? Alternately, does it contain more than five subgroups? Or a subgroup isomorphic to Z_2 x Z_2 (the Klein four-group)?");
					}
					else if (k == 12) {
						form.resultbox.value += notabel_twelve(prevQ, q);
					}
				}
				else if ((k == 12) && (q.indexOf('y') >= 0) && (prevQ.indexOf('cyclic') >= 0)) {
					form.resultbox.value = ("Your group is isomorphic to Z_12. It is also isomorphic to Z_3 x Z_4. It has four subgroups, isomorphic to Z_2, Z_3, Z_4 and Z_6.");
				}
				else if ((k == 8) && (q.indexOf('y') >= 0) && (prevQ.indexOf('Klein') >= 0)) {
					form.resultbox.value = ("Your group is isomorphic to the dihedral group of order 8. It contains eight subgroups, one of which is isomorphic to Z_4. It also contains two subgroups isomorphic to Z_2 x Z_2, and five subgroups isomorphic to Z_2.");
				}
				else if ((k == 8) && (prevQ.indexOf('Klein') >= 0)) {
					form.resultbox.value = ("Your group is isomorphic to the Quaternion group Q_8, the smallest of the Hamiltonian groups. It contains four subgroups, all of which are normal. Three are isomorphic to Z_4, and one is isomorphic to Z_2.");
				}
				else if ((k == 12) && (prevQ.indexOf('alternating') >= 0) && (q.indexOf('y') >= 0)) {
					form.resultbox.value = ("Your group is isomorphic to the alternating group A_4. It contains eight subgroups, one of which is normal, and isomorphic to Z_2 x Z_2. The other groups are non-normal; three are isomorphic to Z_2 and four are isomorphic to Z_3.");
				}
				else if ((k == 12) && ((prevQ.indexOf('alternating') >= 0) || (prevQ.indexOf('dihedral') >= 0))) {
					form.resultbox.value = notabel_twelve(prevQ, q);
				}
				else if ((k == 8) && ((prevQ.indexOf("fewer than five") >= 0) || (prevQ.indexOf("ten subgroups")))) {
					form.resultbox.value = eight_abelian(prevQ, q);
				}
				else if ((k == 12) && (prevQ.indexOf('cyclic') >= 0)) {
					form.resultbox.value = ("Your group is isomorphic to Z_2 x Z_6. It is also isomorphic to Z_3 x Z_2 x Z_2. It has eight subgroups, one isomorphic to Z_3, one isomorphic to Z_2 x Z_2, three isomorphic to Z_2 and three isomorphic to Z_6.");
				}
				else if ((prevQ.indexOf("abelian") >= 0) && (q.indexOf('y') >= 0) && (!(prevQ.indexOf('Klein') >= 0)) && (!(prevQ.indexOf('alternating') >= 0))) {
					form.resultbox.value = ("Your group is abelian. There are " + abel[k-1] + " such groups of order " + k + ". ");
					if (k == 12) {
						form.resultbox.value += ("Is your group cyclic? Alternately, does it have fewer than five subgroups, or no subgroups that are isomorphic to one another?");
					}
					if (k == 8) {
						form.resultbox.value = eight_abelian(prevQ, q);
					}
				}
			}
		}
	}
}	

function isprime(num) {
	var nummah = num;
	if ((nummah == 2) || (nummah == 3) || (nummah == 5) || (nummah == 7)) { return 1; }
	if (nummah <= 10) { return 0; }
	for (var fakzor = 2; fakzor < nummah; fakzor++) {
		if ((nummah % fakzor) == 0) { return 0; }
	}
	return 1;
}

function ispq(numbing) {
	//alert("la");
	var numb = numbing;
	if (numb <= 20) { return 0; }
	if ((numb == 21) || (numb == 22) || (numb == 26)) { return 1; }
	if (numb == 25) {
		return 2;
	}
	else if (numb <= 27) { return 0; }
	var kwat = 1;
	//alert("la2");
	for (var fakzt = 2; fakzt < numb; fakzt++) {
		kwat = fakzt;
		//alert("la" + kwat);
		if ((numb % fakzt) == 0) {
			if ((numb / fakzt) == fakzt) {
				return 2;
			}
			else if (isprime(numb / fakzt)) {
				return 1;
			}
			return 0;
		}
	}
	return 0;
}

function sixteen(unomas, dosdas) {
	return ("Things and stuff! ...uh, by which I mean, there are eight million different groups your group could be. Uh. I'm going to go to sleep. Ask me in the morning.");
}

function eighteen(yea1, yea2) {
	if ((yea1.indexOf("abelian") >= 0) && (yea2.indexOf('y') >= 0)) {
		return ("There are two such groups. Is your group cyclic? Alternately, does it contain any elements of order greater than 7?");
	}
	else if ((yea1.indexOf('cyclic') >= 0) && (yea2.indexOf('y') >= 0)) {
		return ("Your group is isomorphic to the cyclic group Z_18, which is also isomorphic to Z_2 x Z_9. It contains four proper subgroups, one isomorphic to Z_9, one isomorphic to Z_6, one isomorphic to Z_3 and one isomorphic to Z_2.");
	}
	else if ((yea1.indexOf('cyclic') >= 0)) {
		return ("Your group is isomorphic to the direct product of Z_3 and Z_6. It contains ten subgroups, one isomorphic to Z_2, four isomorphic to Z_3, four isomorphic to Z_6, and one isomorphic to Z_9.");
	}
	else if (yea1.indexOf("abelian") >= 0) {
		return ("There are three such groups. Is your group dihedral? Alternately, does it contain between thirteen and twenty subgroups? Or only one subgroup of order 3?");
	}
	else if ((yea1.indexOf("dihedral") >= 0) && (yea2.indexOf('y') >= 0)) {
		return ("Your group is the dihedral group of order 18, which is also isomorphic to the semidirect product of Z_2 and Z_9. It contains two normal subgroups, one isomorphic to Z_3 and one isomorphic to Z_9. It also contains twelve non-normal subgroups, nine isomorphic to Z_2 and three isomorphic to the dihedral group of order 6.");
	}
	else if (yea1.indexOf("dihedral") >= 0) {
		return ("Is your group a direct product? Alternately, does it contain fewer than fifteen subgroups?");
	}
	else if ((yea1.indexOf("direct product") >= 0) && (yea2.indexOf('y') >= 0)) {
		return ("Your group is the direct product S_3 x Z_3. It contains 12 subgroups.");
	}
	else {
		return ("Your group is isomorphic to the semi-direct product of Z_2 and Z_3 x Z_3. It has 26 subgroups.");
	}
}

function fakdurA(kumquat) {
	//returns the smallest factor of "kumquat"
	for (var fakm = 2; fakm < kumquat; fakm++) {
		if ((kumquat % fakm) == 0) {
			return fakm;
		}
	}
	return 0;
}

function twenni(omgz, hatuz) {
	if ((omgz.indexOf("abelian") >= 0) && (hatuz.indexOf('y') >= 0)) {
		return ("There are two such groups. Is your group cyclic? Alternately, does it contain fewer than six proper subgroups? Or no two subgroups that are the same order?");
	}
	else if (omgz.indexOf("abelian") >= 0) {
		return ("There are three such groups. Is your group dihedral?");
	}
	else if ((omgz.indexOf("six proper") >= 0) && (hatuz.indexOf('y') >= 0)) {
		return ("Your group is isomorphic to the group Z_20, which contains four proper subgroups, all of which are normal. One subgroup is isomorphic to Z_10, one Z_5, one Z_4, and one Z_2.");
	}
	else if (omgz.indexOf("six proper") >= 0) {
		return ("Your group is isomorphic to the group Z_2 x Z_10. It contains eight proper subgroups, all of which are normal. Three of those are isomorphic to Z_10, and three, isomorphic to Z_2. One is isomorphic to Z_5.");
	}
	else if ((omgz.indexOf("dihedral") >= 0) && (hatuz.indexOf('y') >= 0)) {
		return ("Your group is the dihedral group of order 20.");
	}
	else if (omgz.indexOf("dihedral") >= 0) {
		return ("Your group might be the Frobenius group of order 20, or the semidirect product of Z_5 and Z_4.");
	}
}

function notabel_twelve(ajayz, blohjobz) {
	if (ajayz.indexOf('alternating') >= 0) {
		//not A_4. Either dihedral group of order 6, or semi-direct product of Z_3 and Z_4.
		return ("Is your group a direct product? Alternately, is it dihedral, or contain more than seven proper subgroups?");
	}
	else if (ajayz.indexOf('dihedral') >= 0) {
		if (blohjobz.indexOf('y') >= 0) {
			return ("Your group is isomorphic to the dihedral group of order 12, which is also isomorphic to the direct product D_6 x Z_2. It contains fourteen subgroups, one isomorphic to Z_6, two isomorphic to D_6, three isomorphic to Z_2 x Z_2 (the Klein Four-Group, or Vierergruppe), one isomorphic to Z_3, and seven isomorphic to Z_2."); 
		}
		else {
			return ("Your group is the semi-direct product of Z_3 and Z_4. It contains six subgroups: one isomorphic to Z_2, one Z_3, three Z_4, and one Z_6.");
		}
	}
	else {
		return ("Are the proper subgroups of your group all order 4 or smaller? Alternately, is it an alternating group? Or is there exactly one subgroup of order 4, and this is the only normal subgroup in the group?");
	}
}

function sqrt(meh) {
	for (var twiz = 2; twiz < meh; twiz++) {
		if ((twiz * twiz) == meh) { return twiz; }
	}
	return 0;
}

function eight_abelian(thingA, thingB) {
	if (thingA.indexOf("abelian") >= 0) {
		return ("Is your group cyclic? Alternately, does it contain fewer than five subgroups?");
	}
	else if ((thingB.indexOf('y') >= 0) && (thingA.indexOf("five") >= 0)) {
		//answering yes to the first question
		return ("Your group is isomorphic to the group Z_8. It has two subgroups, isomorphic to Z_2 and Z_4.");
	}
	else if ((thingB.indexOf('y') >= 0) && (thingA.indexOf("ten subg") >= 0)) {
		//answering yes to the second question
		//Contains fewer than ten subgroups...
		return ("Your group is isomorphic to the direct product of Z_2 and Z_4 (that is, Z_2 x Z_4). It contains six subgroups, one isomorphic to Z_2 x Z_2, two isomorphic to Z_4, and three isomorphic to Z_2.");
	}
	else if (thingA.indexOf("ten subg") >= 0) {
		//answering no to the second question (ie, contains more than ten subgroups)
		return ("Your group is isomorphic to Z_2 x Z_2 x Z_2. It contains fourteen subgroups, seven of which are isomorphic to Z_2, and seven of which are isomorphic to Z_2 x Z_2.");
	}
	else {
		return ("Does your group contain fewer than ten subgroups? Alternately, does it contain a subgroup isomorphic to Z_4?");
	}
}
