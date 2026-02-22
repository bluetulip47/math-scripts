function multrq(egvo) {
	var a_full = egvo.inputboxp.value;
	var b_full = egvo.inputboxq.value;
	egvo.resultbox.value = "";
	var a_terms = new Array();
	var b_terms = new Array();
	var b_terms_copy = new Array();
	var mult_terms = new Array();
	var a_num;
	var b_num;
	var a_val;
	var b_val;
	
	//alert (a_full + " " + b_full);
	
	if ((!(a_full.match(/[+]/))) && (!(b_full.match(/[+]/)))) {
		//both are only single terms
		egvo.resultbox.value = ("The product of " + a_full + " and " + b_full + " is ");
		a_num = a_full.replace(/[a-z]/,"");
		b_num = b_full.replace(/[a-z]/,"");
		a_val = a_full.replace(/[\.0-9]/,"");
		b_val = b_full.replace(/[\.0-9]/,"");
		if ((!(a_full.match(/[ijk]/))) && (!(b_full.match(/[ijk]/)))) {
			egvo.resultbox.value += (a_num*b_num);
			return;
		}
		else if (!(a_full.match(/[ijk]/))) {
			egvo.resultbox.value += (a_num*b_num);
			egvo.resultbox.value += b_val;
			return;
		}
		else if (!(b_full.match(/[ijk]/))) {
			egvo.resultbox.value += (a_num*b_num);
			egvo.resultbox.value += a_val;
			return;
		}
		a_num = a_num*b_num;
		a_val = unitmult(a_val, b_val);
		if (a_val.match(/-/)) {
			a_num *= -1;
			a_val = a_val.replace(/-/,"");
		}
		if (a_val.match(/[1-9]/)) {
			egvo.resultbox.value += a_num;
		}
		else {
			egvo.resultbox.value += (a_num + a_val);
		}
	}
	else if (!(a_full.match(/[+]/))) {
		//the first one is a single term, the second is not
		b_terms = b_full.split(/[+]/g);
		b_terms = array_sort(b_terms);
		a_num = a_full.replace(/[a-z]/,"");
		a_val = a_full.replace(/[^a-z]/,"");
		egvo.resultbox.value = ("The product of " + a_full + " and " + b_full + " is ");
		if (!(a_full.match(/[ijk]/))) {
			for (var whe = 0; whe < 4; whe++) {
				mult_terms[whe] = (b_terms[whe] * a_num);
			}
		}
		else if (a_full.match(/i/)) {
			mult_terms[0] = (b_terms[1] * -1 * a_num);
			mult_terms[1] = (b_terms[0] * a_num);
			mult_terms[2] = (b_terms[3] * -1 * a_num);
			mult_terms[3] = (b_terms[2] * a_num);
		}
		else if (a_full.match(/j/)) {
			mult_terms[0] = (b_terms[2] * -1 * a_num);
			mult_terms[1] = (b_terms[3] * a_num);
			mult_terms[2] = (b_terms[0] * a_num);
			mult_terms[3] = (b_terms[1] * -1 * a_num);
		}
		else if (a_full.match(/k/)) {
			mult_terms[0] = (b_terms[3] * -1 * a_num);
			mult_terms[1] = (b_terms[2] * -1 * a_num);
			mult_terms[2] = (b_terms[1] * a_num);
			mult_terms[3] = (b_terms[0] * a_num);
		}
		//alert(mult_terms);
		printarray(mult_terms, egvo);
	}
	else if (!(b_full.match(/[+]/))) {
		//the second one is a single term, the first is not
		a_terms = a_full.split(/[+]/g);
		a_terms = array_sort(a_terms);
		b_num = b_full.replace(/[a-z]/,"");
		b_val = b_full.replace(/[^a-z]/,"");
		egvo.resultbox.value = ("The product of " + a_full + " and " + b_full + " is ");
		if (!(b_full.match(/[ijk]/))) {
			for (var wuz = 0; wuz < 4; wuz++) {
				mult_terms[wuz] = (a_terms[wuz] * b_num);
			}	
		}
		else if (b_full.match(/i/)) {
			mult_terms[0] = (a_terms[1] * b_num * -1);
			mult_terms[1] = (a_terms[0] * b_num);
			mult_terms[2] = (a_terms[3] * b_num);
			mult_terms[3] = (a_terms[2] * b_num * -1);
		}
		else if (b_full.match(/j/)) {
			mult_terms[0] = (a_terms[2] * b_num * -1);
			mult_terms[1] = (a_terms[3] * b_num * -1);
			mult_terms[2] = (a_terms[0] * b_num);
			mult_terms[3] = (a_terms[1] * b_num);
		}
		else if (b_full.match(/k/)) {
			mult_terms[0] = (a_terms[3] * b_num * -1);
			mult_terms[1] = (a_terms[2] * b_num);
			mult_terms[2] = (a_terms[1] * b_num * -1);
			mult_terms[3] = (a_terms[0] * b_num);
		}
		printarray(mult_terms, egvo);
	}
	else {
		//both have multiple terms
		a_terms = a_full.split(/[+]/g);
		b_terms = b_full.split(/[+]/g);
		a_terms = array_sort(a_terms);
		b_terms = array_sort(b_terms);
		b_terms_copy = b_terms.slice();
		for (var yq = 0; yq < 4; yq++) {
			mult_terms[yq] = (b_terms[yq] * a_terms[0]);
		}
		b_terms = mult_i(b_terms);
		for (var zq = 0; zq < 4; zq++) {
			mult_terms[zq] += (b_terms[zq] * a_terms[1]);
		}
		b_terms = mult_j(b_terms_copy);
		for (var aq = 0; aq < 4; aq++) {
			mult_terms[aq] += (b_terms[aq] * a_terms[2]);
		}
		b_terms = mult_k(b_terms_copy);
		for (var kn = 0; kn < 4; kn++) {
			mult_terms[kn] += (b_terms[kn] * a_terms[3]);
		}
		egvo.resultbox.value = ("The product of " + a_full + " and " + b_full + " is ");
		printarray(mult_terms, egvo);
	}
}

function mult_j(niuk) {
	// multiplies j * array passed
	var boou = new Array();
	boou[0] = (niuk[2] * -1);
	boou[1] = niuk[3]; //j * sk = si
	boou[2] = niuk[0];
	boou[3] = (niuk[1] * -1); //j * ri = -rk
	return boou;
}

function mult_k(renk) {
	// multiplies k * array passed (non-commutative, remember!)
	var boui = new Array();
	boui[0] = (renk[3] * -1);
	boui[1] = (renk[2] * -1); //k * qj = -qi
	boui[2] = renk[1]; //k * qi = qj
	boui[3] = renk[0];
	return boui;
}

function mult_i(arraq) {
	// multiplies i * array passed (non-commutative, remember!)
	var arran = new Array();
	arran[0] = (arraq[1] * -1);
	arran[1] = arraq[0];
	arran[2] = (arraq[3] * -1); //i * qk = -qj
	arran[3] = arraq[2]; //i * qj = qk
	return arran;
}

function quarters(form) {
	var p_full = form.inputboxp.value;
	var q_full = form.inputboxq.value;
	form.resultbox.value = "";
	var p_terms = new Array();
	var q_terms = new Array();
	var q_terms_copy = new Array();
	var add_terms = new Array();
	
	//form.resultbox.value = (p_full + " and " + q_full);

	if (q_full.match(/[+]/) && p_full.match(/[+]/)) {
		//if both quaternions have at least two terms
		p_terms = p_full.split(/[+]/g);
		q_terms = q_full.split(/[+]/g);
		p_terms = array_sort(p_terms);
		q_terms = array_sort(q_terms);
		for (var kr = 0; kr < 4; kr++) {
			add_terms[kr] = p_terms[kr] + q_terms[kr];
		}
		form.resultbox.value = ("The sum of " + p_full + " and " + q_full + " is ");
		printarray(add_terms, form);
		//alert("two biguns");
	}
	else if ((!q_full.match(/[+]/)) && (p_full.match(/[+]/))) {
		//q has one term, p has several
		p_terms[0] = q_full;
		q_terms = p_full.split(/[+]/);
		q_terms = array_sort(q_terms);
		q_terms_copy = q_terms.slice();
		add_terms = add_one(p_terms[0], q_terms);
		//alert(add_terms);
		form.resultbox.value = ("The sum of " + p_terms[0]);
		form.resultbox.value += " and ";
		printarray(q_terms_copy, form);
		form.resultbox.value += " is ";
		printarray(add_terms, form);
	}
	else if ((!p_full.match(/[+]/)) && (q_full.match(/[+]/))) {
		//p has one term, q has several
		p_terms[0] = p_full;
		q_terms = q_full.split(/[+]/);
		q_terms = array_sort(q_terms);
		q_terms_copy = q_terms.slice();
		add_terms = add_one(p_terms[0], q_terms);
		//alert(add_terms);
		form.resultbox.value = ("The sum of " + p_terms[0]);
		form.resultbox.value += " and ";
		printarray(q_terms_copy, form);
		form.resultbox.value += " is ";
		printarray(add_terms, form);
	}
	else {
		//p and q both only have one term
		form.resultbox.value = ("The sum of " + p_full + " and " + q_full + " is ");
		form.resultbox.value += (mono_addn(p_full, q_full));
	}
}

function printarray(arrai, formk) {
	if (arrai[0]!=0) {
		formk.resultbox.value += arrai[0];
	}
	if (arrai[1]!=0) {
		if (arrai[0]!=0) {
			formk.resultbox.value += "+";
		}
		formk.resultbox.value += (arrai[1] + "i");
	}
	if (arrai[2]!=0) {
		if ((arrai[0]!=0)||(arrai[1]!=0)) {
			formk.resultbox.value += "+";
		}
		formk.resultbox.value += (arrai[2] + "j");
	}
	if (arrai[3]!=0) {
		if ((arrai[0]!=0)||(arrai[1]!=0)||(arrai[2]!=0)) {
			formk.resultbox.value += "+";
		}
		formk.resultbox.value += (arrai[3] + "k");
	}
}

function add_one(single, termful) {
	var strippn;
	if (!(single.match(/[ijk]/))) {
		strippn = single*1;
		//alert(strippn);
		termful[0] += strippn;
	}
	else if (single.match(/i/)) {
		single = single.replace(/i/,"");
		//alert(single);
		strippn = single*1;
		termful[1] += strippn;
	}
	else if (single.match(/j/)) {
		single = single.replace(/j/,"");
		//alert(single);
		strippn = single*1;
		termful[2] += strippn;
	}
	else {
		single = single.replace(/k/,"");
		//alert(single);
		strippn = single*1;
		termful[3] += strippn;
	}
	
	return termful;
}

function array_sort(S) {
	T = new Array();
	for(var cqc=0; cqc<S.length;cqc++) {
		if (S[cqc].match(/i/)) {
			S[cqc] = S[cqc].replace(/i/,"");
			T[1] = S[cqc]*1;
		}
		else if (S[cqc].match(/j/)) {
			S[cqc] = S[cqc].replace(/j/,"");
			T[2] = S[cqc]*1;
		}
		else if (S[cqc].match(/k/)) {
			S[cqc] = S[cqc].replace(/k/,"");
			T[3] = S[cqc]*1;
		}
		else {
			T[0] = S[cqc]*1;
		}
	}
	for (var qk=0; qk<=3; qk++) {
		if (!T[qk]) {
			T[qk] = 0;
		}
	}
	return T;
}

function unitmult(t, u) {
	if (t.match(/i/)) {
		if (u.match(/i/)) {
			return "-1";
		}
		else if (u.match(/j/)) {
			return "k";
		}
		else if (u.match(/k/)) {
			return "-j";
		}
	}
	else if (t.match(/j/)) {
		if (u.match(/i/)) {
			return "-k";
		}
		else if (u.match(/j/)) {
			return "-1";
		}
		else if (u.match(/k/)) {
			return "i";
		}
	}
	else if (t.match(/k/)) {
		if (u.match(/i/)) {
			return "j";
		}
		else if (u.match(/j/)) {
			return "-i";
		}
		else if (u.match(/k/)) {
			return "-1";
		}
	}
}

function mono_addn(A, B) {
	var aachay;
	var bechay;
	if ((!A.match(/[ijk]/)) && (!B.match(/[ijk]/))) {
		aachay = A*1;
		bechay = B*1;
		return (aachay + bechay);
	}
	else if (A.match(/i/) && B.match(/i/)) {
		A = A.replace(/i/,"");
		B = B.replace(/i/,"");
		aachay = A*1;
		bechay = B*1;
		aachay += bechay;
		A = aachay + "i";
		return A;
	}
	else if (A.match(/j/) && B.match(/j/)) {
		A = A.replace(/j/,"");
		B = B.replace(/j/,"");
		aachay = A*1;
		bechay = B*1;
		aachay += bechay;
		A = aachay + "j";
		return A;
	}
	else if (A.match(/k/) && B.match(/k/)) {
		A = A.replace(/k/,"");
		B = B.replace(/k/,"");
		aachay = A*1;
		bechay = B*1;
		aachay += bechay;
		A = aachay + "j";
		return A;
	}
	else {
		if ((!A.match(/[ijk]/)) && B.match(/[ijk]/)) {
			return (A + "+" + B);
		}
		else if (A.match(/[ijk]/) && (!B.match(/[ijk]/))) {
			return (B + "+" + A);
		}
		else if (A.match(/i/)) {
			return (A + "+" + B);
		}
		else if (B.match(/i/)) {
			return (B + "+" + A);
		}
		else if (A.match(/j/)) {
			return (A + "+" + B);
		}
		else if (B.match(/j/)) {
			return (B + "+" + A);
		}
	}
}
