CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Friendship_Solicitations_AFTER_UPDATE` AFTER UPDATE ON `Friendship_Solicitations` FOR EACH ROW
BEGIN
 
DECLARE accepted int;
DECLARE user1 int;
DECLARE user2 int;
 
SELECT Friendship_Solicitations.friendship_solicitations_status FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
LIMIT 1 INTO accepted;


SELECT Friendship_Solicitations.Users_users_id_send FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
ORDER BY Friendship_Solicitations.friendship_solicitations_timestamp DESC
LIMIT 1 INTO user1;


SELECT Friendship_Solicitations.Users_users_id_receive FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
ORDER BY Friendship_Solicitations.friendship_solicitations_timestamp DESC
LIMIT 1 INTO user2;
 
IF accepted = 1 THEN
INSERT INTO Friends (Users_users_id_user,Users_users_id_user1) VALUES(user1,user2),(user2,user1);
END IF;
END