function basis(form) {
	var vSpace = parseInt((form.space.value).match(/\d/));
	var vType = (form.space.value).match(/\D/);
	//alert(vType + ", " + vSpace);
	form.resultbox.value = ("");
	
	var givens = new Array();
	
	if (form.inputbox.value) {
		var init = form.inputbox.value;
		init = init.replace(/\s/g,'');
		var re1 = /\([,0-9]+\)/;
		givens = init.split(/\)\(/g);
		givens[0] = givens[0].replace(/\(/,'');
		givens[givens.length-1] = givens[givens.length-1].replace(/\)/,'');
		if (givens.length > vSpace) {
			alert("Please try again: too many vectors to form a basis!");
			return;
		}
		for (var gg = 0; gg < givens.length; gg++) {
			//alert(givens[gg]);
			givens[gg] = givens[gg].split(/,/g);
			if (givens[gg].length != vSpace) {
				alert("Please try again: improper number of vector coordinates.");
				return;
			}
			for (var ff = 0; ff < givens[gg].length; ff++) {
				//alert(givens[gg][ff]);
				if (isNaN(givens[gg][ff])) {
					alert("Please try again: non-numerical input.");
					return;
				}
			}
		}
		if (!independent(givens, givens.length, vSpace)) {
			alert("Please try again: given vectors not linearly independent.");
			return;
		}
	}
	
	var baseArray = new Array();
	for (var y = 0; y < vSpace; y++) {
		baseArray[y] = new Array();
		if (givens[y]) {
			baseArray[y] = givens[y];
			printV(baseArray[y], vSpace, form);
		}
		else {
			for (var z = 0; z < vSpace; z++) {
				if (vType == "R") {
					baseArray[y][z] = (Math.random() * 10);
				}
				else {
					baseArray[y][z] = Math.floor(Math.random()*201);
					baseArray[y][z] /= (Math.floor(Math.random()*20) + 1);
				}
			}
			if (!independent(baseArray, y+1, vSpace)) {
				y--;
			}
			else {
				printV(baseArray[y], vSpace, form);
			}
		}
	}
}

function printV(vector, size, printTo) {
	//alert("yo");
	printTo.resultbox.value += ("(");
	for (var k = 0; k < size; k++) {
		printTo.resultbox.value += (vector[k]);
		if (k < (size - 1)) {
			printTo.resultbox.value += (", ");
		}
	}
	printTo.resultbox.value += (")\n");
}

function independent(vSet, vNum, vDim) {
	var det;
	var rMatrix = new Array();
	var yMatrix = new Array();
	if (vNum == 1) {
		det = 1;
	}
	else if ((vNum == 2) && (vDim == 2)) {
		det = calcDet(vSet, 0, 2);
	}
	else if ((vNum == 3) && (vDim == 3)) {
		det = calcDet(vSet, 0, 3);
	}
	else if ((vNum == 4) && (vDim == 4)) {
		det = calcDet(vSet, 0, 4);
	}
	else if (vNum == 2) {
		if (vSet[0][0] > vSet[1][0]) {
			rMatrix = vSet[0];
			yMatrix = vSet[1];
		}
		else if (vSet[0][0] == vSet[1][0]) {
			for (var lan = 1; lan < vDim; lan++) {
				if (vSet[0][lan] != vSet[1][lan]) {
					return true;
				}
			}
			return false;
		}
		else {
			rMatrix = vSet[1];
			yMatrix = vSet[0];
		}
		det = (rMatrix[0] / yMatrix[0]);
		for (var laz = 1; laz < vDim; laz++) {
			if ((rMatrix[laz] / yMatrix[laz]) != det) {
				return true;
			}
		}
		return false;
	}
	else {
		//this should only be 3 vectors in 4 dimensions at the moment
		//more else/ifs needed when expand vector space choices, or make code more flexible
		var extraM = new Array();
		for (var fVec = 0; fVec < vNum; fVec++) {
			extraM[0] = vSet[fVec];
			extraM[1] = vSet[(fVec+1)%3];
			extraM[2] = vSet[(fVec+2)%3];
			det = calcDet(extraM, 0,3);
			//alert ("det is " + det);
			if (det != 0) {
				return true;
			}
		}
	}
	
	//alert("determinant is " + det);
	
	if (det == 0) {
		return false;
	}
	else {
		return true;
	}
}

function calcDet(squareM, pos, wid) {
	//only works with 2x2, 3x3 and 4x4 matrices that are continuous
	//(no skipped lines, and no position-shifted 4x4 matrices either)!
	if (wid == 2) {
		return ((squareM[pos][pos]*squareM[pos + 1][pos + 1]) - (squareM[pos][pos + 1]*squareM[pos + 1][pos]));
	}
	else if (wid == 3) {
		var meg = (squareM[pos][pos]*squareM[pos+1][pos+1]*squareM[pos+2][pos+2]);
		meg += (squareM[pos][pos+1]*squareM[pos+1][pos+2]*squareM[pos+2][pos]);
		meg += (squareM[pos][pos+2]*squareM[pos+1][pos]*squareM[pos+2][pos+1]);
		meg -= (squareM[pos][pos]*squareM[pos+1][pos+2]*squareM[pos+2][pos+1]);
		meg -= (squareM[pos][pos+1]*squareM[pos+1][pos]*squareM[pos+2][pos+2]);
		meg -= (squareM[pos][pos+2]*squareM[pos+1][pos+1]*squareM[pos+2][pos]);
		return meg;
	}
	else if (wid == 4) {
		var value;
		var nextM = new Array();
    	value = squareM[0][0]*calcDet(squareM, 1, 3);
    	nextM[0] = squareM[0];
    	nextM[1] = squareM[2];
    	nextM[2] = squareM[3];
    	value -= squareM[1][0]*calcDet(nextM, 0, 3);
    	nextM[1] = squareM[1];
    	value += squareM[1][0]*calcDet(nextM, 0, 3);
    	nextM[2] = squareM[2];
    	value -= squareM[1][0]*calcDet(nextM, 0, 3);
   		return value;
 	}
}

/*function rowForm(matrix, rows, cols) {
  var lead = 0;
  var i;
    for (var r = 0; r < rows; r++) {
        if (cols <= lead) {
            return matrix;
        }
        i = r;
        while (matrix[i][lead] == 0) {
            i = i + 1;
            if (rows == i) {
                i = r;
                lead = lead + 1;
                if (cols == lead) {
                    return matrix;
                }
            }
        }
        if (i != r) {
        	//swap rows i and r
        	var arrayX = new Array();
        	arrayX = matrix[i];
        	matrix[i] = matrix[r];
        	matrix[r] = arrayX;
        }
        Divide row r by M[r, lead]
        for (0 ² i < rows) {
            if (i != r) {
                Subtract M[i, lead] multiplied by row r from row i;
            }
        }
        lead = lead + 1;
    }
}*/
