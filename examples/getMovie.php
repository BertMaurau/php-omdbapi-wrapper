<?php

require_once __DIR__ . "/../src/loader.php";

$api = new BertMaurau\OMDB\Core\API("3077118c");


$title = (new BertMaurau\OMDB\Models\Title) -> getByImdbId("tt3896198");

// $title = (new BertMaurau\OMDB\Models\Title) -> getByTitle("Total Recall", 1990, "movies");
// check if it has response
if ($title -> response) {
    // get data
    echo $title -> data -> getTitle() . ' (' . $title -> data -> getYear() . ')';
}
echo "<pre>";
print_r($title);
