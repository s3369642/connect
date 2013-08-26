<!DOCTYPE html>
<html>

<head>
<?php include 'utility.php'; ?>
<script src="javascript.js"></script>
</head>

<body>
<p><span id="noValuesError" style="color:red; display:none">Please enter one or more field values</span></p>

<table>

<tr>

<td>
<form id="wineSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

Wine name: <input type="text" id="wineName" name="wineName">
<div id="wineError" style="color:red; display:none">Invalid Entry</div>
<br/>
<br/>
Winery name: <input type="text" id="wineryName" name="wineryName">
<div id="wineryError" style="color:red; display:none">Invalid Entry</div>
<br/>
<br/>

Region:<br/>
<select form="wineSearch" multiple size="10" id = "region" name="region">
<?php 
printDropDown(
	returnRow("SELECT region_name FROM region;", $dbconn)
);
?>
</select>
<br/>
<br/>

Grape Variety:<br/>
<select form="wineSearch" multiple size="10" id="grape" name="grape">
<?php
printDropDown(
	returnRow("SELECT DISTINCT variety FROM grape_variety order by variety;", $dbconn)
);
?>
</select>
<br/>  
<br/>

Dating<br/>

From: <select form="wineSearch" id="from" name="from">
<?php
printDropDown(returnRow("SELECT DISTINCT year FROM wine order by year;", $dbconn));
?>
</select>
<br/>

To: <select form="wineSearch" id="to" name="to">
<?php
printDropDown(returnRow("SELECT DISTINCT year FROM wine order by year;", $dbconn));
?>
</select>
<div id="fromToError" style="color:red; display:none">Your 'To' selection must be after your 'From' selection</div>
<br/>
<br/>

Number in Stock:<br/>
Min: <input type="number" id="minStock">
<div id="minStockError" style="color:red; display:none">Invalid number</div>
<br/>
Max: <input type="number" id="maxStock">
<div id="maxStockError" style="color:red; display:none">Invalid number</div>
<br/>
<div id="minMaxStockError" style="color:red; display:none">Your minimum cannot be greater than your maximum</div>
<br/>
Price Range<br/>
Min: <input type="number" id="minPrice" name="min">
<div id="minPriceError" style="color:red; display:none">Invalid number</div>
<br/>
Max: <input type="number" id="maxPrice" name="max">
<div id="maxPriceError" style="color:red; display:none">Invalid number</div>
<br/>
<div id="minMaxPriceError" style="color:red; display:none">Your minimum cannot be greater than your maximum</div>

<!-- flag used to tell if the form is submitted-->
<input type='hidden' id="submitted" name='submitted' value="0" />
<br/>
<input type="button" value="Search" onclick="validateSubmit();">

</form>
</td>

<td>
<?php
if(isset($_GET['submitted']) && $_GET['submitted']=="1"){
	printTable($dbconn);
	}
?>
</td>

</tr>
</table>
</body>

</html>
