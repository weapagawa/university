SELECT Id, InspectionDate, SatisfactoryCondition, CONCAT( Fname, ' ', Lname ) AS Name, placeNumber
FROM Inspection i, ResidenceStaff r
WHERE i.residenceStaffNo = r.staffNo

SELECT title, yearC, name, email
FROM Course c, Instructor i
WHERE c.instructorID = i.id
ORDER BY yearC ASC

-- Consultas Para University Accomodation

-- a) Present a report listing the manager’s name en telephone number for each hall of residence.
select phone, CONCAT(fname,' ', lname) as Manager 
from ResidenceHall r, ResidenceStaff s 
where r.residenceStaffNo = s.staffNo and s.position = 'Hall Manager'

-- b) Present a report listing the names and banner numbers of students with the details of their lease agreements.
SELECT fname, lname, s.studentID, LeaseNumber, StartDate, EndDate, Duration, placeNumber
FROM Student s, Lease l
WHERE s.studentID = l.StudentId

-- c) Display the details of lease agreements that include the summer semester.
SELECT * 
FROM Lease
WHERE Duration = '12'
-- modificado
SELECT StartDate, EndDate, FName, LName
FROM Lease l, Student s
WHERE l.Duration = '12'
AND l.studentid = s.studentID

-- d) Display the details of total rent paid by a given student.
SELECT fname, lname, studentID
FROM Student
--query dentro del estudiante
SELECT paymentDue, paymentDate, paymentMethod, s.studentID
FROM Invoice i, Lease l, Student s
WHERE i.leaseNumber = l.LeaseNumber
AND l.studentID = s.studentID
AND paymentDate IS NOT NULL

-- query en php
$query = "SELECT paymentDue, paymentDate, paymentMethod FROM Invoice i, Lease l WHERE i.leaseNumber = l.LeaseNumber
				AND l.studentID = ".$id ." AND paymentDate IS NOT NULL";
-- e) Present a report on students who have not paid their invoices by a given date.
SELECT paymentDue, paymentDate, paymentMethod, FName, LName
FROM Invoice i, Lease l, Student s
WHERE i.leaseNumber = l.LeaseNumber
AND l.studentID = s.studentID
AND paymentDate IS NULL
GROUP BY FName, LName

-- f) Display the details of apartment inspections where the property was found to be in an unsatisfactory condition.
SELECT InspectionDate, Comments, r.placeNumber, roomNumber
FROM Inspection i, Room r
WHERE SatisfactoryCondition = 'No' AND r.placeNumber = i.placeNumber

-- g) Present a report of the names and banner numbers of the students with their room numbers and place numbers in a particular hall of
-- residence.
SELECT fname, lname, s.studentID, r.roomNumber, r.placeNumber, h.id as hallNumber
FROM Lease l, Student s, Room r, ResidenceHall h
WHERE l.studentID = s.studentID AND l.placeNumber = r.placeNumber AND r.residenceID = h.id 

-- h) Present a report listing the details of all students currently on the waiting list for accommodation; that is; who were not placed.
SELECT fname, lname, email, category, major, minor
FROM Student
WHERE STATUS = 'waiting'
-- i) Display the total number of students in each student category.
select count(*) as under from Student where category = 'undergraduate'
select count(*) as grad from Student where category = 'graduate'


