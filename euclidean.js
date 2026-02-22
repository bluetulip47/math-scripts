function euclid(form) {
	var numOne = parseInt(form.inputbox1.value);
	var numTwo = parseInt(form.inputbox2.value);
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

	form.resultbox.value = "";

	if (numOne > numTwo) {
		newb = takestep(numOne, numTwo);
		elder = numTwo;
		form.resultbox.value = numOne + " = " + Math.floor(numOne / numTwo) + "(";
	} else {
		newb = takestep(numTwo, numOne);
		elder = numOne;
		form.resultbox.value = numTwo + " = " + Math.floor(numTwo / numOne) + "(";
	}

	//alert("The result of one step is " + elder + " and " + newb + ".");
	form.resultbox.value += (elder + ") + " + newb + "\n");
	
	while (newb != 0) {
		holdEm = newb;
		newb = takestep(elder, newb);
		if (newb != 0) {
			form.resultbox.value += (elder + " = " + Math.floor(elder / holdEm) + "(" + holdEm + ") + " + newb + "\n");
		}
		elder = holdEm;
		//alert("The result of the next step is " + elder + " and " + newb + ".");
	}
	//alert("The gcd of " + numOne + " and " + numTwo + " is " + elder);
	form.resultbox.value += ("\nThe gcd of " + numOne + " and " + numTwo + " is " + elder + ".");
}

function takestep(uno, dos) {
	var q = Math.floor(uno / dos);
	var r = (uno - (dos*q));
	//alert(r);
	//var line = uno + " = " + q + "(" + dos + ") + " + r + "\n";
	//form.resultbox.value += uno.toString();
	return r;
}
