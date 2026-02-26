<?php

require_once "models/ad_model.php"; //uporabimo model Ad iz MVC
require_once "controllers/ad_controller.php"; //vključimo API controller

$ad_controller = new ad_controller;

//nastavimo glave odgovora tako, da brskalniku sporočimo, da mu vračamo json
header('Content-Type: application/json');
//omgočimo zahtevo iz različnih domen
header("Access-Control-Allow-Origin: *");
// Kot odgovor iz API-ja izpišemo JSON string s pomočjo funkcije json_encode

// preberemo HTTP metodo iz zahteve
$method = $_SERVER['REQUEST_METHOD'];

// Razberemo parametre iz URL - razbijemo URL po '/'
// tako dobimo iz zahteve api/first/second/third => $request = array("first", "second", "third")
/*if(isset($_SERVER['PATH_INFO']))
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
else
	$request="";
*/
// Najprej potrebujemo 'router', ki bo razpoznal zahtevo in sprožil ustrezne akcije
// Preverimo, če je v url-ju prva pot 'ads'
/*if(!isset($request[0]) || $request[0] != "ads"){
    echo json_encode((object)["status"=>"404", "message"=>"Not found"]);
    die();
}*/
// Odvisno od metode pokličemo ustrezen controller action
switch($method){
    case "GET":
        // Če je v zahtevi nastavljen :id, kličemo akcijo show (en oglas), sicer pa index (vsi oglasi)
        $ad_controller->index();
        break;
    default: 
        break;
}