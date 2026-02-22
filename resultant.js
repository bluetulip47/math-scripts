function esp(form) {
	var p_big = form.inputboxp.value;
	var q_big = form.inputboxq.value;
	form.resultbox.value = "";
	var p_mono = new Array();
	var q_mono = new Array();

	if (q_big.match(/[+-]/) && p_big.match(/[+-]/)) {
		//if both polynomials have at least two terms
		p_mono = p_big.split(/[+-]/g);
		q_mono = q_big.split(/[+-]/g);
	}
	else if (!q_big.match(/x/) && !p_big.match(/x/)) {
		//if both polynomials are constants
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += "1\n";
		return;
	}
	else if ((!q_big.match(/[+-]/))&&(!q_big.match(/x/))) {
		//if G (that is, q) is a constant
		var rpp = p_big.replace(/(\S)*\^/,"");
		rpp = rpp.replace(/[+-](\S)*/,"");
		//rpp is the degree of F (that is, m)
		if (rpp.match(/x/)) {
			rpp = "1";
		}
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(q_big,rpp) + "\n");
		return;
	}
	else if ((!p_big.match(/[+-]/))&&(!p_big.match(/x/))) {
		//if F is a constant polynomial.
		var rkq = q_big.replace(/(\S)*\^/,"");
		rkq = rkq.replace(/[+-](\S)*/,"");
		//rkq is the degree of G (that is, n)
		if (rkq.match(/x/)) {
			rkq = 1;
		}
		//Res(F,G) = Res(p_0,G) = (-1)^(m*n)*Res(G,p_0) = (-1^rkq+1)*p_0^rkq
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += ((Math.pow(p_big,rkq)) + "\n");
		return;
	}
	else if (p_big.match(/x/) && !p_big.match(/[+-]/) && !q_big.match(/[+-]/) && q_big.match(/x/)) {
		//if F and G are both monomials, but not constants
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += "0\n";
		return;
	}
	else if (!p_big.match(/[+-]/)) {
		//alert("ppppppp");
		//F is a non-constant monomial, and G is a polynomial
		p_mono[0] = p_big;
		q_mono = q_big.split(/[+-]/g);
		//alert("ehp-mono");
	}
	else {
		//alert("qqqqq");
		//G is a non-constant monomial, and F is a polynomial
		q_mono[0] = q_big;
		p_mono = p_big.split(/[+-]/g);
		//alert("ehq-mono");
	}
	
	var p_sign = new Array();
	var p_coef = new Array();
	var p_expo = new Array();
	var q_sign = new Array();
	var q_coef = new Array();
	var q_expo = new Array();
	
	//alert ("kachuhnk");
	
	if ((p_mono[0] == "") || (q_mono[0] == "")) {
		alert("Please enter a polynomial with positive leading coefficient.");
		return;
	}
	
	var kip = p_big.match(/[+-]/g);
	if (p_mono[1]) {
		if (kip.length < p_mono.length) {
			kip.unshift("+");
			//alert("childlike temper tantrum!");
			//return;
		}
		for(var cpc=0; cpc<p_mono.length; cpc++) {
			if (kip[cpc] == "+") {
				p_sign[cpc] = "pos";
			}
			else if (kip[cpc] == "-") {
				p_sign[cpc] = "neg";
			}
		}
	}
	else {
		p_sign[0] = "pos";
	}
	
	var kiq = q_big.match(/[+-]/g);
	if (q_mono[1]) {
		if (kiq.length < q_mono.length) {
			kiq.unshift("+");
		}
		alert(kiq);
		for(var cqc=0; cqc<q_mono.length;cqc++) {
			if (kiq[cqc].match("+")) {
				q_sign[cqc] = "pos";
			}
			else if (kiq[cqc].match("-")) {
				q_sign[cqc] = "neg";
			}
		}
	}
	else {
		q_sign[0] = "pos";
	}
	
	//alert("kadachunknik");
	
	for (var puk=0; puk<p_mono.length; puk++) {
		p_coef[puk] = p_mono[puk].replace(/\^(\S)*/,"");
		if ((!p_mono[puk].match(/\^/)) && p_mono[puk].match(/x/)) {
			p_expo[puk] = 1;
		}
		else if (!p_mono[puk].match(/x/)) {
			p_expo[puk] = 0;
		}
		else {
			p_expo[puk] = p_mono[puk].replace(/(\S)*\^/,"");
		}
		if (p_coef[puk] == "x") {
			p_coef[puk] = 1;
		}
		else if (p_coef[puk].match(/\W/)) {
			alert("Oh, right, can't actually handle fractions right now, oops.");
			return;
		}
		else {
			p_coef[puk] = p_coef[puk].replace(/x/,"");
			p_coef[puk] = parseInt(p_coef[puk]);
		}
	}
	
	//alert("still with ya");
	
	//check that monomials are in decreasing degree
	for (var pok=0; pok<(p_mono.length-1); pok++) {
		if (p_expo[pok]<=p_expo[pok+1]) {
			alert("Please re-enter first polynomial with monomials arranged by decreasing degree.");
			return;
		}
		else if (Math.floor(p_expo[pok]) != p_expo[pok]) {
			alert("Sorry, we can only work with integer exponents right now!");
			return;
		}
	}
	
	for (var quk=0; quk<q_mono.length; quk++) {
		q_coef[quk] = q_mono[quk].replace(/\^(\S)*/,"");
		if ((!q_mono[quk].match(/\^/)) && q_mono[quk].match(/x/)) {
			q_expo[quk] = 1;
		}
		else if (!q_mono[quk].match(/x/)) {
			q_expo[quk] = 0;
		}
		else {
			q_expo[quk] = q_mono[quk].replace(/(\S)*\^/,"");
		}
		if (q_coef[quk] == "x") {
			q_coef[quk] = 1;
		}
		else if (q_coef[quk].match(/\W/)) {
			alert("Oh, right, can't actually handle fractions right now, oops.");
			return;
		}
		else {
			q_coef[quk] = q_coef[quk].replace(/x/,"");
			q_coef[quk] = parseInt(q_coef[quk]);
		}
		if (quk>0) {
			fascinating = true;
		}
	}
	
	//check that monomials are in decreasing degree
	for (var qok=0; qok<(q_mono.length-1); qok++) {
		if (q_expo[qok]<=q_expo[qok+1]) {
			alert("Please re-enter second polynomial with monomials arranged by decreasing degree.");
			return;
		}
		else if (Math.floor(q_expo[qok]) != q_expo[qok]) {
			alert("Sorry, we can only work with integer exponents right now!");
			return;
		}
	}
	
	var chez;
	
	if (p_expo[0] > q_expo[0]) {
		chez = p_expo[0];
	}
	else {
		chez = q_expo[0];
	}
	//alert(chez);
	
	var p_rt = 1;
	var p_rt2 = 1;
	var q_rt = 1;
	var q_rt2 = 1;
	if (chez == 1) {
		//alert ("chez is one");
		if (p_sign[1] == "pos") {
			p_rt = (-1)*p_coef[1]/p_coef[0];
		}
		else if (p_sign[1] == "neg") {
			p_rt = p_coef[1]/p_coef[0];
		}
		else {
			p_rt = 0;
		}
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		//alert(p_rt + "p_rt, " + p_coef[0] + "pcoef");
		form.resultbox.value += (p_coef[0]*evalu(q_sign,q_coef,q_expo,p_rt)+"\n");
		return;
	}
	else if (!p_big.match(/[+-]/)) {
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += ((Math.pow(p_coef[0],q_expo[0])*Math.pow(evalu(q_sign,q_coef,q_expo,0),p_expo[0]))+"\n");
		return;
	}
	else if (!q_big.match(/[+-]/)) {
		//Q is a non-constant monomial
		//Res(F,G) ~= Res(P,Q) = (-1)^(degPdegQ)*Res(Q,P)
		//Res(F,G) = (-1^(f_e[0]*g_e[0]))*...
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += ((Math.pow(q_coef[0],p_expo[0])*Math.pow(-1,q_expo[0]*p_expo[0])*Math.pow(evalu(p_sign,p_coef,p_expo,0),q_expo[0]))+"\n");
		return;
	}
	else if ((p_expo[0] == 2) && (q_expo[0] <= 1) && (p_expo[1] == 0)) {
		//if p has a and c, b=0
		//and q is linear (but again, must have two terms, since monomials already done)
		if (p_sign[1] == "neg") {
			p_rt = Math.sqrt(p_coef[1]/p_coef[0]);
			p_rt2 = (-1)*Math.sqrt(p_coef[1]/p_coef[0]);
			form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
			form.resultbox.value += (p_coef[0]*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)+"\n");
		}
		else {
			q_rt = q_coef[1] / q_coef[0];
			if (q_sign[1] == "neg") {
				q_rt *= (-1);
			}
			form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
			form.resultbox.value += (Math.pow(-1,q_expo[0]*p_expo[0])*evalu(p_sign,p_coef,p_expo,q_rt)*q_coef[0]*q_coef[0]+"\n");
		}
		return;
	}
	else if (p_expo[0]==1) {
		//first polynomial is linear with two terms...
		//second polynomial is any random set of two or more terms
		p_rt = p_coef[1]/p_coef[0];
		if (p_sign[1] == "pos") {
			p_rt *= (-1);
		}
		//alert("p root: " + p_rt);
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt)+"\n");
		return;
	}
	else if (q_expo[0]==1) {
		//second polynomial is linear with two terms...
		//first polynomial is any random set of two or more terms
		q_rt = q_coef[1]/q_coef[0];
		if (q_sign[1]=="pos") {
			q_rt *= (-1);
		}
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(-1,p_expo[0])*Math.pow(q_coef[0],p_expo[0])*evalu(p_sign,p_coef,p_expo,q_rt)+"\n");
		return;
	}
	else if ((p_expo[0]==2)&&(p_expo[1]==1)&&(p_coef.length==2)) {
		//p is quadratic, a and b nonzero, c=0
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		p_rt = 0;
		p_rt2 = p_coef[1]/p_coef[0];
		if (p_sign[1] == "pos") {
			p_rt2 *= (-1);
		}
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt2)*evalu(q_sign,q_coef,q_expo,p_rt)+"\n");
		return;
	}
	else if ((p_expo[0]==2)&&(p_expo[1]==0)&&(q_expo[0]==2)&&(q_expo[1]==0)) {
		//both p and q are quadratics with a and c nonzero, b=0
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		if (p_sign[1]=="neg") {
			p_rt = Math.sqrt(4*p_coef[0]*p_coef[1]) / (2*p_coef[0]);
			p_rt2 = (-1)*Math.sqrt(4*p_coef[0]*p_coef[1]) / (2*p_coef[0]);
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)+"\n");
		}
		else if (q_sign[1]=="neg") {
			q_rt = Math.sqrt(4*q_coef[0]*q_coef[1]) / (2*q_coef[0]);
			q_rt2 = (-1)*Math.sqrt(4*q_coef[0]*q_coef[1]) / (2*q_coef[0]);
			form.resultbox.value += (Math.pow(-1,q_expo[0]*p_expo[0])*Math.pow(q_coef[0],p_expo[0])*evalu(p_sign,p_coef,p_expo,q_rt)*evalu(p_sign,p_coef,p_expo,q_rt2)+"\n");
		}
		else {
			//both have imaginary roots
			var iroot = Math.sqrt(p_coef[1]/p_coef[0]);
			//roots of p are (+/-)(iroots)(i)
			var q_at_p = (q_coef[0]*iroot*iroot*(-1))+q_coef[1];
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*q_at_p*q_at_p+"\n");
		}
		return;
	}
	else if ((q_expo[0]==2)&&(q_expo[1]==1)&&(q_expo.length==2)) {
		//q is binomial quadratic, with a and b nonzero, c = 0
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		q_rt = 0;
		q_rt2 = q_coef[1]/q_coef[0];
		if (q_sign[1] == "pos") {
			q_rt2 *= (-1);
		}
		form.resultbox.value += ("-1^"+(q_expo[0]*p_expo[0])+"*"+q_coef[0]+"^"+p_expo[0]+"*");
		form.resultbox.value += ("F("+q_rt+")*F("+q_rt2+") = ");
		form.resultbox.value += (Math.pow(-1,q_expo[0]*p_expo[0])*Math.pow(q_coef[0],p_expo[0])*evalu(p_sign,p_coef,p_expo,q_rt2)*evalu(p_sign,p_coef,p_expo,q_rt)+"\n");
		return;
	}
	else if ((p_expo[0]==2)&&(p_expo[1]==0)) {
		//any time p is binomial with b=0 (but a and c nonzero)
		//have already filtered out any q with binomial quadratic or linear, monomial, or constant
		//so: q has three or more terms, OR q has only two terms, but degree 3 or higher
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		if (p_sign[1]=="neg") {
			p_rt = Math.sqrt(p_coef[1]/p_coef[0]);
			p_rt2 = (-1)*Math.sqrt(p_coef[1]/p_coef[0]);
			form.resultbox.value += (evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)*Math.pow(p_coef[0],q_expo[0])+"\n");
		}
		else {
			//p has two single-term imaginary roots (ie, no real part)
			var p_rt_square = p_coef[1]/p_coef[0];
			p_rt_square *= (-1);
			var G_rt1 = new Array();
			var G_rt2 = new Array();
			G_rt1[0] = 0;
			G_rt1[1] = 0;
			G_rt2[0] = 0;
			G_rt2[1] = 0;
			for (var kt = 0; kt<q_expo.length;kt++) {
				if ((q_expo[kt]%2)==0) {
					G_rt1[0] += q_coef[kt]*Math.pow(p_rt_square,q_expo[kt]/2);
					G_rt2[0] += q_coef[kt]*Math.pow(p_rt_square,q_expo[kt]/2);
				}
				else if (q_expo[kt]==1) {
					G_rt1[1] += q_coef[kt]*Math.sqrt((-1)*p_rt_square);
					G_rt2[1] -= q_coef[kt]*Math.sqrt((-1)*p_rt_square);
				}
				else {
					G_rt1[1] += q_coef[kt]*Math.sqrt((-1)*p_rt_square)*Math.pow(p_rt_square,(q_expo[kt]-1)/2);
					G_rt2[1] -= q_coef[kt]*Math.sqrt((-1)*p_rt_square)*Math.pow(p_rt_square,(q_expo[kt]-1)/2);
				}
			}
			alert(G_rt1 + ", " + G_rt2);
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*((G_rt1[0]*G_rt2[0])-(G_rt1[1]*G_rt2[1]))+"\n");
		}
		return;
	}
	else if ((p_expo.length==2)&&(p_expo[0]==3)&&(p_expo[1]==2)) {
		//p is binomial with terms of deg3 and deg2
		p_rt = p_coef[1]/p_coef[0];
		if (p_sign[1]=="pos") {
			p_rt *= -1;
		}
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,0)*evalu(q_sign,q_coef,q_expo,0)+"\n");
		return;
	}
	else if (p_expo[0]==2) {
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		//p is quadratic, with a, b and c all nonzero
		//q is polynomial (at least two terms), quadratic or higher
		if (((p_coef[1]*p_coef[1])==(4*p_coef[0]*p_coef[2]))&&(p_sign[2]=="pos")) {
			//discriminant is zero, so the two roots are equal, -b/2a
			p_rt = p_coef[1] / (2*p_coef[0]);
			if (p_sign[1]=="pos") {
				p_rt *= -1;
			}
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt)+"\n");
		}
		else if ((p_sign[2]=="neg")||(p_coef[1]*p_coef[1]>=(p_coef[2]*4*p_coef[0]))) {
			//discriminant is some real number
			p_rt = p_coef[1];
			p_rt2 = p_coef[1];
			if (p_sign[1]=="pos") {
				p_rt *= -1;
				p_rt2 *= -1;
			}
			var disc = 4*p_coef[0]*p_coef[2];
			if (p_sign[2]=="pos") {
				disc *= -1;
			}
			disc += p_coef[1]*p_coef[1];
			disc = Math.sqrt(disc);
			p_rt += disc;
			p_rt2 -= disc;
			p_rt /= (2*p_coef[0]);
			p_rt2 /= (2*p_coef[0]);
			form.resultbox.value += ("a^n * G(" + p_rt + ") * G(" + p_rt2 + ") = ");
			form.resultbox.value += (p_coef[0] + "^" + q_expo[0] + "*" + evalu(q_sign,q_coef,q_expo,p_rt) + "*" + evalu(q_sign,q_coef,q_expo,p_rt2) + " = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)+"\n");
		}
		else {
			var real_pt = p_coef[1] / (2*p_coef[0]);
			if (p_sign=="pos") {
				real_pt *= -1;
			}
			var im_pt = 4*p_coef[0]*p_coef[2];
			if (p_sign[2]=="pos") {
				im_pt *= -1;
			}
			im_pt += p_coef[1]*p_coef[1];
			alert(im_pt);
			im_pt = Math.sqrt(im_pt*(-1));
			im_pt /= (2*p_coef[0]);
			//discriminant is imaginary...
			form.resultbox.value += ("a^n * G(" + real_pt + "+" + im_pt + "i) * G(" + real_pt + "-" + im_pt + "i) = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0]) + "*");
			form.resultbox.value += ("G(" + real_pt + "+" + im_pt + "i)*G(" + real_pt + "-" + im_pt + "i) = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0]) + "*(");
			for (var ii=0;ii< q_expo.length;ii++) {
				if (q_coef[ii] > 1) {
					form.resultbox.value += (q_coef[ii]+"*");
				}
				else if (q_expo==0) {
					form.resultbox.value += q_coef[ii];
				}
				if (q_expo >= 1) {
					print_impow(real_pt,im_pt,q_expo[ii],form);
				}
				if (ii<(q_expo.length-1)) {
					if (q_sign[ii+1].match(/pos/)) {
						form.resultbox.value += "+";
					}
					else {
						form.resultbox.value += "-";
					}
				}
			}
			form.resultbox.value += q_coef[q_coef.length-1];
			form.resultbox.value += (")*G("+real_pt+"-"+im_pt+"i)\n");
		}
		return;
	}
	else if ((p_expo[0]==3)&&(p_expo[1]==1)&&(p_expo.length==2)) {
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		//p is of the form p_3x^3+p_1x
		//as such it has three roots: 0, and the roots of x^2+(p_1/p_3)
		if (p_sign[1]=="neg") {
			p_rt = Math.sqrt(p_coef[1]/p_coef[0]);
			p_rt2 = (-1)*(p_rt);
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])+"* G(0) *");
			form.resultbox.value += (" G(" +p_rt+ ") * G(" +p_rt2+") = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])+"*"+evalu(q_sign,q_coef,q_expo,0)+"*");
			form.resultbox.value += (evalu(q_sign,q_coef,q_expo,p_rt)+"*"+evalu(q_sign,q_coef,q_expo,p_rt2)+" = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,0)*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)+"\n");
		}
		else {
			p_rt = p_coef[1]/p_coef[0];
			p_rt = Math.sqrt(p_rt);
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0]) + "* G(0) * G(" + p_rt + "i) + G(-" + p_rt + "i) = ");
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,0)+" * G(" + p_rt + "i) + G(-" + p_rt + "i)\n");
		}
		return;
	}
	else if ((p_expo[p_expo.length-1]>=1)&&(q_expo[q_expo.length-1]>=1)) {
		//if neither P nor Q has a constant term, both have root 0, so the resultant is zero
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = 0");
		return;
	}
	else if ((p_expo[0]==3)&&(p_expo.length==2)) {
		//P is of the form p[0]x^3 + p[1], no other terms (other binomial degree 3's have already been done)
		p_rt = p_coef[1]/p_coef[0];
		p_rt = cbrt(p_rt);
		if (p_sign[1]=="pos") {
			p_rt *= -1;
		}
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])+" * G(" + p_rt + ")^3 = ");
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*Math.pow(evalu(q_sign,q_coef,q_expo,p_rt),3)+"\n");
		return;
	}
	else if ((p_expo[0]==3)&&(p_expo[2]==1)&&(p_expo.length==3)) {
		//P is trinomial cubic, with constant equal to zero
		//that is, P is of the form p[0]x^3+p[1]x^2+p[2]x
		//so p[0]x(x^2+(p[1]/p[0])x+(p[2]/p[0])...
		//roots are 0, and the roots of (x^2+(p[1]/p[0])x+(p[2]/p[0])
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		var dics = 4*p_coef[0]*p_coef[2];
		if (p_sign[2]=="pos") {
			dics *= -1;
		}
		dics += Math.pow(p_coef[1]/p_coef[0],2);
		alert(dics);
		if (dics == 0) {
			p_rt = p_coef[1]/(2*p_coef[0]);
			p_rt2 = p_coef[1]/(2*p_coef[0]);
			if (p_sign[1]=="pos") {
				p_rt *= -1;
				p_rt2 *= -1;
			}
		}
		else if (dics > 0) {
			p_rt = p_coef[1];
			p_rt2 = p_coef[1];
			if (p_sign[1]=="pos") {
				p_rt *= -1;
				p_rt2 *= -1;
			}
			p_rt += Math.sqrt(dics);
			p_rt2 -= Math.sqrt(dics);
			p_rt /= (2*p_coef[0]);
			p_rt2 /= (2*p_coef[0]);
		}
		else if (dics < 0) {
			var realp = p_coef[1]/(2*p_coef[0]);
			if (p_sign[1] == "pos") {
				realp *= -1;
			}
			dics *= -1;
			dics = Math.sqrt(dics);
			dics /= (2*p_coef[0]);
			form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,0) + " * G("+realp+"+"+dics+"i) * G("+realp+"-"+dics+"i)\n");
			return;
		}
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,0) + " * G(" + p_rt + ") * G(" + p_rt2+ ") = ");
		form.resultbox.value += (Math.pow(p_coef[0],q_expo[0])*evalu(q_sign,q_coef,q_expo,0)*evalu(q_sign,q_coef,q_expo,p_rt)*evalu(q_sign,q_coef,q_expo,p_rt2)+"\n");
		return;
	}
	else if ((q_expo[0]<=2)&&(q_expo.length==2)) {
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		
		//Q is binomial of the form q[0]x^2+q[1]
		
		q_rt = Math.sqrt(q_coef[1]/q_coef[0]);
		if (q_sign[1]=="neg") {
			form.resultbox.value += (Math.pow(-1,p_expo[0]*q_expo[0])*Math.pow(q_coef[0],p_expo[0])*evalu(p_sign,p_coef,p_expo,q_rt)*evalu(p_sign,p_coef,p_expo,-1*q_rt)+"\n");
		}
		else {
			form.resultbox.value += (Math.pow(-1,p_expo[0]*q_expo[0])*Math.pow(q_coef[0],p_expo[0])+" * F(");
			form.resultbox.value += (q_rt + "i) * F(-" + q_rt + "i)");
			//roots are imaginary
		}
		return;
	}
	else if ((q_expo[0]==2)&&(p_expo[0]==3)) {
		//q is quadratic with all three terms nonzero
		//p is cubic with a, b and d nonzero, c possibly zero
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(-1,p_expo[0]*q_expo[0])*Math.pow(q_coef[0],p_expo[0]-1) + "*");
		var A = p_coef[0]/q_coef[0];
		var B = p_coef[1];
		if (p_sign[1]=="neg") {
			B *= -1;
		}
		if (q_sign[1]=="neg") {
			B += A*q_coef[1];
		}
		else {
			B -= A*q_coef[1];
		}
		alert (A + "x + " + B);
		var r_1 = "(";
		if (q_sign[1]=="neg") {
			r_1 += "-";
		}
		r_1 += q_coef[1]+"*"+B+"+";
		if (q_sign[2]=="neg") {
			r_1 += "-";
		}
		r_1 += q_coef[2]+"*"+A+")";
		if (p_expo[2]==1) {
			r_1 = "("+p_coef[2]+"-"+r_1+")";
		}
		var r_0 = p_coef[p_coef.length-1] + "-" + B + "*";
		if (q_sign[q_coef.length-1]=="neg") {
			r_0 += "-";
		}
		r_0 += q_coef[q_coef.length-1];
		if (p_sign[p_coef.length-1] == "neg") {
			r_0 = "-" + r_0;
		}
		form.resultbox.value += ("Res(" + q_big + ", " + r_1 + "x + "+r_0+")");
		return;
	}
	else if (chez == 3) {
		form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
		form.resultbox.value += (Math.pow(-1,p_expo[0]*q_expo[0]) + "*" + q_coef[0] + "^(" +p_expo[0] +"-degR)*");
		form.resultbox.value += ("Res(" + q_big + ", ");
		if (q_expo[1] == 2) {
			var x_quad = q_coef[1];
			if (q_sign[1] == "pos") {
				x_quad *= -1;
			}
			//alert("q's x^2 term is(-): " + x_quad + "the sign on q is " + q_sign[1]);
			x_quad *= p_coef[0]/q_coef[0];
			if (p_sign[1]=="neg") {
				x_quad -= p_coef[1];
			}
			else if (p_sign[1] == "pos") {
				x_quad += p_coef[1];
			}
			form.resultbox.value += x_quad + "x^2 + ";
		}
		else {
			if (p_sign[1]=="neg") {
				form.resultbox.value += "-";
			}
			form.resultbox.value += p_coef[1] + "x^2 + ";
		}
		var q_lin = 0;
		var p_lin = 0;
		if (q_expo[2]==1) {
			q_lin = q_coef[2];
			if (q_sign[2]=="neg") {
				q_lin *= -1;
			}
		}
		else if (q_expo[1]==1) {
			q_lin = q_coef[1];
			if (q_sign[1]=="neg") {
				q_lin *= -1;
			}
		}
		if (p_expo[2]==1) {
			p_lin = p_coef[2];
			if (p_sign[2]=="neg") {
				p_lin *= -1;
			}
		}
		form.resultbox.value += (p_lin - (q_lin*p_coef[0]/q_coef[0])) + "x + ";
		var q_cons = 0;
		var p_cons = p_coef[p_coef.length-1];
		if (p_sign[p_coef.length-1]=="neg") {
			p_cons *= -1;
		}
		if (q_expo[q_expo.length-1]==0) {
			q_cons = q_coef[q_expo.length-1];
			if (q_sign[q_expo.length-1]=="neg") {
				q_cons *= -1;
			}
		}
		form.resultbox.value += (p_cons - (q_cons*p_coef[0]/q_coef[0]));
		r_big = form.resultbox.value;
		r_big = r_big.replace(/[\s\^()*=a-zA-Z0-9+-]*,/g,"");
		form.resultbox.value += ")\n";
		r_big = r_big.replace(/\s/g,"");
		r_big = r_big.replace(/1x/g,"x");
		r_big = r_big.replace(/[+-]0x[\^]?[\d]*/g,"");
		r_big = r_big.replace(/^0x[\^]?[\d]*[+-]?/,"");
		r_big = r_big.replace(/[+-]0$/,"");
		form.resultbox.value += r_big + "\n";
		if (!r_big.match(/^-/)) {
			var deg_r = r_big.replace(/[+-]\d*x\^?\d*/g,"");
			if (!deg_r.match(/x/)) {
				deg_r = 0;
			}
			else if (!deg_r.match(/\^/)) {
				deg_r = 1;
			}
			else {
				deg_r = deg_r.replace(/\d*x\^/);
			}
			form.resultbox.value += ("Res(" + p_big + ", " + q_big + ") = ");
			form.resultbox.value += Math.pow(-1,p_expo[0]*q_expo[0])*Math.pow(q_coef[0],p_expo[0]-deg_r) + "*" + quad_resultant(q_sign,q_coef,q_expo,deg_r,r_big) + "\n";
		}
		return;
	}
	
	alert (p_expo.length + ", " + q_expo.length);
	for(var choo=0; choo<=chez; choo++) {
		form.resultbox.value += (p_sign[choo] + p_coef[choo] + "x^" + p_expo[choo] + ", ");
		form.resultbox.value += (q_sign[choo] + q_coef[choo] + "x^" + q_expo[choo] + "\n");
	}
}

function quad_resultant(a_sign,a_coef,a_pows,degr,rootr) {
	if (degr == 0) {
		return Math.pow(rootr,a_pows[0]);
	}
	if (!rootr.match(/[+-]/)) {
		return Math.pow(a_coef[0],degr)*evalu(a_sign,a_coef,a_pows,0);
	}
	var monor = rootr.split(/[+-]/g);
	var kitch = rootr.match(/[+-]/g);
	kitch.unshift("+");
	var r0;
	if (degr == 1) {
		r0 = monor[0].replace(/x/,"");
		r0 /= monor[1];
		if (kitch[1]=="-") {
			r0 *= -1;
		}
		return a_coef[0]*evalu(a_sign,a_coef,a_pows,r0);
	}
	var rsq_coef = mono[0].replace(/x/,"");
	if ((degr == 2)&&(!monor[1].match(/x/))&&(kitch[1]=="-")) {
		r0 = Math.sqrt(monor[1]/rsq_coef);
		return a_coef[0]*a_coef[0]*evalu(a_sign,a_coef,a_pows,r0)*evalu(a_sign,a_coef,a_pows,-1*r0);
	}
	return 99999999999999999999999;
}

function evalu(signs,coeds,highs,xxx) {
	var resp, today;
	resp = 0;
	if ((xxx != 0)&&(signs.length>1)) {
		for (var chiz = 0; chiz < signs.length; chiz++) {
			if ((highs[chiz]==0)&&(signs[chiz]=="pos")) {
				today = 1;
			}
			else if (signs[chiz] == "neg") {
				today = -1;
				if (highs[chiz]>0) {
					today *= Math.pow(xxx,highs[chiz]);
				}
			}
			else if (signs[chiz] == "pos") { 
				today = Math.pow(xxx,highs[chiz]);
			}
			today *= coeds[chiz];
			//alert(today + " !!! " + chiz);
			resp += today;
			alert(coeds[chiz] + "*" + xxx + "^" + highs[chiz] + " = " + today);
		}
	}
	else if (xxx == 0) {
		if ((signs[(signs.length)-1] == "pos")&&(highs[(highs.length)-1]==0)) {
			return coeds[(signs.length)-1];
		}
		else if (highs[(highs.length)-1]==0) {
			return ((-1)*coeds[(signs.length)-1]);
		}
		else {
			return 0;
		}
	}
	else {
		return (coeds[0]*Math.pow(xxx,highs[0]));
	}
	//alert(resp);
	return resp;
}

function print_impow(real,impa,rai,forq) {
	if (rai > 1) {
		forq.resultbox.value += ("("+real+"+"+impa+"i)^"+rai);
	}
	else if (rai == 1) {
		forq.resultbox.value += ("("+real+"+"+impa+"i)");
	}
}

function cbrt(val) {
	var cub = val;
	cub = Math.pow(cub,0.33333333333333333333333);
	return cub;
}

function fact(num) {
	var facto = num;
	if (facto == 0) { return 1; }
	
	for (var go = 1; go < num; go++) {
		facto *= num - go;
	}
	return facto;
}
