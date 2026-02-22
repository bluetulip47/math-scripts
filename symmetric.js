function esp(form) {
	var k = parseInt(form.inputboxk.value);
	var n = parseInt(form.inputboxn.value);
	// alert(k + " " + n);

	var n_choose_k = fact(n) / (fact(k) * fact(n - k));
	// alert(fact(n) + " " + n_choose_k);

	if (k > n) {
		alert("Please try again: k must be less than n.");
		return;
	}
	//else if (k > 5) {
	//	alert("We're sorry, the generator cannot currently accomodate k > 5.");
	//	return;
	//}

	if (k == 1) {
		form.resultbox.value = ("s_" + k + " =");
		for(var zaz=1; zaz<=n; zaz++) {
			form.resultbox.value += (" x_" + zaz);
			if (zaz < n) {
				form.resultbox.value += (" +");
			}
		}
		form.resultbox.value += ("\n");
	}
	else if (k == n) {
		form.resultbox.value = ("s_" + k + " = ");
		for(var zap=1; zap<=n; zap++) {
			form.resultbox.value += ("x_" + zap);
			if (zap < n) {
				form.resultbox.value += ("*");
			}
		}
		form.resultbox.value += ("\n");
	}
	else {
		form.resultbox.value = ("s_" + k + " = ");
		var top = new Array();
		for (var init = 0; init < k; init++) {
			top[init] = init+1;
		}
		
		var b = new Array();
		for (var popl = 0; popl < n_choose_k; popl++) {
			b[popl] = new Array();
			for (var setup = 0; setup < k; setup++) {
				b[popl][setup] = top[setup];
			}
		}
		
		b[1][k-1]++;
		
		// populate first column
		var curr_value = 1;
		var n_mr_C_k_m1 = fact(n-1) / (fact(k-1) * fact(n - k));
		var empsh;
		
		for (var rown = 1; rown < n_choose_k; rown++) {
			if (rown >= n_mr_C_k_m1) {
				curr_value += 1;
				empsh = fact(n - curr_value) / (fact(k-1) * fact(n-k-curr_value+1));
				//alert(empsh);
				n_mr_C_k_m1 += empsh;
				
				for (var colc = 1; colc < k; colc++) {
					b[rown][colc] = curr_value + colc;
				}
			}
			b[rown][0] = curr_value;
		}
		
		//populate second column
		var curvet = 2;
		var counter = fact(n-2) / (fact(k-2) * fact(n-k));
		counter--;
	
		for (var rowt = 1; rowt < n_choose_k; rowt++) {
			if (b[rowt][0] > b[rowt-1][0]) {
				curvet = b[rowt][0];
				curvet++;
				counter = fact(n-curvet) / (fact(k-2)*fact(n-curvet-k+2));
			}
			else if (counter == 0) {
				curvet++;
				// alert(curvet);
				counter = fact(n-curvet) / (fact(k-2)*(fact(n-curvet-k+2)));
			}
			b[rowt][1] = curvet;
			counter--;
		}
		
		//finish out rows
		if ((k > 2) && (k <= 5)) {
			for (var rokx = 2; rokx < n_choose_k; rokx++) {
				if (b[rokx][1] > b[rokx-1][1]) {
					for (var icol = 2; icol < k; icol++) {
						b[rokx][icol] = b[rokx][icol-1] + 1;
					}
				}
				else if (b[rokx][0] <= b[rokx-1][0]) {
					// if nothing has changed since the last one, just copy the last column
					for (var cull = 2; cull < k; cull++) {
						b[rokx][cull] = b[rokx-1][cull];
					}
					b[rokx][k-1]++;
					if (b[rokx][k-1] > n) {
						// when increasing the last digit is out of bounds,
						// bump up the second-to-last, and set the last one
						// to one more than it
						b[rokx][k-2]++;
						b[rokx][k-1]=b[rokx][k-2];
						b[rokx][k-1]++;
						
						// but what if that set the second-to-last to n?
						if ((k > 3) && (b[rokx][k-2] > (n-1))) {
							var upsteps = 1;
							//while (b[rokx][k-upsteps-1] == (n-upsteps-1)) {
							//	b[rokx][k-upsteps-2]++;
							//	upsteps++;
							//}
							b[rokx][k-upsteps-2]++;
							for (var res = k-upsteps-1; res < k; res++) {
								b[rokx][res] = b[rokx][res-1];
								b[rokx][res]++;
							}
						}
					}
				}
				// if first column increased, do nothing; row already filled in
			}
		}
		
		else if (k > 5) {
			for (var column = 2; column < k; column++) {
				//populate third and up columns
				var curvchen = column+1;			// current value of column entry
				var couv = fact(n-curvchen) / (fact(k-curvchen) * fact(n-k));
				couv--;				// number of combinations left for this curvchen
	
				for (var rowd = 1; rowd < n_choose_k; rowd++) {
					if (b[rowd][column-1] > b[rowd-1][column-1]) {
						curvchen = b[rowd][column-1];
						curvchen++;
						couv = fact(n-curvchen) / (fact(k-column-1)*fact((n-curvchen)-(k-column-1)));
					}
					else if (couv == 0) {
						var rsame = true;
						for (var ecol = 0; ecol < column; ecol++) {
							if (b[rowd][ecol] != b[rowd-1][ecol]) {
								rsame = false;
							}
						}
						if (rsame) {
							curvchen++;
						}
						else {
							curvchen = b[rowd][column-1];
							curvchen++;
						}
						// alert(curvet);
						couv = fact(n-curvchen) / (fact(k-column-1)*(fact(n-curvchen-k+column+1)));
					}
					b[rowd][column] = curvchen;
					couv--;
				}
			}
		}
		
		// for (var column = 0; column < k; column++) {
			// how many times does it run through the numbers?
			// perhaps only does the first two columns. Then a row-thing.
		//}
		
		//printing out the matrix -- convert this format once get it working
		for (var ll = 0; ll < n_choose_k; ll++) {
			for (var pas = 0; pas < k; pas++) {
				form.resultbox.value += ("x_" + b[ll][pas]);
				if (pas < k-1) {
					form.resultbox.value += ("*");
				}
			}
			if (ll < (n_choose_k-1)) {
				form.resultbox.value += (" + ");
			}
		}
	}
}

function fact(num) {
	var facto = num;
	if (facto == 0) { return 1; }
	
	for (var go = 1; go < num; go++) {
		facto *= num - go;
	}
	return facto;
}
