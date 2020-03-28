CREATE DEFINER=`admin`@`%` PROCEDURE `registerForCourse`(stuid int, coursecrn int)
BEGIN
DECLARE finished int DEFAULT 0;
DECLARE val int;
DECLARE curs CURSOR FOR SELECT ATTENDANCE_ID FROM ATTENDANCE WHERE COURSE_CRN = coursecrn;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

SET val = 0;

OPEN curs;

INSERT INTO ENROLLMENT VALUES (stuid, coursecrn);

loop_label: LOOP
	FETCH curs INTO val;
    IF finished = 1 THEN
		LEAVE loop_label;
	END IF; 
    INSERT INTO ATTENDANCE_RECORD VALUES (stuid, val, coursecrn, 0); 
END LOOP; 

CLOSE curs; 
END