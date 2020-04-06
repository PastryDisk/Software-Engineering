CREATE DEFINER=`admin`@`%` PROCEDURE `modifyClass`(crn int, coursename varchar(45), coursecode varchar(7), courselocation int)
BEGIN
UPDATE COURSE SET COURSE_NAME=coursename, COURSE_CODE=coursecode, LOCATION_ID=courselocation
WHERE COURSE_CRN=crn;
END