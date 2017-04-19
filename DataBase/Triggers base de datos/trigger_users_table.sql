CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Users_AFTER_INSERT` AFTER INSERT ON `Users` FOR EACH ROW

BEGIN

DECLARE userId int;

SELECT Users.users_id_user FROM Users ORDER BY Users.users_id_user DESC LIMIT 1 INTO userId;

INSERT INTO Libraries (Users_users_id_user) VALUES (userId);
INSERT INTO Walls (Users_users_id_user) VALUES (userId);
END