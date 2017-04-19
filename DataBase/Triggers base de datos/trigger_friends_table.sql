CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Friends_AFTER_INSERT` AFTER INSERT ON `Friends` FOR EACH ROW
BEGIN
 
DECLARE user1 int;
DECLARE user2 int;
 
SELECT Friendship_Solicitations.Users_users_id_send FROM Friends
INNER JOIN Friendship_Solicitations ON Friendship_Solicitations.Users_users_id_receive=Friends.Users_users_id_user OR Friendship_Solicitations.Users_users_id_send=Friends.Users_users_id_user1
WHERE Friendship_Solicitations.friendship_solicitations_status=1
LIMIT 1 INTO user1;


SELECT Friendship_Solicitations.Users_users_id_receive FROM Friends
INNER JOIN Friendship_Solicitations ON Friendship_Solicitations.Users_users_id_receive=Friends.Users_users_id_user OR Friendship_Solicitations.Users_users_id_send=Friends.Users_users_id_user1
WHERE Friendship_Solicitations.friendship_solicitations_status=1
LIMIT 1 INTO user2;
 
DELETE FROM Friendship_Solicitations
WHERE (Friendship_Solicitations.Users_users_id_send=user1 AND Friendship_Solicitations.Users_users_id_receive=user2) OR (Friendship_Solicitations.Users_users_id_send=user2 AND Friendship_Solicitations.Users_users_id_receive=user1);

END