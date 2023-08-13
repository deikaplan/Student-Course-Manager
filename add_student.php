<?php
    
require_once('database.php');

// get the student form data
$course_id = filter_input(INPUT_POST, 'course_id', FILTER_SANITIZE_STRING);
$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// validate inputs
if ($course_id == null || $first_name == null || $last_name == null || $email == null || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid student data. Try again.";
    include('error.php');
    exit();
}

// add the student to database  
$query = 'INSERT INTO sk_students (courseID, firstName, lastName, email) VALUES (:course_id, :first_name, :last_name, :email)';
$statement = $db->prepare($query);
$statement->bindValue(':course_id', $course_id);
$statement->bindValue(':first_name', $first_name);
$statement->bindValue(':last_name', $last_name);
$statement->bindValue(':email', $email);
$statement->execute();
$statement->closeCursor();


// display the Student List page
include('index.php');

?>