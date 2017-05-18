CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Reviews_AFTER_INSERT` AFTER INSERT ON `Reviews` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE gameRating float;

SELECT Reviews.Games_games_id_game FROM Reviews 
ORDER BY Reviews.reviews_datetime DESC LIMIT 1 INTO gameId;

SELECT IF(Total=1,1,Total) AS 'Total' FROM (
SELECT ROUND(SUM(Reviews.reviews_rating)/(SELECT COUNT(Reviews.Games_games_id_game) FROM Reviews WHERE Reviews.Games_games_id_game=gameId),1) AS 'Total' 
FROM Reviews WHERE Reviews.Games_games_id_game=gameId) AS c1 INTO gameRating;


UPDATE Games
SET Games.games_rating = gameRating
WHERE Games.games_id_game = gameId;

END