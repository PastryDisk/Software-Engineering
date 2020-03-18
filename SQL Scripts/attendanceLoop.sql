DELIMITER $$

CREATE PROCEDURE attendanceLoop()
BEGIN
	DECLARE x INT;
    DECLARE y DATETIME;
    SET x = 1;
    SET y = startdate;
    
    loop_label: LOOP
		IF x > weeks THEN
			LEAVE loop_label;
		ELSE
			INSERT INTO ATTENDANCE (COURSE_CRN, ATTENDANCE_DATETIME) VALUES (CRN, y);
            SET x = x + 1;
            SET y = DATE_ADD(y, INTERVAL 1 WEEK);
		END IF;
	END LOOP;
END $$

DELIMITER ;