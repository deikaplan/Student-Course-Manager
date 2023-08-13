<?php
    require_once('database.php');

    // get selected course ID or default to the first course
    $selected_courseID = filter_input(INPUT_GET, 'courseID', FILTER_SANITIZE_STRING);
    if (empty($selected_courseID)) {
        // get first course ID
        $query = 'SELECT courseID FROM sk_courses LIMIT 1';
        $statement = $db->prepare($query);
        $statement->execute();
        $first_course = $statement->fetch();
        $selected_courseID = $first_course['courseID'];
        $statement->closeCursor();
    }

    // get all courses
    $query = 'SELECT * FROM sk_courses';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();

    // get selected course
    $query = 'SELECT * FROM sk_courses WHERE courseID = :courseID';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $selected_courseID);
    $statement->execute();
    $selectedCourse = $statement->fetch();
    $statement->closeCursor();

    // get students for the selected course
    $query = 'SELECT * FROM sk_students WHERE courseID = :courseID';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $selected_courseID);
    $statement->execute();
    $students = $statement->fetchAll();
    $statement->closeCursor();
?>


<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<main>
    <center><h1>Student List</h1></center>
    <center><h2><?php echo $selectedCourse['courseID'] . ' - ' . $selectedCourse['courseName']; ?></h2></center>

    <aside>
        <!-- display a list of categories -->
        <h2>Courses</h2>
        <nav>
        <ul>
        <!-- loops through courses to list them each as a link -->
        <?php foreach ($courses as $course) : ?>
                    <li>
                        <a href="index.php?courseID=<?php echo $course['courseID']; ?>">
                            <?php echo $course['courseID']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of Students -->
        
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
            <!-- loops through students for the selected course and lists them -->
            <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?php echo $student['firstName']; ?></td>
                        <td><?php echo $student['lastName']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><a href="delete_student.php?id=<?php echo $student['studentID']; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>

            
        </table>

        <p><a href="add_student_form.php">Add Student</a></p>

        <p><a href="course_list.php">List Courses</a></p>    

    </section>
</main>

<footer>
    <p>&copy; <?php 
    require_once('database.php');
    echo date("Y"); ?> Suresh Kalathur</p></footer>
</body>
</html>