<?php 

require_once ("MiniTemplator.class.php");
include('utility.php');

$t = new MiniTemplator;

$t->readTemplateFromFile ("ass1markup.php");

//FORM block
$formAction = $_SERVER['PHP_SELF'];
$t->setVariable("formAction", $formAction);

//Drop-down lists
$regionQuery = returnDropDown(returnRow("select DISTINCT region_name
	from region order by region_name;", $dbconn));
$t->setVariable ("regionSelect", $regionQuery);

$grapeQuery = returnDropDown(returnRow("select DISTINCT variety
        from grape_variety order by variety;", $dbconn));
$t->setVariable ("grapeSelect", $grapeQuery);

$yearQuery = returnDropDown(returnRow("select DISTINCT year
        from wine order by year;", $dbconn));
$t->setVariable ("fromSelect", $yearQuery);
$t->setVariable ("toSelect", $yearQuery);

$t->addBlock ("form");


//Search result
if(isset($_GET['submitted']) && $_GET['submitted']==1){
	$searchResults = returnTable($dbconn);
	$t->setVariable("searchResults", $searchResults);
	}

$t->addBlock ("results");

$t->generateOutput(); 

?>