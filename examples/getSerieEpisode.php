<?php

require_once __DIR__ . "/../src/loader.php";

$api = new BertMaurau\OMDB\Core\API("");


$title = (new BertMaurau\OMDB\Models\Serie) -> getByImdbId("tt0944947");

// check if it has response
if ($title -> response) {

    // get data
    echo $title -> data -> getTitle() . ' (' . $title -> data -> getYear() . ')';

    // get random episode
    if ($title -> type === 'series') {
        $episode = $title -> data -> getEpisodeForSeason(3, 4);
    }
}
echo "<pre>";
print_r($episode);
