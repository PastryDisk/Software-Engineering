CREATE DEFINER=`admin`@`%` PROCEDURE `createCourse2`(coursecrn int, courseid VARCHAR(7),coursename VARCHAR(45), coursestart1 DATETIME, coursestart2 DATETIME, courseweeks int, courselocation int, courseprof int)
BEGIN
	INSERT INTO COURSE
	VALUES (coursecrn, coursename, courseid, courseprof, courselocation);
    
    CALL attendanceLoop(coursecrn, coursestart1, courseweeks);
    CALL attendanceLoop(coursecrn, coursestart2, courseweeks);
END