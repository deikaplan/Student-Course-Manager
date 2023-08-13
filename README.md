# Student-Course-Manager

This is a student course manager program that utilizes PHP and a SQL database. The user can use index.php to browse courses/students in the database and add/delete courses/students to the database.


**index.php**
This is the main view that allows the user to see a list of courses, select a course, and see the list of students within each course. 

**database.php** 
This file connects to the database with the appropriate credentials in port 3307. 

**courses.sql** 
This is the original SQL database for the courses and students. 

**add_student.php**
This allows the user to fill in the form to add a new student, the form data is added to the database with this php script. 

**delete_student.php**
Deletes a student from the SQL database.

**course_list.php**
This view allows you to see courses currently in the database and to add a course to the database if needed.

**rest.php**
This provides REST APIs in the following format:
● rest.php?format=format_type&action=courses
● rest.php?format=format_type&action=students&course=id
