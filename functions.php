<?php   
    //luo kausien lukumäärä valikon
    function SeasonDropDown() {
        //avaa tietokantayhteyden
        require_once('db.php');
        $db = openDbcon();
        //SQL-lause kutsuu proseduuria
        $sql = 'CALL GetSeasonNumber;';
        //Ajetaan SQL-lause tietokantaan
        $prepare = $db->prepare($sql);
        $prepare->execute();
        // Otetaan tiedot vastaan
        $rows = $prepare->fetchAll();
        $html = '<select style="min-width: 50px" name="kaudet">';
        // Loopataan vastaukset
        foreach($rows as $row) {
            // Luodaan jokaiselle riville option
            $html .= '<option>' . $row['season_number'] . '</option>';
        }
        $html .= '</select>';
        // Palautetaan index.php kutsujalle
        return $html;
    }

    //luo arvostelujen keskiarvo valikon
    function RatingDropDown() {
        //avaa tietokantayhteyden
        require_once('db.php');
        $db = openDbcon();
        //SQL-lause kutsuu proseduuria
        $sql = 'CALL GetRatingAVG;';
        //Ajetaan SQL-lause tietokantaan
        $prepare = $db->prepare($sql);
        $prepare->execute();
        // Otetaan tiedot vastaan
        $rows = $prepare->fetchAll();
        $html = '<select style="min-width: 50px" name="avg">';
        // Loopataan vastaukset
        foreach($rows as $row) {
            // Luodaan jokaiselle riville option
            $html .= '<option>' . $row['average_rating'] . '</option>';
        }
        $html .= '</select>';
        // Palautetaan index.php kutsujalle
        return $html;
    }