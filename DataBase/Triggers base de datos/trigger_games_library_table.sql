CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Bill_Details_AFTER_INSERT` AFTER INSERT ON `Bill_Details` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE libraryId int;
SELECT Bill_Details.Games_games_id_game FROM Bill_Details
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO gameId;

SELECT Libraries.libraries_id_library FROM Bills
INNER JOIN Users ON Users.users_id_user=Bills.Users_users_id_user
INNER JOIN Libraries ON Libraries.Users_users_id_user=Users.users_id_user
INNER JOIN Bill_Details ON Bill_Details.Bills_bills_id_bill=Bills.Users_users_id_user
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO libraryId;


INSERT INTO Games_libraries (Libraries_libraries_id_library,Games_games_id_game) VALUES (libraryId,gameId);

END