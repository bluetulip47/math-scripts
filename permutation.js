function permute(form) {
	var y = form.inputboxy.value;
	//var n = parseInt(form.inputboxn.value);
	//alert(y + " !");

	form.resultbox.value = (y + "\^2 = ");

	y_pr = y;
	y = y.replace(/\)/g,'');
	var cycles = y.split(/\(/g);
	
	//calculate and print the square
	square_full(cycles, form);
	
	//calculate and print the cube
	form.resultbox.value += ("\n" + y_pr + "\^3 = ");
	for(var weg = 1; weg < cycles.length; weg++) {
		//alert(cycles[weg]);
		var lueg = cycles[weg].split(/\s/g);
		var luegy = new Array();
		luegy = cube(lueg);
		//luegy = lueg;
		if ((luegy.length % 3) != 0) {
			form.resultbox.value += "(";
			var frat = true;
			for (var kk in luegy) {
				if (frat == false) {
					form.resultbox.value += (" " + luegy[kk]);
				}
				else {
					form.resultbox.value += (luegy[kk]);
					frat = false;
				}
			}
			form.resultbox.value += ")";
		}
		else if (luegy.length >= 4) {
			form.resultbox.value += "(";
			for (var ch = 0; ch < (luegy.length/3); ch++) {
				if (ch >= 1) {
					form.resultbox.value += (" " + luegy[ch]);
				}
				else {
					form.resultbox.value += (luegy[ch]);
				}
			}
			form.resultbox.value += ")(";
			for (var shch = (luegy.length/3); shch < (2*(luegy.length/3)); shch++) {
				if (shch > (luegy.length/3)) {
					form.resultbox.value += (" " + luegy[shch]);
				}
				else {
					form.resultbox.value += (luegy[shch]);
				}
			}
			form.resultbox.value += ")(";
			for (var ts = (2*(luegy.length/3)); ts < luegy.length; ts++) {
				if (ts > (2*(luegy.length/3))) {
					form.resultbox.value += (" " + luegy[ts]);
				}
				else {
					form.resultbox.value += (luegy[ts]);
				}
			}
			form.resultbox.value += ")";
		}
	}
	
	//remaining powers?!!
	//alert ("yo cheese");
	for(var pow = 4; pow < order(cycles) ; pow++) {
		//alert ("yo mo chez");
		form.resultbox.value += ("\n" + y_pr + "\^" + pow + " = ");
		if (pow == 4) {	
			for(var kuu = 1; kuu < cycles.length; kuu++) {
				var chut = cycles[kuu].split(/\s/g);
				quad(chut, form);
			}
		}
		else if (pow == 5) {
			for(var meta = 1; meta < cycles.length; meta++) {
				var mutska = cycles[meta].split(/\s/g);
				pent(mutska, form, 5);
			}
		}
		else if (pow == 7) {
			for(var nix = 1; nix < cycles.length; nix++) {
				var nixka = cycles[nix].split(/\s/g);
				pent(nixka,form,7);
			}
		}
		else if (isPrime(pow)) {
			for (var rix = 1; rix < cycles.length; rix++) {
				var rixka = cycles[rix].split(/\s/g);
				pent(rixka,form,pow);
			}
		}
		else if ((Math.floor(pow/2) == (pow/2)) && (isPrime(pow/2))) {
			for (var nin = 1; nin < cycles.length; nin++) {
				var ninesh = cycles[nin].split(/\s/g);
				var tugot = new Array();
				tugot = square(ninesh);
				if (tugot.length%2 == 1) {
					pent(tugot,form,pow/2);
				}
				else if ((tugot.length != 2) && (tugot.length != pow)) {
					var strange = new Array();
					var charm = new Array();
					for(yy=0;yy<(tugot.length/2);yy++) {
						strange[yy] = tugot[yy];
						charm[yy] = tugot[yy+(tugot.length/2)];
					}
					pent(strange,form,pow/2);
					pent(charm,form,pow/2);
				}
			}
		}
		else if (pow == 8) {
			for (var nut = 1; nut < cycles.length; nut++) {
				var nutesh = cycles[nut].split(/\s/g);
				var tugon = new Array();
				tugon = square(nutesh);
				if (tugon.length%2 == 1) {
					quad(tugon,form);
				}
				else if ((tugon.length != 2) && (tugon.length != 4)&& (tugon.length != 8)) {
					var up = new Array();
					var down = new Array();
					for(zz=0;zz<(tugon.length/2);zz++) {
						up[zz] = tugon[zz];
						down[zz] = tugon[zz+(tugon.length/2)];
					}
					quad(up,form);
					quad(down,form);
				}
			}
		}
		else if (pow == 9) {
			for (var zikh = 1; zikh < cycles.length; zikh++) {
				var zookha = cycles[zikh].split(/\s/g);
				if ((zookha.length == 9) || (zookha.length == 3)) {
					continue;
				}
				chook = matsu(zookha);
				if ((chook.length % 9) == 0) {
					var kashe = new Array();
					var tashe = new Array();
					var pashe = new Array();
					var kasho = new Array();
					var tasho = new Array();
					var pasho = new Array();
					var kashj = new Array();
					var tashj = new Array();
					var pashj = new Array();
					for (q=0;q<(chook.length/9);q++) {
						kashe[q]=chook[q];
						tashe[q]=chook[q+(chook.length/9)];
						pashe[q]=chook[q+(2*(chook.length/9))];
						kasho[q]=chook[q+(chook.length/3)];
						tasho[q]=chook[q+(4*(chook.length/9))];
						pasho[q]=chook[q+(5*(chook.length/9))];
						kashj[q]=chook[q+(2*(chook.length/3))];
						tashj[q]=chook[q+(7*(chook.length/9))];
						pashj[q]=chook[q+(8*(chook.length/9))];
					}
					printcycle(kashe,form);
					printcycle(tashe,form);
					printcycle(pashe,form);
					printcycle(kasho,form);
					printcycle(tasho,form);
					printcycle(pasho,form);
					printcycle(kashj,form);
					printcycle(tashj,form);
					printcycle(pashj,form);
				}
				else if ((chook.length %3) == 0) {
					var kashi = new Array();
					var tashi = new Array();
					var pashi = new Array();
					for (q=0;q<(chook.length/3);q++) {
						kashi[q]=chook[q];
						tashi[q]=chook[q+(chook.length/3)];
						pashi[q]=chook[q+(2*(chook.length/3))];
					}
					printcycle(kashi,form);
					printcycle(tashi,form);
					printcycle(pashi,form);
				}
				else {
					printcycle(chook,form);
				}
			}
		}
		else if (pow == 6) {
			for (var nosh = 1; nosh < cycles.length; nosh++) {
				var noshka = cycles[nosh].split(/\s/g);
				if (noshka.length == 6) {
					continue;
				}
				blik = tapsu(noshka);
				if (((blik.length % 2) == 0) && ((blik.length % 3) == 0)) {
				//cycle length is divisible by 6
					for (var ich = 0; ich < blik.length; ich++) {
						if ((ich%(blik.length/6)) == 0) {
							form.resultbox.value += ("(" + blik[ich]);
						}
						else {
							form.resultbox.value += (" " + blik[ich]);
						}
						if ((ich % (blik.length/6)) == ((blik.length/6)-1)) {
							form.resultbox.value += ")";
						}
					}
				}
				else if (((blik.length %3) == 0) && (blik.length >= 4)) {
				//cycle length total is 4+, and is divisible by 3 (but not 6).
					for (var ii = 0; ii < blik.length; ii++) {
						if ((ii % (blik.length/3)) == 0) {
							form.resultbox.value += ("(" + blik[ii]);
						} else {
							form.resultbox.value += (" " + blik[ii]);
						}
						if ((ii % (blik.length/3)) == ((blik.length/3)-1)) {
							form.resultbox.value += ")";
						}
					}
				}
				else if (((blik.length %2) == 0) && (blik.length >= 4)) {
				//cycle length total is 4+, and is not divisible by 3.
					for (var iu = 0; iu < blik.length; iu++) {
						if ((iu % (blik.length/2)) == 0) {
							form.resultbox.value += ("(" + blik[iu]);
						} else {
							form.resultbox.value += (" " + blik[iu]);
						}
						if ((iu % (blik.length/2)) == ((blik.length/2)-1)) {
							form.resultbox.value += ")";
						}
					}
				}
				else if (blik.length >= 4) {
					form.resultbox.value += "(";
					var weet = false;
					for (var epl in blik) {
						if (weet == false) {
							form.resultbox.value += (blik[epl]);
							weet = true;
						} else {
							form.resultbox.value += (" " + blik[epl]);
						}
					}
					form.resultbox.value += ")";
				}
			}
		}
		else if (pow == 12) {
			for (var chix = 1; chix < cycles.length; chix++) {
				var chikkoi = cycles[chix].split(/\s/g);
				var chikkent = new Array();
				chikkent = cube(chikkoi);
				if ((chikkent.length%3) != 0) {
					quad(chikkent,form);
				}
				else if ((chikkent.length != 2) && (chikkent.length != 3) && (chikkent.length != 4)&& (chikkent.length != 6)&& (chikkent.length != 12)) {
					var left = new Array();
					var right = new Array();
					var princess = new Array();
					for(sp=0;sp<(chikkent.length/3);sp++) {
						left[sp] = chikkent[sp];
						right[sp] = chikkent[sp+(chikkent.length/3)];
						princess[sp] = chikkent[sp+(2*(chikkent.length/3))];
					}
					quad(left,form);
					quad(right,form);
					quad(princess,form);
				}
			}
		}
		else if (Math.floor(pow/3) == (pow/3)) {
			var play = toString(pow/3);
			//var id_pattern = new RegExp(/\^[0-9]+/+ /\s*=\s*[()0-9\s]+\n/);
			//var id_pattern = new RegExp();
			var oldcycle = form.resultbox.value.match(/\^[0-9]+\s*=\s*[()0-9\s]+\n/g);
			//form.resultbox.value += (" " + oldcycle[(pow/3)-2]);
			var preddierd = oldcycle[(pow/3)-2].replace(/\n/,'');
			preddierd = preddierd.replace(/\^[0-9]+\s*=\s*/,'');
			//form.resultbox.value += (" !!! ");
			var koosh = preddierd.replace(/\)/g,'');
			var kycles = koosh.split(/\(/g);
			for (var ht = 1; ht < kycles.length; ht++) {
				var cherm = kycles[ht].split(/\s/g);
				var chermy = new Array();
				chermy = cube(cherm);
				//alert(chermy);
				if ((chermy.length %3) != 0) {
					printcycle(chermy,form);
				}
				else if (chermy.length >= 4) {
					var feminine = new Array();
					var masculine = new Array();
					var neuter = new Array();
					for (var franc = 0; franc < (chermy.length/3); franc++) {
						feminine[franc] = chermy[franc];
						masculine[franc] = chermy[franc+(chermy.length/3)];
						neuter[franc] = chermy[franc+(2*(chermy.length/3))];
					}
					printcycle(feminine,form);
					printcycle(masculine,form);
					printcycle(neuter,form);
				}
			}
		}
		else if (Math.floor(pow/2) == (pow/2)) {
			var olzykle = form.resultbox.value.match(/\^[0-9]+\s*=\s*[()0-9\s]+\n/g);
			if (olzykle[(pow/2)-2].match((pow/2).tostring) == -1) {
				form.resultbox.value += "ALARMALARM!";
			}
			var ousui = olzykle[(pow/2)-2].replace(/\n/,'');
			ousui = ousui.replace(/\^[0-9]+\s*=\s*/,'');
			var shoosh = ousui.replace(/\)/g,'');
			var styles = shoosh.split(/\(/g);
			for (var hoo = 1; hoo < styles.length; hoo++) {
				var nhim = styles[hoo].split(/\s/g);
				var nhimbl = new Array();
				if ((pow)%(nhim.length) == 0) {
					continue;
				}
				nhimbl = square(nhim);
				//alert(nhimbl);
				//form.resultbox.value += "*";
				if ((nhimbl.length%2) != 0) {
					printcycle(nhimbl,form);
				}
				else if (nhimbl.length >= 3) {
					var yin = new Array();
					var yang = new Array();
					for (var sea = 0; sea < (nhimbl.length/2); sea++) {
						yin[sea] = nhimbl[sea];
						yang[sea] = nhimbl[sea+(nhimbl.length/2)];
					}
					printcycle(yin,form);
					printcycle(yang,form);
				}
			}
		}
		else {
			var ent = 0;
			for (var div = 2; div < pow; div++) {
				if (Math.floor(pow/div) == (pow/div)) {
					ent = div;
					break;
				}
			}
			var azykle = form.resultbox.value.match(/\^[0-9]+\s*=\s*[()0-9\s]+\n/g);
			if (azykle[(pow/ent)-2].match((pow/ent).toString) == -1) {
				form.resultbox.value += "ALARMALARM!";
			}
			var azui = azykle[(pow/ent)-2].replace(/\n/,'');
			azui = azui.replace(/\^[0-9]+\s*=\s*/,'');
			var astute = azui.replace(/\)/g,'');
			var akin = astute.split(/\(/g);
			//alert(akin);
			for (var once = 1; once < akin.length; once++) {
				var seri = akin[once].split(/\s/g);
				if ((pow)%(seri.length) == 0) {
					continue;
				}
				pent(seri,form,ent);
			}
		}
	}
}

function printcycle(cycle, furmk) {
	var tulen = cycle.length;
	furmk.resultbox.value += "(";
	for (var ret = 0; ret < tulen; ret++) {
		if (ret == 0) {
			furmk.resultbox.value += (cycle[ret]);
		}
		else {
			furmk.resultbox.value += (" " + cycle[ret]);
		}
	}
	furmk.resultbox.value += ")";
}

function pent(moltres, formc, prime) {
	var win = moltres;
	var winly = new Array();
	var cyltn = moltres.length;
	winly[0] = moltres[0];
	if ((cyltn % prime) != 0) {
		for(var qui = 0; qui < cyltn; qui++) {
			winly[qui] = moltres[(prime*qui)%cyltn];
			if (qui == 0) {
				formc.resultbox.value += ("(" + winly[qui]);
			}
			else {
				formc.resultbox.value += (" " + winly[qui]);
			}
		}
		formc.resultbox.value += ")";
	}
	else if (cyltn >= (prime+1)) {
		var ittcher = 0;
		for(var quic = 0; quic < cyltn; quic++) {
			winly[quic] = moltres[((prime*quic)%cyltn)+ittcher];
			if ((quic % (cyltn/prime)) == 0) {
				formc.resultbox.value += "(";
			} else {
				formc.resultbox.value += (" ");
			}
			formc.resultbox.value += (winly[quic]);
			if ((quic % (cyltn/prime)) == ((cyltn/prime)-1)) {
				formc.resultbox.value += ")";
				ittcher++;
			}
		}
	}
}

function tapsu (doduo) {
	var cheek = doduo;
	var cheeky = new Array();
	cheeky = square(cheek);
	var tapt = new Array();
	if ((cheeky.length == 3) || (cheeky.length == 6)) {
		tapt = [""];
	}
	else if ((cheeky.length % 2) == 1) {
		tapt = cube(cheeky);
		//alert(cheeky + " : " + tapt);
	}
	else {
		var chatty = new Array();
		var catty = new Array();
		for (var fox = 0; fox < (cheeky.length/2); fox++) {
			chatty[fox] = cheeky[fox];
			catty[fox] = cheeky[fox+(cheeky.length/2)];
		}
		tapt = cube(chatty).concat(cube(catty));
	}
	return tapt;
}

function matsu (dotrio) {
	var neck = dotrio;
	var necking = new Array();
	necking = cube(neck);
	var makt = new Array();
	if ((necking.length % 3) != 0) {
		makt = cube(necking);
	}
	else {
		var winken = new Array();
		var blinken = new Array();
		var nod = new Array();
		for (var sailings = 0; sailings < (necking.length/3); sailings++) {
			winken[sailings] = necking[sailings];
			blinken[sailings] = necking[sailings+(necking.length/3)];
			nod[sailings] = necking[sailings+(2*(necking.length/3))];
		}
		makt = cube(winken).concat(cube(blinken));
		makt = makt.concat(cube(nod));
	}
	return makt;
}

function quad(articuno, formb) {
	//for(var mouse = 1; mouse < articuno.length; mouse++) {
		//var jiz = articuno[mouse].split(/\s/g);
		var jiz = articuno;
		var jizly = new Array();
		jizly = square(jiz);
		if ((jizly.length % 2) == 1) {
			jizly = square(jizly);
		}
		else {
			var catigon = new Array();
			var dogigon = new Array();
			for (var mba = 0; mba < ((jizly.length)/2); mba++) {
				catigon[mba] = jizly[mba];
				dogigon[mba] = jizly[mba+((jizly.length)/2)];
			}
			jizly = square(catigon).concat(square(dogigon));
		}
		if ((jizly.length != 2) && (jizly.length != 4)) {
			formb.resultbox.value += "(";
		}
		if ((jizly.length % 2) == 1) {
			var kiks = true;
			for (var sp in jizly) {
				if (kiks == true) {
					kiks = false;
				}
				else {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[sp]);
			}
		}
		else if ((jizly.length >= 5) && ((jizly.length % 4) != 0)) {
			for (var m = 0; m < ((jizly.length)/2); m++) {
				if (m > 0) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[m]);
			}
			formb.resultbox.value += ")(";
			for (var n = ((jizly.length)/2); n < jizly.length; n++) {
				if (n > ((jizly.length)/2)) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[n]);
			}
		}
		else if ((jizly.length >= 5) && ((jizly.length % 4) == 0)) {
			for (var ma = 0; ma < ((jizly.length)/4); ma++) {
				if (ma > 0) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[ma]);
			}
			formb.resultbox.value += ")(";
			for (var n2 = ((jizly.length)/4); n2 < ((jizly.length)/2); n2++) {
				if (n2 > ((jizly.length)/4)) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[n2]);
			}
			formb.resultbox.value += ")(";
			for (var n3 = ((jizly.length)/2); n3 < 3*((jizly.length)/4); n3++) {
				if (n3 > ((jizly.length)/2)) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[n3]);
			}
			formb.resultbox.value += ")(";
			for (var n4 = 3*((jizly.length)/4); n4 < jizly.length; n4++) {
				if (n4 > 3*((jizly.length)/4)) {
					formb.resultbox.value += (" ");
				}
				formb.resultbox.value += (jizly[n4]);
			}
		}
		if ((jizly.length != 2) && (jizly.length != 4)) {
			formb.resultbox.value += ")";
		}
	//}
}

function square_full(zapdoz, forma) {
	//alert(zapdoz.length + "bu23");
	for(var rat = 1; rat < zapdoz.length; rat++) {
		//alert(zapdoz[rat]);
		var ket = zapdoz[rat].split(/\s/g);
		var ketly = new Array();
		ketly = square(ket);
		//alert(ketly[0] + "ket1");
		if (ketly.length >= 3) {
			forma.resultbox.value += "(";
		}
		if ((ketly.length % 2) == 1) {
			var whee = true;
			for (var ek in ketly) {
				if (whee == true) {
					forma.resultbox.value += (ketly[ek]);
					whee = false;
				}
				else {
					forma.resultbox.value += (" " + ketly[ek]);
				}
			}
			forma.resultbox.value += (")");
		}
		else if (ketly.length >= 3) {
			for (var u = 0; u < ((ketly.length)/2); u++) {
				if (u >= 1) {
					forma.resultbox.value += (" " + ketly[u]);
				}
				else {
					forma.resultbox.value += (ketly[u]);
				}
			}
			forma.resultbox.value += ")(";
			for (var v = ((ketly.length)/2); v < ketly.length; v++) {
				if (v > (ketly.length)/2) {
					forma.resultbox.value += (" " + ketly[v]);
				}
				else {
					forma.resultbox.value += (ketly[v]);
				}
			}
			forma.resultbox.value += (")");
		}
	}
}

function order(cycles_n) {
	var lcm = 1;
	//alert (lcm + "*~*");
	for(var kch = 1; kch < cycles_n.length; kch++) {
		var took = new Array(); 
		//alert (lcm + "!*!");
		took = cycles_n[kch].split(/\s/g);
		//alert (took.length + "took");
		//alert (gcd(lcm,took.length) + "gcd");
		if (gcd(lcm,took.length) == 1) {
			lcm *= took.length;
			//alert (lcm + "ryw");
		}
		else {
			lcm /= gcd(lcm, took.length);
			lcm *= took.length;
		}
	}
	//alert (lcm + "***");
	return lcm;
}

function gcd(var1, var2) {
	//alert ("gcd" + var1 + ", " + var2);
	return euclid(var1, var2);
}

function cube(passd) {
	var cylln = passd.length;
	//alert(passd[0] + " :D " + cylln);
	var cubt = new Array();
	cubt[0] = passd[0];
	for (var r = 1; r < cylln; r++) {
		if ((3*r) < cylln) {
			cubt[r] = passd[3*r];
		}
		else if (((r*3) < (2*cylln)) && ((cylln % 3) != 0)) {
			cubt[r] = passd[(3*r)-cylln];
		}
		else if ((r*3) < (2*cylln)) {
			cubt[r] = passd[(3*r)-cylln+1];
		}
		else if ((cylln % 3) == 0) {
			cubt[r] = passd[(3*r)-(2*cylln)+2];
		}
		else {
			cubt[r] = passd[(3*r)-(2*cylln)];
		}
	}
	return cubt;
}

function square(passt) {
	var cyc_len = passt.length;
	var sqart = new Array();
	//alert(passt[0] + " :D " + cyc_len);
	sqart[0] = passt[0];
	for (var k = 1; k < cyc_len; k++) {
		if ((2*k) < cyc_len) {
			sqart[k] = passt[2*k];
		}
		else if ((cyc_len % 2) == 1) {
			sqart[k] = passt[(2*k)-cyc_len];
		}
		else {
			sqart[k] = passt[(2*k)-cyc_len+1];
		}
	}
	return sqart;
}

//Design: tote around in form of string with number of cycles, extract and act on
//one cycle at a time. To calculate first order, run through and "act on" each cycle
//twice, and then spit out the result??

//How to square a permutation element:
//if 2-cycle -- delete
//if 3-cycle -- reverse
//if 4-cycle -- split into two 2-cycles, consisting of the opposing pairs.
//if 5-cycle -- still a 5-cycle... (abcde) => (acebd)
//if 6-cycle -- two 3-cycles, ... (abcdef) => (ace)(bdf)
//if 7-cycle -- (abcdefg) => (acegbdf)
//usw.

function euclid(yo1, yo2) {
	var numOne = yo1;
	var numTwo = yo2;
	var holdEm = 0;
	var newb = 0;
	var elder = 0;

	//alert("You entered " + numOne + " and " + numTwo);

	if ((numOne == 0) || (numTwo == 0)) {
		alert("You can't choose zero, you perv!!");
		return;
	}
	
	if (isNaN(numOne) || isNaN(numTwo)) {
		alert("Please try again: only numbers.");
		return;
	}

	//form.resultbox.value = "";

	if (numOne > numTwo) {
		newb = takestep(numOne, numTwo);
		elder = numTwo;
	//	form.resultbox.value = numOne + " = " + Math.floor(numOne / numTwo) + "(";
	} else {
		newb = takestep(numTwo, numOne);
		elder = numOne;
	//	form.resultbox.value = numTwo + " = " + Math.floor(numTwo / numOne) + "(";
	}

	//alert("The result of one step is " + elder + " and " + newb + ".");
	//form.resultbox.value += (elder + ") + " + newb + "\n");
	
	while (newb != 0) {
		holdEm = newb;
		newb = takestep(elder, newb);
		//if (newb != 0) {
		//	form.resultbox.value += (elder + " = " + Math.floor(elder / holdEm) + "(" + holdEm + ") + " + newb + "\n");
		//}
		elder = holdEm;
		//alert("The result of the next step is " + elder + " and " + newb + ".");
	}
	//alert("The gcd of " + numOne + " and " + numTwo + " is " + elder);
	//form.resultbox.value += ("\nThe gcd of " + numOne + " and " + numTwo + " is " + elder + ".");
	return elder;
}

function isPrime(possible) {
	if (Math.floor(possible) != possible) {
		return false;
	}
	for (var i = 2; i <= Math.sqrt(possible); i++) {
		if (Math.floor(possible / i) == (possible / i)) {
			return false;
		}
	}
	return true;
}

function takestep(uno, dos) {
	var q = Math.floor(uno / dos);
	var r = (uno - (dos*q));
	//alert(r);
	//var line = uno + " = " + q + "(" + dos + ") + " + r + "\n";
	//form.resultbox.value += uno.toString();
	return r;
}
