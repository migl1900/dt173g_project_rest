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
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With, Origin");

// Get method from server request
$method = $_SERVER["REQUEST_METHOD"];

// Check if id is sent
if(isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

// Create instance of Education
$education = new Education();

switch($method) {
    case "GET":
        if(isset($id)) {
            $result = $education->getCourse($id);
        } else {
            $result = $education->getAllCourses();
        }
        // Check if result contain values
        if(sizeof($result) > 0) {
            http_response_code(200); // OK
        } else {
            http_response_code(404); // Not found
            $result = array("message" => "No Courses was found i database");
        }
    break;
    case "POST":
        // Get values from input and set to object
        $data = json_decode(file_get_contents("php://input"));
        $education->course      = $data->course;
        $education->year        = $data->year;
        $education->school      = $data->school;
        $education->description = $data->description;

        if($education->createCourse()) {
            http_response_code(201); // Created
            $result = array("message" => "Course created");
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
            $education->course      = $data->course;
            $education->year        = $data->year;
            $education->school      = $data->school;
            $education->description = $data->description;

            if($education->editCourse($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Course updated");
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
            if($education->deleteCourse($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Course deleted");
            } else {
                http_response_code(503); // Service Unavailable
                $result = array("message" => "Service is unavailable");
            }
        }
    break;
}
// Print result and displaying proper alignment
echo json_encode($result, JSON_PRETTY_PRINT);