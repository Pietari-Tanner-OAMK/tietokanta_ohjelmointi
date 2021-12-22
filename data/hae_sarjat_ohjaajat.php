<?php
    //functions.php käyttöön
    require_once('../db.php');
    //Avataan tietokanta yhteys
    $db = openDbcon();
    // Lukee selectin "kaudet" functions.php tiedostosta
    $season = $_GET['kaudet'];
    // Lukee selectin "avg" functions.php tiedostosta
    $avg= $_GET['avg'];
    //Select lause
    $sql = "SELECT primary_title,name_,job_category
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
    LIMIT 20;";

           //Ajetaan SQL tietokantaan
           $prepare = $db->prepare($sql);
           $prepare->execute();
           //Otetaan vastaus
           $rows = $prepare->fetchAll();
          //Tulostaa
          $html = "<h1>Tulos</h1>";
          $html .= '<ul>';
          //Looppaa vastauksen
          foreach($rows as $row){
              //Tulostaa rivit
            $html .= '<li>' . '<h3>' . $row['primary_title'] . '</h3>' . '<b>' . $row['job_category'] . ': ' . '</b>' . $row['name_'] . '</br>' .  '</li>';
          }
          $html .= '</ul>';
          echo $html;