# OMDB API Wrapper
A basic PHP Wrapper for the OMDB API with a full processed response.

 - Vartypes for the values
 - Splitted genres, actors, writers, ratings,.. 
 - Search handler with pagination
 - ..

This project is not yet available via Composer, but you can manually download this repo and add the loader to your script.

```php
require_once __DIR__ . "/../<path-to-repo>/php-omdbapi-wrapper/src/loader.php";
```

### Responses

Success

```php
stdClass Object
(
    [response] => 1
    [type] => search|movie|series|episode
    (if search) [pagination] => Array
        (
            [current] => 10
            [total] => 421
            [hasMoreResults] => 1
        )

    [data] => Array()
)
```

Error

```php
stdClass Object
(
    [response] => false
    [reason] => Incorrect IMDb ID.
)
```

### Functions

The following functions are available:

General
 - Get by IMDB ID
 - Get by Title
 - Get by Search
Series specific
 - Get full season
 - Get episode for given season

## Usage

Init a new static API object first with your personal API key.
An API key can be requested via: http://www.omdbapi.com/apikey.aspx

```php
use BertMaurau\OMDB\Core\API as API;

$api = new API("api-key-here");
```

### Example

Get a title by its IMDB ID.

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> getByImdbId("tt2085059");
```

Get a title by its title, year and type (as extra arguments).

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> getByTitle("Total Recall", 1990, "movie");
```

Search for a title by its title, year and type (as extra arguments).

```php
use BertMaurau\OMDB\Models\Title as Title;

$title = (new Title) -> search("Total", null, "movie");
```

Get a specific episode for a given series.
(Example for getting episode information after fetching the series first)

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

Get a specific episode for a given series.
(Example for getting episode information without fetching the series first)

```php
use BertMaurau\OMDB\Models\Serie as Serie;

$serie = (new Serie) -> setImdbId("tt0944947") -> getEpisodeForSeason($episode = 3, $season = 4);
```

Get a full season (same principle as the episode information with two ways for fetching the info)
```php
use BertMaurau\OMDB\Models\Serie as Serie;

$season = (new Serie) -> setImdbId("tt0944947") -> getFullSeason($season = 2);
```


### Example movie response

Below is an example response for the requested movie Total Recall

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

### Example search result

Below is an example response for the search request of the query param movie "Total"

```php
stdClass Object
(
    [response] => 1
    [type] => search
    [pagination] => Array
        (
            [current] => 10
            [total] => 421
            [hasMoreResults] => 1
        )

    [data] => Array
        (
            [0] => BertMaurau\OMDB\Models\Title Object
                (
                    [title:BertMaurau\OMDB\Models\Title:private] => Total Recall
                    [year:BertMaurau\OMDB\Models\Title:private] => 1990
                    [rated:BertMaurau\OMDB\Models\Title:private] => 
                    [released:BertMaurau\OMDB\Models\Title:private] => 
                    [runtime:BertMaurau\OMDB\Models\Title:private] => 
                    [genre:BertMaurau\OMDB\Models\Title:private] => 
                    [directors:BertMaurau\OMDB\Models\Title:private] => 
                    [writers:BertMaurau\OMDB\Models\Title:private] => 
                    [actors:BertMaurau\OMDB\Models\Title:private] => 
                    [plot:BertMaurau\OMDB\Models\Title:private] => 
                    [language:BertMaurau\OMDB\Models\Title:private] => 
                    [country:BertMaurau\OMDB\Models\Title:private] => 
                    [awards:BertMaurau\OMDB\Models\Title:private] => 
                    [poster:BertMaurau\OMDB\Models\Title:private] => https://m.media-amazon.com/images/M/MV5BYzU1YmJjMGEtMjY4Yy00MTFlLWE3NTUtNzI3YjkwZTMxZjZmXkEyXkFqcGdeQXVyNDc2NjEyMw@@._V1_SX300.jpg
                    [ratings:BertMaurau\OMDB\Models\Title:private] => 
                    [metascore:BertMaurau\OMDB\Models\Title:private] => 
                    [imdbId:BertMaurau\OMDB\Models\Title:private] => tt0100802
                    [imdbRating:BertMaurau\OMDB\Models\Title:private] => 
                    [imdbVotes:BertMaurau\OMDB\Models\Title:private] => 
                    [type:BertMaurau\OMDB\Models\Title:private] => movie
                )

            ...

)
