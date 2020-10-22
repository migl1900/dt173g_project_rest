<?php
/* 
DT173G - Webbutveckling III
Project
Author: Michael Glimmerdahl
Date: 2020-10-18
*/

include("includes/config.php");

// Headers to allow methods and access
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://webicon.se");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With");

// Get method from server request
$method = $_SERVER["REQUEST_METHOD"];

// Check if id is sent
if(isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

// Create instance of Portfolio
$portfolio = new Portfolio();

switch($method) {
    case "GET":
        if(isset($id)) {
            $result = $portfolio->getReference($id);
        } else {
            $result = $portfolio->getAllReferences();
        }

        // Check if result contain values
        if(sizeof($result) > 0) {
            http_response_code(200); // OK
        } else {
            http_response_code(404); // Not found
            $result = array("message" => "No References was found i database");
        }
    break;
    case "POST":
        // Get values from input and set to object
        $data = json_decode(file_get_contents("php://input"));
        $portfolio->header      = $data->header;
        $portfolio->description = $data->description;
        $portfolio->link        = $data->link;
        $portfolio->image       = $data->image;
        $portfolio->alt         = $data->alt;

        if($portfolio->createReference()) {
            http_response_code(201); // Created
            $result = array("message" => "Reference created");
        } else {
            http_response_code(503); // Service Unavailable
            $result = array("message" => "Service is unavailable");
        }
    break;
    case "PUT":
        if(!isset($id)) {
            http_response_code(510); // Not extended
            $result = array("message" => "No id is sent");
        } else {
            // Get values from input and set to object
            $data = json_decode(file_get_contents("php://input"));
            $portfolio->header      = $data->header;
            $portfolio->description = $data->description;
            $portfolio->link        = $data->link;
            $portfolio->image       = $data->image;
            $portfolio->alt         = $data->alt;

            if($portfolio->editReference($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Reference updated");
            } else {
                http_response_code(503); // Service Unavailable
                $result = array("message" => "Service is unavailable");
            }
        }
    break;
    case "DELETE":
        if(!isset($id)) {
            http_response_code(510); // Not extended
            $result = array("message" => "No id is sent");
        } else {
            if($portfolio->deleteReference($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Reference deleted");
            } else {
                http_response_code(503); // Service Unavailable
                $result = array("message" => "Service is unavailable");
            }
        }
    break;
}
// Print result and displaying proper alignment
echo json_encode($result, JSON_PRETTY_PRINT);