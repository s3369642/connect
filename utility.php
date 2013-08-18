<?php

$basePath = dirname(__FILE__);
include ($basePath."/connect/connect.php");;

function returnRow($query, $dbconn){
	$output = [];
	$result = mysql_query($query, $dbconn);
	while($row = mysql_fetch_row($result)){
		array_push($output, $row);
		}
	return $output;
	}

function printDropDown($result){
	echo "<option value=\"--Select--\" selected>--Select--</option><br/>";
	foreach($result as $resultRow){
		echo "<option value=\"$resultRow[0]\">$resultRow[0]</option><br/>";
		}
	}

?>

<script type="text/javascript">

function submitSearch(){
	var query = "select * from wine where ";
	//boolean to make sure that at least one field has a value
	var nonBlankField = 0;
	var queryEntries = new Array();

//Sweep through fields and construct overall query to submit

var wine = document.getElementById("wineName").value;
if(wine != ""){
	queryEntries.push("wine_name = " + wine);
	}

query = query + queryEntries.join(" and ") + ";";

document.getElementById("query").value = query;



}

function compileQuery(){
	
	}

</script>
