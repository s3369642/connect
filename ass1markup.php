<!DOCTYPE html>
<html>

<head>
<?php include 'utility.php'; ?>
</head>

<body>

<form id="wineSearch" method="get">

Wine name: <input type="text" id="wineName"><br/>
<br/>
Winery name: <input type="text" id="wineryName"><br/>
<br/>

Region:<br/>
<select form="wineSearch" multiple size="10">
<?php 
printDropDown(
	returnRow("SELECT region_name FROM region;", $dbconn)
);
?>
</select><br/>
<br/>
Grape Variety:<br/>
<select form="wineSearch" multiple size="10">
<?php
printDropDown(
	returnRow("SELECT DISTINCT variety FROM grape_variety order by variety;", $dbconn)
);
?>
</select><br/>  
<br/>
Dating<br/>

From: <select form="wineSearch">
<?php
printDropDown(returnRow("SELECT DISTINCT year FROM wine order by year;", $dbconn));
?>
</select><br/>

To: <select form="wineSearch">
<?php
printDropDown(returnRow("SELECT DISTINCT year FROM wine order by year;", $dbconn));
?>
</select><br/>
<br/>

Number in Stock:<br/>
Min: <input type="number" id="minStock"><br/>
Max: <input type="number" id="maxStock"><br/>
<br/>
Price Range<br/>
Min: <input type="number" id="minPrice"><br/>
Max: <input type="number" id="maxPrice"><br/>
<br/>

<input type="text" id="query">

<input type="button" onclick="submitSearch()">

</form>

</body>

</html>
