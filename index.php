<?php
    require_once('functions.php');
    // Otsikot
    $html = "<h1>Tietokantaohjelmointi</h1>";
    $html .= "<h3>Yksinkertainen sovellus hakee sarjoja valitun tuotantokausi 
    määrän sekä arvosanan mukaan.</h3>";
    $html .= "<h4>Voit valita haluatko nähdä vain sarjan nimet ja ohjaajat vai kaikki tiedot. Tulos on järjestetty
    ääni määrän mukaan isoimmasta pienimpään. Lisäksi näet genren sekä ohjaajan nimen. Tulostuksen määrä on rajattu max 20.</h4>";
    //Tulostaa formin
    $html .= '<form action="GET">';

    //Season pudotusvalikko
    $html .= '<p><b>Valitse kausien lukumäärä.</b></p>';
    $html .= SeasonDropDown();

    //AVG pudotusvalikko
    $html .= '<p><b>Valitse arvosana.</b></p>';
    $html .= RatingDropDown();

    // Looppaa läpi tiedostot data kansiosta
    $path = 'data';
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            $html .= '<div style="padding-top: 10px"><input type="submit" value="' . basename($file, ".php") . '" formaction="' . $path . "/" . $file . '"></div>';
        }
        closedir($handle);
    }

    $html .= '</form>';

    $html .= '<p>Pahoittelut köpöstä käyttöliittymästä, aika ei riittänyt sen hifistelyyn :)</p>';
    $html .= '<p>Hyvää joulua ja onnellista uuttavuotta 2022!</p>';
    echo $html;