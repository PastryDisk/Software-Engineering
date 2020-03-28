CREATE DEFINER=`admin`@`%` PROCEDURE `createCourse`(coursecrn int, courseid VARCHAR(7),coursename VARCHAR(45), coursestart1 DATETIME, courseweeks int, courselocation int, courseprof int)
BEGIN
	INSERT INTO COURSE
	VALUES (coursecrn, coursename, courseid, courseprof, courselocation);
    
    CALL attendanceLoop(coursecrn, coursestart1, courseweeks);

END