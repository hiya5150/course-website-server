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
 
to create an announcement form with title & body as post and teacherid as parameter
	localhost/course-website-server/teachers/Announcements/createAnnouncment/1

to delete an announcement teacherid and annid as parameter
	localhost/course-website-server/teachers/Announcements/deleteAnnouncement/1/1

to edit an announcement form with title and body as post and teacherid and annid as parameter
	localhost/course-website-server/teachers/Announcements/editAnnouncement/1/1


ASSIGNMENTS
to view all assignments - 
	localhost/course-website-server/teachers/Assignments/viewAssignments

to create an assignment teacherid as parameter
	form with title, body, duedate, grade
	localhost/course-website-server/teachers/Assignments/createAssignment/1

to delete an assignment teacherid and asnid as parameter
	localhost/course-website-server/teachers/Assignments/deleteAssignment/1/1

to edit an assignment teacherid and asnid as parameter
	form with title, body, duedate and grade
	localhost/course-website-server/teachers/Assignments/editAssignment/1/1


GRADES/SUBMISSIONS
to view one assignment submitted by one student, studentid and asnid as parameter
	localhost/course-website-server/teachers/Grades/viewOneSubmissionOneStudent/1/1

to view all the assignments submitted by one student, studentid as parameter
	localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneStudent/1

to view all students submissions for one assignment, asnid as parameter
	localhost/course-website-server/teachers/Grades/viewAllSubmissionsOneAssignment/1
to add a grade teacherid, studentid, asnid as parameters
	grade form submission
	localhost/course-website-server/teachers/Grades/editGrade/1/1/1


FROM THE STUDENTS PAGE
ASSIGNMENTS/SUBMISSIONS
to view all the assignments
	localhost/course-website-server/students/Assignments/viewAssignments

to view one specific assignment
	localhost/course-website-server/students/Assignments/viewAssignment/1

to submit an assignment teacherid, studentid, asnid as parameters
	submission from form
	localhost/course-website-server/students/Assignments/submitAssignment/1/1/1

GRADES
view all of the students grades and submissions(for which assignment)
	localhost/course-website-server/students/Grades/viewGrades/1

view students submission and grade for one assignment
	localhost/course-website-server/students/Grades/viewGrade/1/1
		

