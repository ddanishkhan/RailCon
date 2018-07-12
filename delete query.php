CREATE EVENT clearoldrecords
    ON SCHEDULE EVERY 1 DAY
    DO 
	DELETE FROM student WHERE datetodelete < (NOW() - INTERVAL 1 DAY);