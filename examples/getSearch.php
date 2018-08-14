<?php

use BertMaurau\OMDB\Models\Title AS Title;

require_once __DIR__ . "/../src/loader.php";

$api = new BertMaurau\OMDB\Core\API("3077118c");


$search = (new Title) -> search("Total");

// check if it has response
if ($search -> response) {
    // get data
    foreach ($search -> data as $key => $result) {
        echo $result -> getTitle() . ' (' . $result -> getYear() . ') <br>';
    }

    echo json_encode($search -> pagination);
}
echo "<pre>";
print_r($search);
