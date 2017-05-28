CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Bill_Details_AFTER_INSERT` AFTER INSERT ON `Bill_Details` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE userId int;

SELECT Bill_Details.Games_games_id_game FROM Bill_Details
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO gameId;

SELECT Users.users_id_user FROM Bill_Details
INNER JOIN Bills ON Bills.bills_id_bill=Bill_Details.Bills_bills_id_bill
INNER JOIN Users ON Users.users_id_user=Bills.Users_users_id_user
ORDER BY Bill_Details_counter DESC LIMIT 1 INTO userId;


INSERT INTO Games_libraries (Libraries_libraries_id_library,Games_games_id_game) VALUES (userId,gameId);

END