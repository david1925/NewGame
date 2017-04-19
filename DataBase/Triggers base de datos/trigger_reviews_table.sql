CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Reviews_AFTER_INSERT` AFTER INSERT ON `Reviews` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE gameRating float;

SELECT Reviews.Games_games_id_game FROM Reviews 
ORDER BY Reviews.reviews_datetime DESC LIMIT 1 INTO gameId;

SELECT IF(c1.total=1,1,total) AS 'Total' FROM (
SELECT ROUND(SUM(Reviews.reviews_rating)/(SELECT COUNT(Reviews.Games_games_id_game) AS 'Total' FROM Reviews WHERE Reviews.Games_games_id_game=gameId),1) AS 'Total'
FROM Reviews WHERE Reviews.Games_games_id_game = gameId) AS c1 INTO gameRating;

INSERT INTO Forums (forums_title,forums_created_date,Games_games_id_game) VALUES (gameName,now(),gameId);
END
