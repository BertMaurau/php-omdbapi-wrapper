# OMDB API Wrapper (WIP)
A PHP Wrapper for the OMDB API.

Not yet available via Composer, but you can manually add the loader to your script.

```php
require_once __DIR__ . "/../php-omdbapi-wrapper/src/loader.php";
```

### Functions

There are currently only 4 functions available

 - Get by IMDB ID
 - Get by Title
 - Get full season (serie)
 - Get episode for given season (serie)


## Usage

Init a new static API object

```php
use BertMaurau\OMDB\Core\API as API;

$api = new BertMaurau\OMDB\Core\API("api-key-here");
```

### Example

Get a title by IMDB ID

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> getByImdbId("tt2085059");
```

Get a title by title, year and type

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> getByTitle("Total Recall", 1990, "movie");
```

Get a specific episode for give serie
(Full example)

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> getByImdbId("tt0944947");

// check if it has response
if ($title -> response) {

    // show title and year
    echo $title -> data -> getTitle() . ' (' . $title -> data -> getYear() . ')';

    // get requested episode
    if ($title -> type === 'series') {
        $episode = $title -> data -> getEpisodeForSeason(3, 4);
    }
}
```

(other usage to get an episode)

```php
use BertMaurau\OMDB\Models\Serie as Serie;

$serie = (new Serie) -> setImdbId("tt0944947") -> getEpisodeForSeason(3, 4);
```

Get a full season
```php
use BertMaurau\OMDB\Models\Serie as Serie;

$season = (new Serie) -> getFullSeason(2);
```


### Example movie response

Below an example response for the requested movie Total Recall

```php
stdClass Object
(
    [response] => 1
    [type] => movie
    [data] => BertMaurau\OMDB\Models\Movie Object
        (
            [dvd:BertMaurau\OMDB\Models\Movie:private] => 2000-08-29
            [boxOffice:BertMaurau\OMDB\Models\Movie:private] => 119000000
            [production:BertMaurau\OMDB\Models\Movie:private] => TriStar Pictures
            [website:BertMaurau\OMDB\Models\Movie:private] => N/A
            [title:BertMaurau\OMDB\Models\Title:private] => Total Recall
            [year:BertMaurau\OMDB\Models\Title:private] => 1990
            [rated:BertMaurau\OMDB\Models\Title:private] => R
            [released:BertMaurau\OMDB\Models\Title:private] => 1990-06-01
            [runtime:BertMaurau\OMDB\Models\Title:private] => 113
            [genre:BertMaurau\OMDB\Models\Title:private] => Array
                (
                    [0] => BertMaurau\OMDB\Models\Genre Object
                        (
                            [genre:BertMaurau\OMDB\Models\Genre:private] => Action
                        )

                    [1] => BertMaurau\OMDB\Models\Genre Object
                        (
                            [genre:BertMaurau\OMDB\Models\Genre:private] => Sci-Fi
                        )

                    [2] => BertMaurau\OMDB\Models\Genre Object
                        (
                            [genre:BertMaurau\OMDB\Models\Genre:private] => Thriller
                        )

                )

            [directors:BertMaurau\OMDB\Models\Title:private] => Array
                (
                    [0] => BertMaurau\OMDB\Models\Director Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Paul Verhoeven
                        )

                )

            [writers:BertMaurau\OMDB\Models\Title:private] => Array
                (
                    [0] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Philip K. Dick (short story "We Can Remember It For You Wholesale")
                        )

                    [1] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Ronald Shusett (screen story)
                        )

                    [2] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Dan O'Bannon (screen story)
                        )

                    [3] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Jon Povill (screen story)
                        )

                    [4] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Ronald Shusett (screenplay)
                        )

                    [5] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Dan O'Bannon (screenplay)
                        )

                    [6] => BertMaurau\OMDB\Models\Writer Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Gary Goldman (screenplay)
                        )

                )

            [actors:BertMaurau\OMDB\Models\Title:private] => Array
                (
                    [0] => BertMaurau\OMDB\Models\Actor Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Arnold Schwarzenegger
                        )

                    [1] => BertMaurau\OMDB\Models\Actor Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Rachel Ticotin
                        )

                    [2] => BertMaurau\OMDB\Models\Actor Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Sharon Stone
                        )

                    [3] => BertMaurau\OMDB\Models\Actor Object
                        (
                            [name:BertMaurau\OMDB\Models\Person:private] => Ronny Cox
                        )

                )

            [plot:BertMaurau\OMDB\Models\Title:private] => When a man goes for virtual vacation memories of the planet Mars, an unexpected and harrowing series of events forces him to go to the planet for real - or does he?
            [language:BertMaurau\OMDB\Models\Title:private] => English
            [country:BertMaurau\OMDB\Models\Title:private] => USA
            [awards:BertMaurau\OMDB\Models\Title:private] => Nominated for 2 Oscars. Another 8 wins & 14 nominations.
            [poster:BertMaurau\OMDB\Models\Title:private] => https://m.media-amazon.com/images/M/MV5BYzU1YmJjMGEtMjY4Yy00MTFlLWE3NTUtNzI3YjkwZTMxZjZmXkEyXkFqcGdeQXVyNDc2NjEyMw@@._V1_SX300.jpg
            [ratings:BertMaurau\OMDB\Models\Title:private] => Array
                (
                    [0] => BertMaurau\OMDB\Models\Rating Object
                        (
                            [source:BertMaurau\OMDB\Models\Rating:private] => Internet Movie Database
                            [rating:BertMaurau\OMDB\Models\Rating:private] => 7.5/10
                        )

                    [1] => BertMaurau\OMDB\Models\Rating Object
                        (
                            [source:BertMaurau\OMDB\Models\Rating:private] => Rotten Tomatoes
                            [rating:BertMaurau\OMDB\Models\Rating:private] => 82%
                        )

                    [2] => BertMaurau\OMDB\Models\Rating Object
                        (
                            [source:BertMaurau\OMDB\Models\Rating:private] => Metacritic
                            [rating:BertMaurau\OMDB\Models\Rating:private] => 57/100
                        )

                )

            [metascore:BertMaurau\OMDB\Models\Title:private] => 57
            [imdbId:BertMaurau\OMDB\Models\Title:private] => tt0100802
            [imdbRating:BertMaurau\OMDB\Models\Title:private] => 7.5
            [imdbVotes:BertMaurau\OMDB\Models\Title:private] => 266328
            [type:BertMaurau\OMDB\Models\Title:private] => movie
            [attributes] => Array
                (
                    [Response] => True
                )

        )

)
```