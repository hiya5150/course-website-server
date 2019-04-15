the order of the parameters are:
1.teacher_id 
2.student_id 
3. ann_id 
4. ass_id

MAIN FUNCTIONS

HOME
1. view all announcements
localhost/course-website-server/main/Home/loadAnnouncements

2. verify teacher
localhost/course-website-server/main/Home/verifyTeacherToken

3. verify student
localhost/course-website-server/main/Home/verifyStudentToken


LOGIN
1. teacher login takes $_POST['username'], and $_POST['password']
localhost/course-website-server/main/Login/teacherLogin

2. student login takes $_POST['username'], and $_POST['password']
localhost/course-website-server/main/Login/studentLogin


REGISTER
1. teacher register takes  $_POST['name'], $_POST['username'], and $_POST['password']
localhost/course-website-server/main/Register/teacherRegister

2. student register takes  $_POST['name'], $_POST['username'], and $_POST['password']
localhost/course-website-server/main/Register/studentRegister

TEACHERS FUNCTIONS

ANNOUNCEMENTS: (need to be logged in as a teacher, only the teacher who created the announcement can edit and delete it)

1. view all announcements
localhost/course-website-server/teachers/Announcements/viewAnnouncements

2. view teacher who is logged ins announcements
localhost/course-website-server/teachers/Announcements/viewPrivateAnnouncements

3. create an announcement. will automatically take the id of the teacher who is logged in and will take the input info from $_POST['annTitle'] and $_POST['annBody']
localhost/course-website-server/teachers/Announcements/createAnnouncement

4. delete an announcement. will check that it is the same teacher on its own, and it needs the annID as a parameter to know which announcement to delete
localhost/course-website-server/teachers/Announcements/deleteAnnouncement/:annID

5. edit an announcement.  will check that it is the same teacher on its own, and it needs the annID as a parameter to know which announcement to edit, and will take the edited info in the form of post information $_POST['title'] and $_POST['body']
localhost/course-website-server/teachers/Announcements/editAnnouncement/:annID


ASSIGNMENTS: (need to be logged in as a teacher, only the teacher who created the assignment can edit and delete it)

1. get back all assignments
localhost/course-website-server/teachers/Assignments/viewAssignments

2. get back teacher who is logged ins Assignments
localhost/course-website-server/teachers/Assignments/viewPrivateAssignments

3. get back one assignment,  will take in the asnID as a parameter to know which assignment to get back
localhost/course-website-server/teachers/Assignments/viewOneAssignment/asnID

4. create an assignment. will automatically take the id of the teacher who is logged in and will take the input info from $_POST['asnTitle'], $_POST['asnBody'], $_POST['asnDueDate'] and $_POST['asnGrade']
localhost/course-website-server/teachers/Assignments/createAssignment

5. delete an assignment. will check that it is the same teacher on its own, and it needs the asnID as a parameter to know which assignment to delete
localhost/course-website-server/teachers/Assignments/deleteAssignment/:asnID

6. edit an assignment.  will check that it is the same teacher on its own, and it needs the asnID as a parameter to know which announcement to edit, and will take the edited info in the form of post information $_POST['asnTitle'], $_POST['asnBody'], $_POST['asnDueDate'] and $_POST['asnGrade']
localhost/course-website-server/teachers/Assignments/editAssignment/asnID


GRADES: (need to be logged in as a teacher, only the teacher who created the assignment can view the submissions and edit and delete the grades)

1. to view one submission from one student. need studentid and assignmentid as parameters
localhost/course-website-server/teachers/Grades/viewOneSubmissionOneStudent/:studentID/:asnID

2. to view all submissions from one student. need studentid as parameter
localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneStudent/:studentID

3. to view all submissions for one assignment. need assignmentid as parameter
localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneAssignment/:asnID

4. number of students who submitted one assignment. need assignmentid as parameter
localhost/course-website-server/teachers/Grades/rowCount/:asnID

5. add or edit a students grade for one submission, need studentid and assignmentid as parameters, and the grade as post info $_POST['grade']
localhost/course-website-server/teachers/Grades/editGrade/:studentID/:asnID


STUDENT FUNCTIONS

ANNOUNCEMENTS
1. view all announcements
localhost/course-website-server/students/Announcements/loadAnnouncements


ASSIGNMENTS
1. submit an assignment, needs teacherid and asnid as parameters and the submission as $_POST['submission']
localhost/course-website-server/students/Assignments/submitAssignment/:teacherID/:asnID

2. get back all assignments
localhost/course-website-server/students/Assignments/viewAssignments

3. get back one assignment, need asnid as parameter
localhost/course-website-server/students/Assignments/viewOneAssignment/:asnID


GRADES
1. view grades
localhost/course-website-server/students/Grades/viewGrades

2. view one grade for specific assignment use assignmentid as parameter
localhost/course-website-server/students/Grades/viewGrade/:asnID
