<?php
require_once('database.php');

// Delete the student from the database

// get studentID from the POST data
$studentID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// validate input
if ($studentID == null || $studentID == false) {
    $error = "Invalid student ID.";
    include('error.php');
    exit();
}

// delete the student from sk_students 
$query = 'DELETE FROM sk_students WHERE studentID = :studentID';
$statement = $db->prepare($query);
$statement->bindValue(':studentID', $studentID);
$statement->execute();
$statement->closeCursor();

// Display the Home page
include('index.php');