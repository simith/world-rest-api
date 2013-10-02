<?php

 require_once  dirname(__FILE__).'/../database/DatabaseManager.php';
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */



$app->get('/World/Countries', function () {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->find(array(), array("_id" => 0)); 
  $tempArr = iterator_to_array($cursor,false);

  $conn->close();
  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Countries/:countryname', function ($countryname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->findOne(array("name" => $countryname), array("_id" => 0)); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Countries/:countryname/Currency', function ($countryname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->findOne(array("name" => $countryname), array("_id" => 0,"currency" => 1)); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Countries/:countryname/CallingCode', function ($countryname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->findOne(array("name" => $countryname), array("_id" => 0,"calling-code" => 1)); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Countries/:countryname/Tld', function ($countryname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->findOne(array("name" => $countryname), array("_id" => 0,"tld" => 1)); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Regions/', function () {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $db->command(array("distinct" => "trialcountries","key" => "region")); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr['values']);

});

$app->get('/World/Regions/:regionname/SubRegions', function ($regionname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $db->command(array("distinct" => "trialcountries","key" => "subregion", "query" => array("region" => $regionname))); 
  $tempArr = $cursor;

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr['values']);

});

$app->get('/World/Regions/:regionname/Countries', function ($regionname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->find(array("region" => $regionname), array("name" => 1,"_id" => 0)); 
  $tempArr = iterator_to_array($cursor,false);

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});

$app->get('/World/Regions/:regionname/:subregionname/Countries', function ($regionname,$subregionname) {

  $dbMgr = new DatabaseManager(); $conn= $dbMgr->getConnection();
  $db = $conn->world;
  $countries = $db->trialcountries; 
  
  $cursor = $countries->find(array("region" => $regionname,"subregion" => $subregionname), array("name" => 1,"_id" => 0)); 
  $tempArr = iterator_to_array($cursor,false);

  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($tempArr);

});


$app->run();

?>
