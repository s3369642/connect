<?php
require_once ("MiniTemplator.class.php"); 
include('utility.php'); $t = new MiniTemplator; 

$t->readTemplateFromFile ("ass1markup.php"); 

formAction = $_SERVER['PHP_SELF']; 
$t->setVariable("formAction", $formAction); 

//FORM block 

//Drop-down lists 

$regionQuery = returnDropDown(returnArray(
  "select DISTINCT region_name from region order by region_name;", $dbconn)); 
$t->setVariable ("regionSelect", $regionQuery); 

$grapeQuery = returnDropDown(returnArray("select DISTINCT variety from grape_variety order by variety;", $dbconn)); 
$t->setVariable ("grapeSelect", $grapeQuery);

$yearQuery = returnDropDown(returnArray("select DISTINCT year from wine order by year;", $dbconn)); 
$t->setVariable ("fromSelect", $yearQuery); 
$t->setVariable ("toSelect", $yearQuery); 

$t->addBlock ("form"); 

//Search result 
if(isset($_GET['submitted']) && $_GET['submitted']==1){ $searchResults = returnTable($dbconn); 
  $t->setVariable("searchResults", $searchResults); } 

$t->addBlock ("results"); 


//Session variable - needs to be returned AFTER the query has been done 

if(isset($_SESSION['wines'])){ $wineDisplay = $_SESSION['wines']. " wines have been viewed in this session."; } 
  else{$wineDisplay = "Session not started yet";} 
$t->setVariable("wineDisplay", $wineDisplay); 

$t->addBlock("session");

$t->generateOutput(); ?>
