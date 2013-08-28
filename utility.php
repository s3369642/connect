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


function returnDropDown($result){
	$output = "";
	$output = $output."<option value=\"--Select--\" selected>--Select--</option><br/>";
	foreach($result as $resultRow){
		$output = $output."<option value=".$resultRow[0].">".$resultRow[0]."</option><br/>";
		}
	return $output;
	}

function returnTable($dbconn){
	$output = "";
	$result = returnArray(searchQuery($dbconn), $dbconn);

	if($result != null){
		$output = $output."<table border \"1\">".
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
			$output = $output."<tr>".
				"<td>".$resultRow['wine_name']."</td>".
				"<td>".$resultRow['year']."</td>".
				"<td>".$resultRow['winery_name']."</td>".
				"<td>".$resultRow['variety']."</td>".
				"<td>".$resultRow['region_name']."</td>".
				"<td>".$resultRow['on_hand']."</td>".
				"<td>$".$resultRow['cost']."</td>".
				"</tr>";
		}	
		$output = $output."</table>";
	}
	return $output;
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
		array_push($queryInputs, "region_name like \"".$_GET['region']."%\"");
		}	

	if($_GET['grape'] != "--Select--"){
                array_push($queryInputs, "variety like \"".$_GET['grape']."%\"");
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
	//echo $query;
	return $query;
}

?>
