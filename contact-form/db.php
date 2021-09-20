<?php

// connect to db
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "contact_form_data";


// create connection
$conn = new mysqli( $servername, $username, $password, $dbname );

// check connection
if ( $conn->connect_error ) {
    die( "Connection failed: " . $conn->connect_error );
}


// send ajax response 
function send_response( $message, $status_code) {

    //create response for ajax
    $response = array( 'message' => $message, 'status_code' => $status_code );

    echo json_encode($response);
    exit();
}


$first_name = filter_var($_GET['first_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$last_name = filter_var($_GET['last_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$email = filter_var($_GET['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$website = filter_var($_GET['website'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$message = filter_var($_GET['message'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


// Capture data and put into db
$form_sql = "INSERT INTO contact_form (first_name, last_name, email, website, message) VALUES ( ?,?,?,?,? )";

$stmt = $conn->prepare($form_sql);
$stmt->bind_param("sssss", $first_name, $last_name, $email, $website, $message);
$stmt->execute();


send_response("Worked?", 200);



$conn->close();

?>
