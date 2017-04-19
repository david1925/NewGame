CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Games_AFTER_INSERT` AFTER INSERT ON `Games` FOR EACH ROW

BEGIN

DECLARE gameId int;

DECLARE gameName varchar(200);

SELECT Games.games_id_game FROM Games
 ORDER BY Games.games_id_game DESC LIMIT 1 INTO gameId;

SELECT Games.games_name FROM Games 
ORDER BY Games.games_id_game DESC LIMIT 1 INTO gameName;



INSERT INTO Forums (forums_title,forums_created_date,Games_games_id_game) VALUES (gameName,now(),gameId);

END