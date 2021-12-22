-- Hae sarjoja kausien, arvosanan mukaan. Näyttää myös ohjaajan sekä genren. 

SELECT primary_title, num_votes, genre, name_, job_category
    FROM episode_belongs_to
        INNER JOIN titles ON episode_belongs_to.episode_title_id = titles.title_id
        INNER JOIN title_ratings ON titles.title_id = title_ratings.title_id
        INNER JOIN title_genres ON title_ratings.title_id = title_genres.title_id
        INNER JOIN principals ON title_genres.title_id = principals.title_id
        INNER JOIN names_ ON principals.name_id = names_.name_id
    WHERE season_number = '$season' 
    AND average_rating = '$avg'
    AND job_category LIKE '%dir%'
    GROUP BY primary_title
    ORDER BY num_votes DESC
    LIMIT 20;

-- Kaudet 5-20
SELECT DISTINCT season_number 
    FROM episode_belongs_to 
    WHERE season_number BETWEEN 5 AND 20
    ORDER BY season_number

-- Arvostelun keskiarvo kokonaislukuna 5-9
SELECT DISTINCT average_rating
FROM title_ratings
WHERE average_rating REGEXP '^-?[0-9]+$' AND average_rating BETWEEN 5 AND 10
ORDER BY average_rating

-- Proseduurit

-- Hae tehdyt seasonit:
DELIMITER //

CREATE PROCEDURE GetSeasonNumber()

BEGIN

SELECT DISTINCT season_number 
    FROM episode_belongs_to 
    WHERE season_number BETWEEN 5 AND 20
    ORDER BY season_number;
    
END //

DELIMITER ;

-- Kutsu seasoneita:
CALL GetSeasonNumber

-- Hae arvostelujen keskiarvo kokonaislukuna 5-9
DELIMITER //

CREATE PROCEDURE GetRatingAVG()

BEGIN

SELECT DISTINCT average_rating
FROM title_ratings
WHERE average_rating REGEXP '^-?[0-9]+$' AND average_rating BETWEEN 5 AND 9
ORDER BY average_rating;
    
END //

DELIMITER ;

-- Kutsu keskiarvoa:
CALL GetSeasonNumber

-- Tein myös pari indexiä, niistä en muistanut ottaa komentoja talteen.