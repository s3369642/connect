<!DOCTYPE html>
<html>

<head>
<script src="javascript.js"></script>
</head>

<body>
<p><span id="noValuesError" style="color:red; display:none">Please enter one or more field values</span></p>

<table>

<tr>

<td>
<form id="wineSearch" method="get" action="${formAction}">

<!-- $BeginBlock form -->
Wine Name: 
<input type="text" id="wineName" name="wineName">
<div id="wineError" style="color:red; display:none">Invalid Entry</div>
<br/>
<br/>
Winery Name: <input type="text" id="wineryName" name="wineryName">
<div id="wineryError" style="color:red; display:none">Invalid Entry</div>
<br/>
<br/>

Region: <br/>
<select form="wineSearch" multiple size="10" id = "region" name="region">
${regionSelect}
</select>
<br/>
<br/>

Grape: <br/>
<select form="wineSearch" multiple size="10" id="grape" name="grape">
${grapeSelect}
</select>
<br/>  
<br/>

Dating...<br/>

From: <select form="wineSearch" id="from" name="from">
${fromSelect}
</select>
<br/>

To: <select form="wineSearch" id="to" name="to">
${toSelect}
</select>
<div id="fromToError" style="color:red; display:none">Your 'To' selection must be after your 'From' selection</div>
<br/>
<br/>

Number in Stock<br/>
Minimum: <input type="number" id="minStock">
<div id="minStockError" style="color:red; display:none">Invalid number</div>
<br/>
Maximum: <input type="number" id="maxStock">
<div id="maxStockError" style="color:red; display:none">Invalid number</div>
<br/>
<div id="minMaxStockError" style="color:red; display:none">Your minimum cannot be greater than your maximum</div>
<br/>
Price Range<br/>
Minimum<input type="number" id="minPrice" name="min">
<div id="minPriceError" style="color:red; display:none">Invalid number</div>
<br/>
Maximum<input type="number" id="maxPrice" name="max">
<div id="maxPriceError" style="color:red; display:none">Invalid number</div>
<br/>
<div id="minMaxPriceError" style="color:red; display:none">Your minimum cannot be greater than your maximum</div>

<!-- flag used to tell if the form is submitted-->
<input type='hidden' id="submitted" name='submitted' value="0" />
<br/>
<input type="button" value="Search" onclick="validateSubmit();">

<!-- $EndBlock form -->

</form>
</td>

<td>
<!-- $BeginBlock results -->
${searchResults}
<!-- $EndBlock results -->
</td>

</tr>
</table>
</body>

</html>
