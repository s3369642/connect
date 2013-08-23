<?php

include 'connect.php';

function returnArray($query, $dbconn){
	$output = [];
	if($result = mysql_query($query, $dbconn)){
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		
		array_push($output, $row);
		}
	return $output;
	}
	else echo "None found";
	}

function returnRow($query, $dbconn){
        $output = [];
        if($result = mysql_query($query, $dbconn)){
        while($row = mysql_fetch_row($result)){
                
                array_push($output, $row);
                }
        return $output;
        }
        else echo "None found";
        }


function printDropDown($result){
	echo "<option value=\"--Select--\" selected>--Select--</option><br/>";
	foreach($result as $resultRow){
		echo "<option value=".$resultRow[0].">".$resultRow[0]."</option><br/>";
		}
	}

function printTable($dbconn){
	$result = returnArray(searchQuery($dbconn), $dbconn);

	if($result != null){
		echo "<table border \"1\">".
		"<tr>".
		"<td>Name</td>".
		"<td>Year</td>".
		"<td>Winery</td>".
		"<td>Variety</td>".
		"<td>Region</td>".
		"<td>In Stock</td>".
		"<td>Cost</td>".
		"</tr>";
		foreach($result as $resultRow){
			echo "<tr>".
				"<td>".$resultRow['wine_name']."</td>".
				"<td>".$resultRow['year']."</td>".
				"<td>".$resultRow['winery_name']."</td>".
				"<td>".$resultRow['variety']."</td>".
				"<td>".$resultRow['region_name']."</td>".
				"<td>".$resultRow['on_hand']."</td>".
				"<td>$".$resultRow['cost']."</td>".
				"</tr>";
		}	
		echo "</table>";
	}
}


function searchQuery($dbconn){
	
	$query = "select DISTINCT * from wine, winery, region, ".
		"inventory, ".
		"wine_variety, grape_variety where ".
		"wine.winery_id = winery.winery_id and ".
		"winery.region_id = region.region_id and ".
		"wine.wine_id = wine_variety.wine_id and ".
		"grape_variety.variety_id = wine_variety.variety_id and ".
		"wine.wine_id = inventory.wine_id and ";	


	$queryInputs = [];

	if(isset($_GET['wineName']) && $_GET['wineName']!=""){	
		array_push($queryInputs, "wine_name = \"".$_GET['wineName']."\"");
		}
	
	if(isset($_GET['wineryName']) && $_GET['wineryName']!=""){   
                array_push($queryInputs, "winery_name = \"".$_GET['wineryName']."\"");
        	}

	 if($_GET['region'] != "--Select--"){
		$allRegions = [];
		foreach($_GET['region'] as $regionOption){
                	array_push($allRegions, "region_name like \"".$regionOption."%\"");
                	}
		$allRegionsText = "(".join($allRegions, " or ").")";
		array_push($queryInputs, $allRegionsText);	
		}	

	if($_GET['grape'] != "--Select--"){
                $allGrapes = [];
                foreach($_GET['grape'] as $grapeOption){
                        array_push($allGrapes, "variety like \"".$grapeOption."%\"");
                        }
                $allGrapesText = "(".join($allGrapes, " or ").")";
                array_push($queryInputs, $allGrapesText);
                }

	if($_GET['from'] != "--Select--"){
                array_push($queryInputs, "year >= ".$_GET['from']);
                }

	if($_GET['to'] != "--Select--"){
                array_push($queryInputs, "year <= ".$_GET['to']);
                }

	 if($_GET['min'] != ""){
		array_push($queryInputs, "on_hand >= ".$_GET['min']);
		}

	if($_GET['max'] != ""){
                array_push($queryInputs, "on_hand <= ".$_GET['max']);
                }


	//Join all queries into a single query

	$query = $query.join($queryInputs, " and ")." order by wine.wine_id;";
	echo $query;
	return $query;
}

?>

<script type="text/javascript">

function validateSubmit(){

var namePatt=/[a-zA-Z0-9]+/;
var numberPatt=/[0-9]+/;
var valid = 1;
var fieldsPopulated = 0;

/*Reset all error messages*/
document.getElementById("wineError").style.display="none";
document.getElementById("wineryError").style.display="none";


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

</script>
