CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Bill_Details_AFTER_INSERT` AFTER INSERT ON `Bill_Details` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE userId int;

SELECT Bill_Details.Games_games_id_game FROM Bill_Details
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO gameId;

SELECT Bills.Users_users_id_user FROM Bills ORDER BY Bills.bills_id_bill DESC LIMIT 1 INTO userId;



INSERT INTO Games_libraries (Libraries_libraries_id_library,Games_games_id_game) VALUES (userId,gameId);

END