function validateSubmit(){

var namePatt=/[a-zA-Z0-9]+/;
var numberPatt=/[0-9]+/;
var valid = 1;
var fieldsPopulated = 0;

/*Reset all error messages*/
document.getElementById("wineryError").style.display="none";
document.getElementById("minStockError").style.display="none";
document.getElementById("maxStockError").style.display="none";
document.getElementById("minPriceError").style.display="none";
document.getElementById("maxPriceError").style.display="none";
document.getElementById("wineError").style.display="none";

var wineNameJs = document.getElementById("wineName").value;

if(wineNameJs.length > 0){
        fieldsPopulated = 1;
        if(!namePatt.test(wineNameJs)){
                document.getElementById("wineError").style.display="inline";
                valid = 0;
                }
        }

var wineryNameJs = document.getElementById("wineryName").value;
if(wineryNameJs.length > 0){
        fieldsPopulated = 1;
        if(!namePatt.test(wineryNameJs)){
                 document.getElementById("wineryError").style.display="inline";
                 valid = 0;
                }
	}

var regionJs = document.getElementById("region");
var regionSelectJs = regionJs.options[regionJs.selectedIndex].text;
if(regionSelectJs != "--Select--"){
        fieldsPopulated = 1;
        }

var grapeJs = document.getElementById("grape");
var grapeSelectJs = grapeJs.options[grapeJs.selectedIndex].text;
if(grapeSelectJs != "--Select--"){
        fieldsPopulated = 1;
        }

var fromJs = document.getElementById("from");
var fromSelectJs = fromJs.options[fromJs.selectedIndex].text;
if(fromSelectJs != "--Select--"){
        fieldsPopulated = 1;
        }

var toJs = document.getElementById("to");
var toSelectJs = toJs.options[toJs.selectedIndex].text;
if(toSelectJs != "--Select--"){
        fieldsPopulated = 1;
        }

var minStockJs = document.getElementById("minStock").value;
if(minStockJs.length > 0){
        fieldsPopulated = 1;
        if(!numberPatt.test(minStockJs)){
                document.getElementById("minStockError").style.display="inline";
                valid = 0;
                }
        }

var maxStockJs = document.getElementById("maxStock").value;
if(maxStockJs.length > 0){
        fieldsPopulated = 1;
        if(!numberPatt.test(maxStockJs)){
                document.getElementById("maxStockError").style.display="inline";
                valid = 0;
                }
        }

var minPriceJs = document.getElementById("minPrice").value;
if(minPriceJs.length > 0){
        fieldsPopulated = 1;
        if(!numberPatt.test(minPriceJs)){
                document.getElementById("minPriceError").style.display="inline";
                valid = 0;
                }
        }

var maxPriceJs = document.getElementById("maxPrice").value;
if(maxPriceJs.length > 0){
        fieldsPopulated = 1;
        if(!numberPatt.test(maxPriceJs)){
                document.getElementById("maxPriceError").style.display="inline";
                valid = 0;
                }
        }
 

if(fieldsPopulated == 1){
        
        if(valid == 1){
                document.getElementById("submitted").value = "1";
                document.getElementById("wineSearch").submit();
                }

        }
        else{ 
                document.getElementById("noValuesError").style.display="inline";
                }


}
