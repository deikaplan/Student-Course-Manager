<?php
    require_once('database.php');

// get the course form data
$course_id = filter_input(INPUT_POST, 'course_id', FILTER_SANITIZE_STRING);
$course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);

// validate inputs
if ($course_id == null || $course_name == null) {
    $error = "Invalid course data. Try again.";
    include('error.php');
} else {

    // add the course to the database  
    $query = 'INSERT INTO sk_courses (courseID, courseName)
    VALUES (:course_id, :course_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':course_name', $course_name);
    $statement->execute();
    $statement->closeCursor();
   
    // display the course cist page
    include('course_list.php');
}
?>