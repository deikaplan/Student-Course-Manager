<?php
    header('Content-Type: application/json');

    require_once('database.php');

    $format = filter_input(INPUT_GET, 'format', FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

    // REST JSON format
    if ($format === 'JSON') {
        // if action is 'courses', fetch all courses
        if ($action === 'courses') {
            $query = 'SELECT * FROM sk_courses';
            $statement = $db->prepare($query);
            $statement->execute();
            $courses = $statement->fetchAll();
            $statement->closeCursor();

    
            echo json_encode($courses);

        // if action is 'students', fetch all students from the provided courseID
        } elseif ($action === 'students') {
            $courseID = filter_input(INPUT_GET, 'course', FILTER_SANITIZE_STRING);

            // checks for course ID in get request, otherwise 'error' below will be thrown
            if (!empty($courseID)) {
                $query = 'SELECT * FROM sk_students WHERE courseID = :courseID';
                $statement = $db->prepare($query);
                $statement->bindValue(':courseID', $courseID);
                $statement->execute();
                $students = $statement->fetchAll();
                $statement->closeCursor();

                echo json_encode($students);
            // error message if action is 'students' but no course ID provided
            } else {
                echo json_encode(['error' => 'No course ID provided']);
            }
        } else {
            echo json_encode(['error' => 'Invalid action']);
        }
    } else {
        echo json_encode(['error' => 'Invalid format']);
    }
?>
