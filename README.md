# course-website-server API still needs to be edited
The order of the parameters
1.teacher_id
2.student_id
3.ann_id
4.asn_id

FROM THE TEACHERS PAGE
ANNOUNCEMENTS
to view all the announcements -
	localhost/course-website-server/teachers/Announcements/viewAnnouncements
 
to create an announcement form with title & body as post
	localhost/course-website-server/teachers/Announcements/createAnnouncment

to delete an announcement annid as parameter
	localhost/course-website-server/teachers/Announcements/deleteAnnouncement/1

to edit an announcement form with title and body as post and annid as parameter
	localhost/course-website-server/teachers/Announcements/editAnnouncement/1


ASSIGNMENTS
to view all assignments - 
	localhost/course-website-server/teachers/Assignments/viewAssignments

to create an assignment
	form with title, body, duedate, grade
	localhost/course-website-server/teachers/Assignments/createAssignment

to delete an assignment asnid as parameter
	localhost/course-website-server/teachers/Assignments/deleteAssignment/1

to edit an assignment asnid as parameter
	form with title, body, duedate and grade
	localhost/course-website-server/teachers/Assignments/editAssignment/1


GRADES/SUBMISSIONS
to view one assignment submitted by one student, studentid and asnid as parameter
	localhost/course-website-server/teachers/Grades/viewOneSubmissionOneStudent/1/1

to view all the assignments submitted by one student, studentid as parameter
	localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneStudent/1

to view all students submissions for one assignment, asnid as parameter
	localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneAssignment/1
to add a grade studentid, asnid as parameters
	grade form submission
	localhost/course-website-server/teachers/Grades/editGrade/1/1


FROM THE STUDENTS PAGE
ASSIGNMENTS/SUBMISSIONS
to view all the assignments
	localhost/course-website-server/students/Assignments/viewAssignments

to view one specific assignment asnid as parameter
	localhost/course-website-server/students/Assignments/viewAssignment/1

to submit an assignment teacherid, asnid as parameters
	submission from form
	localhost/course-website-server/students/Assignments/submitAssignment/1/1

GRADES
view all of the students grades and submissions
	localhost/course-website-server/students/Grades/viewGrades

view students submission and grade for one assignment need asnid as parameter
	localhost/course-website-server/students/Grades/viewGrade/1
		

